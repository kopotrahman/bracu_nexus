<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db_connection.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$requestId = $_GET['requestId'] ?? 0;

try {
    // Update the status to Approved
    $stmt = $conn->prepare("UPDATE sectionswaprequest SET Status = 'Approved' WHERE RequestID = ?");
    $stmt->bind_param("i", $requestId);
    $stmt->execute();
    
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>