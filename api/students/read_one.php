<?php
// GET /students/{id} - Get student by ID
require_once '../../config/database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    sendJSON(['error' => 'Method not allowed'], 405);
}


$id = $_GET['id'] ?? null;

if (!$id) {
    sendJSON(['error' => 'Student ID is required'], 400);
}

$conn = getDBConnection();

try {
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$student) {
        sendJSON(['error' => 'Student not found'], 404);
    }
    
    sendJSON(['student' => $student], 200);
} catch (PDOException $e) {
    sendJSON(['error' => 'Failed to retrieve student'], 500);
}
