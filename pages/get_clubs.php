<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db_connection.php';

if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . mysqli_connect_error()]);
    exit;
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $query = "SELECT * FROM clubs";
    $result = mysqli_query($conn, $query);

    $clubs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $clubs[] = $row;
    }

    echo json_encode($clubs);
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch clubs', 'details' => $e->getMessage()]);
}
?>  