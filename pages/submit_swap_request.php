<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db_connection.php';

// Start session and verify authentication
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

// Get and validate input data
$data = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
    exit;
}

// Validate required fields
$requiredFields = ['currentCourse', 'currentSection', 'desiredCourse', 'desiredSection'];
foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => "Missing required field: $field"]);
        exit;
    }
}

// Sanitize inputs
$currentCourse = substr(trim($data['currentCourse']), 0, 10);
$currentSection = substr(trim($data['currentSection']), 0, 10);
$desiredCourse = substr(trim($data['desiredCourse']), 0, 10);
$desiredSection = substr(trim($data['desiredSection']), 0, 10);
$userId = $_SESSION['user_id'];

try {
    // Verify database connection
    if (!$conn) {
        throw new Exception("Database connection failed");
    }

    // Begin transaction
    $conn->begin_transaction();

    // Check for duplicate open request
    $checkStmt = $conn->prepare("
        SELECT RequestID FROM sectionswaprequest 
        WHERE userID = ? 
        AND currentCourse = ? 
        AND DesiredCourse = ?
        AND Status IN ('Open', 'Pending', 'Taken')
    ");
    $checkStmt->bind_param("iss", $userId, $currentCourse, $desiredCourse);
    $checkStmt->execute();
    
    if ($checkStmt->get_result()->num_rows > 0) {
        http_response_code(409);
        echo json_encode([
            'success' => false, 
            'message' => 'You already have an active request for these courses'
        ]);
        exit;
    }
    $checkStmt->close();

    // Create new request
    $insertStmt = $conn->prepare("
        INSERT INTO sectionswaprequest 
        (userID, currentCourse, currentSection, DesiredCourse, desiredSection, Status, created_at) 
        VALUES (?, ?, ?, ?, ?, 'Open', NOW())
    ");
    $insertStmt->bind_param("issss", $userId, $currentCourse, $currentSection, $desiredCourse, $desiredSection);
    $insertStmt->execute();
    
    if ($insertStmt->affected_rows === 0) {
        throw new Exception("Failed to create request");
    }
    
    $requestId = $conn->insert_id;
    $insertStmt->close();

    // Here you would typically:
    // - Send notification to admins (if needed)
    // - Log the request creation
    
    // Commit transaction
    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Request created successfully',
        'requestId' => $requestId
    ]);

} catch (Exception $e) {
    // Rollback transaction if there was an error
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->rollback();
    }
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error creating request',
        'error' => $e->getMessage()
    ]);
} finally {
    // Close connection if it exists
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>