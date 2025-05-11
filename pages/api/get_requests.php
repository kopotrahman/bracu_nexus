<?php
header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../../db_connection.php');


session_start();


if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

try {
    // Verify database connection
    if (!$conn) {
        throw new Exception("Database connection failed");
    }

    $currentUserId = $_SESSION['user_id'];
    $responseData = [];

    // Query 1: Get open requests (excluding current user's requests)
    $openRequestsQuery = $conn->prepare("
        SELECT 
            r.RequestID, 
            r.userID, 
            r.currentCourse, 
            r.currentSection, 
            r.DesiredCourse, 
            r.desiredSection, 
            r.Status,
            r.created_at,
            u.userName as requestor
        FROM sectionswaprequest r
        JOIN user u ON r.userID = u.UserID
        WHERE r.Status = 'Open' AND r.userID != ?
        ORDER BY r.created_at DESC
    ");

    if (!$openRequestsQuery) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $openRequestsQuery->bind_param("i", $currentUserId);
    if (!$openRequestsQuery->execute()) {
        throw new Exception("Execute failed: " . $openRequestsQuery->error);
    }
    $openResult = $openRequestsQuery->get_result();
    $responseData['openRequests'] = $openResult->fetch_all(MYSQLI_ASSOC);
    $openRequestsQuery->close();

    // // Query 2: Get requests taken by current user
    $takenRequestsQuery = $conn->prepare("
        SELECT 
            r.RequestID, 
            r.userID, 
            r.currentCourse, 
            r.currentSection, 
            r.DesiredCourse, 
            r.desiredSection, 
            r.Status,
            r.taken_at,
            r.created_at,
            u.userName as requestor
        FROM sectionswaprequest r
        JOIN user u ON r.userID = u.UserID
        WHERE r.taken_by = ?
        ORDER BY r.taken_at DESC
    ");

    if (!$takenRequestsQuery) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $takenRequestsQuery->bind_param("i", $currentUserId);
    if (!$takenRequestsQuery->execute()) {
        throw new Exception("Execute failed: " . $takenRequestsQuery->error);
    }
    $takenResult = $takenRequestsQuery->get_result();
    $responseData['takenRequests'] = $takenResult->fetch_all(MYSQLI_ASSOC);
    $takenRequestsQuery->close();

    // // Query 3: Get requests made by current user
    $myRequestsQuery = $conn->prepare("
        SELECT 
            r.RequestID, 
            r.userID, 
            r.currentCourse, 
            r.currentSection, 
            r.DesiredCourse, 
            r.desiredSection, 
            r.Status,
            r.created_at,
            u.userName as taken_by_username
        FROM sectionswaprequest r
        LEFT JOIN user u ON r.taken_by = u.UserID
        WHERE r.userID = ?
        ORDER BY r.created_at DESC
    ");

    if (!$myRequestsQuery) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $myRequestsQuery->bind_param("i", $currentUserId);
    if (!$myRequestsQuery->execute()) {
        throw new Exception("Execute failed: " . $myRequestsQuery->error);
    }
    $myResult = $myRequestsQuery->get_result();
    $responseData['myRequests'] = $myResult->fetch_all(MYSQLI_ASSOC);
    $myRequestsQuery->close();

    // Successful response
    $responseData['success'] = true;
    echo json_encode($responseData);

} catch (Exception $e) {
    // Log the error for debugging
    error_log("Error in get_requests.php: " . $e->getMessage());
    
    // Return error response
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error occurred',
        'error' => $e->getMessage() // Only include in development environment
    ]);
}

// Close connection
if (isset($conn)) {
    $conn->close();
}
?>