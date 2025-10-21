<?php
// DELETE /students/{id} - Delete student
require_once '../../config/database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    sendJSON(['error' => 'Method not allowed'], 405);
}

// Get ID 
$id = $_GET['id'] ?? null;

if (!$id) {
    sendJSON(['error' => 'Student ID is required'], 400);
}

$conn = getDBConnection();

try {
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
    
    if ($stmt->rowCount() === 0) {
        sendJSON(['error' => 'Student not found'], 404);
    }
    
    sendJSON(['message' => 'Student deleted successfully'], 200);
} catch (PDOException $e) {
    sendJSON(['error' => 'Failed to delete student'], 500);
}
