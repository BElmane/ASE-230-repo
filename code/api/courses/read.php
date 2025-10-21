<?php
// GET /courses - Get all courses
require_once '../../config/database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    sendJSON(['error' => 'Method not allowed'], 405);
}

$conn = getDBConnection();

try {
    $stmt = $conn->query("SELECT * FROM courses");
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    sendJSON([
        'courses' => $courses,
        'count' => count($courses)
    ], 200);
} catch (PDOException $e) {
    sendJSON(['error' => 'Failed to retrieve courses'], 500);
}
