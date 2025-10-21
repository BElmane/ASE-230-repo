<?php
// POST /courses - Create new course
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

if (!isset($data['course_code']) || !isset($data['course_name']) || !isset($data['credits'])) {
    sendJSON(['error' => 'Missing required fields: course_code, course_name, credits'], 400);
}

$conn = getDBConnection();

try {
    $stmt = $conn->prepare("INSERT INTO courses (course_code, course_name, credits) VALUES (?, ?, ?)");
    $stmt->execute([$data['course_code'], $data['course_name'], $data['credits']]);
    
    $id = $conn->lastInsertId();
    sendJSON([
        'message' => 'Course created successfully',
        'id' => $id,
        'course' => [
            'id' => $id,
            'course_code' => $data['course_code'],
            'course_name' => $data['course_name'],
            'credits' => $data['credits']
        ]
    ], 201);
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        sendJSON(['error' => 'Course code already exists'], 409);
    }
    sendJSON(['error' => 'Failed to create course'], 500);
}
