<?php
// PUT /students/{id} - Update student
require_once '../../config/database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    sendJSON(['error' => 'Method not allowed'], 405);
}


$id = $_GET['id'] ?? null;

if (!$id) {
    sendJSON(['error' => 'Student ID is required'], 400);
}

$data = getRequestBody();

if (!isset($data['first_name']) || !isset($data['last_name']) || !isset($data['email'])) {
    sendJSON(['error' => 'Missing required fields: first_name, last_name, email'], 400);
}

$conn = getDBConnection();

try {
    $stmt = $conn->prepare("UPDATE students SET first_name = ?, last_name = ?, email = ? WHERE id = ?");
    $stmt->execute([$data['first_name'], $data['last_name'], $data['email'], $id]);
    
    if ($stmt->rowCount() === 0) {
        sendJSON(['error' => 'Student not found'], 404);
    }
    
    sendJSON([
        'message' => 'Student updated successfully',
        'student' => [
            'id' => $id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email']
        ]
    ], 200);
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        sendJSON(['error' => 'Email already exists'], 409);
    }
    sendJSON(['error' => 'Failed to update student'], 500);
}
