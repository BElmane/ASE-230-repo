<?php
// DELETE /enrollments/{id} - Remove enrollment (SECURED with Bearer Token)
require_once '../../config/database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    sendJSON(['error' => 'Method not allowed'], 405);
}

// REQUIRE BEARER TOKEN
validateToken();

// Get ID from query parameter
$id = $_GET['id'] ?? null;

if (!$id) {
    sendJSON(['error' => 'Enrollment ID is required'], 400);
}

$conn = getDBConnection();

try {
    $stmt = $conn->prepare("DELETE FROM enrollments WHERE id = ?");
    $stmt->execute([$id]);
    
    if ($stmt->rowCount() === 0) {
        sendJSON(['error' => 'Enrollment not found'], 404);
    }
    
    sendJSON(['message' => 'Enrollment deleted successfully'], 200);
} catch (PDOException $e) {
    sendJSON(['error' => 'Failed to delete enrollment'], 500);
}
