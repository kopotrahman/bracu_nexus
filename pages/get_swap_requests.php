<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db_connection.php';

try {
    $result = $conn->query("SELECT * FROM sectionswaprequest ORDER BY RequestID DESC");
    $requests = [];
    
    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
    
    echo json_encode($requests);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>