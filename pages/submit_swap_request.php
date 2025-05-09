<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db_connection.php';

// Get the current user ID from session
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

try {
    $stmt = $conn->prepare("INSERT INTO sectionswaprequest 
                          (userID, currentCourse, currentSection, DesiredCourse, desiredSection, Status) 
                          VALUES (?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("issss", $_SESSION['user_id'], 
                     $data['currentCourse'], $data['currentSection'], 
                     $data['desiredCourse'], $data['desiredSection']);
    $stmt->execute();
    
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>