<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db_connection.php';

// Start session and check authentication
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

// Get and validate request ID
$data = json_decode(file_get_contents('php://input'), true);
$requestId = isset($data['requestId']) ? (int)$data['requestId'] : 0;

if ($requestId <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request ID']);
    exit;
}

$currentUserId = $_SESSION['user_id'];

try {
    // Verify database connection
    if (!$conn) {
        throw new Exception("Database connection failed");
    }

    // Begin transaction
    $conn->begin_transaction();

    // 1. Check if request exists and is available
    $checkStmt = $conn->prepare("
        SELECT userID, Status 
        FROM sectionswaprequest 
        WHERE RequestID = ? 
        FOR UPDATE
    ");
    $checkStmt->bind_param("i", $requestId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows === 0) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Request not found']);
        exit;
    }

    $request = $result->fetch_assoc();
    $checkStmt->close();

    // Validate request can be taken
    if ($request['Status'] !== 'Open') {
        http_response_code(400);
        echo json_encode([
            'success' => false, 
            'message' => 'Request is not available for taking',
            'current_status' => $request['Status']
        ]);
        exit;
    }

    // Check if user is trying to take their own request
    if ($request['userID'] == $currentUserId) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Cannot take your own request']);
        exit;
    }

    // 2. Update the request status to Taken
    $updateStmt = $conn->prepare("
        UPDATE sectionswaprequest 
        SET Status = 'Taken', 
            taken_by = ?, 
            taken_at = NOW() 
        WHERE RequestID = ?
    ");
    $updateStmt->bind_param("ii", $currentUserId, $requestId);
    $updateStmt->execute();
    
    if ($updateStmt->affected_rows === 0) {
        throw new Exception("Failed to update request status");
    }
    $updateStmt->close();

    // 3. Here you would typically:
    //    - Send notification to the original requester
    //    - Log the action
    
    // Commit transaction
    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Request taken successfully',
        'request_id' => $requestId
    ]);

} catch (Exception $e) {
    // Rollback transaction if there was an error
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->rollback();
    }
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error taking request',
        'error' => $e->getMessage()
    ]);
} finally {
    // Close connection if it exists
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>