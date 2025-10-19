<?php
// POST /students - Create new student
require_once '../../config/database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJSON(['error' => 'Method not allowed'], 405);
}

$data = getRequestBody();

if (!isset($data['first_name']) || !isset($data['last_name']) || !isset($data['email'])) {
    sendJSON(['error' => 'Missing required fields: first_name, last_name, email'], 400);
}

$conn = getDBConnection();

try {
    $stmt = $conn->prepare("INSERT INTO students (first_name, last_name, email) VALUES (?, ?, ?)");
    $stmt->execute([$data['first_name'], $data['last_name'], $data['email']]);
    
    $id = $conn->lastInsertId();
    sendJSON([
        'message' => 'Student created successfully',
        'id' => $id,
        'student' => [
            'id' => $id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email']
        ]
    ], 201);
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        sendJSON(['error' => 'Email already exists'], 409);
    }
    sendJSON(['error' => 'Failed to create student'], 500);
}
