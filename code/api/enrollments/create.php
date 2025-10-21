<?php
// POST /enrollments - Enroll student in course (SECURED with Bearer Token)
require_once '../../config/database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJSON(['error' => 'Method not allowed'], 405);
}

// REQUIRE BEARER TOKEN
validateToken();

$data = getRequestBody();

if (!isset($data['student_id']) || !isset($data['course_id'])) {
    sendJSON(['error' => 'Missing required fields: student_id, course_id'], 400);
}

$conn = getDBConnection();

try {
    // Verify student
    $stmt = $conn->prepare("SELECT id FROM students WHERE id = ?");
    $stmt->execute([$data['student_id']]);
    if (!$stmt->fetch()) {
        sendJSON(['error' => 'Student not found'], 404);
    }
    
    // Verify course
    $stmt = $conn->prepare("SELECT id FROM courses WHERE id = ?");
    $stmt->execute([$data['course_id']]);
    if (!$stmt->fetch()) {
        sendJSON(['error' => 'Course not found'], 404);
    }
    
    // Create 
    $stmt = $conn->prepare("INSERT INTO enrollments (student_id, course_id) VALUES (?, ?)");
    $stmt->execute([$data['student_id'], $data['course_id']]);
    
    $id = $conn->lastInsertId();
    sendJSON([
        'message' => 'Student enrolled successfully',
        'id' => $id,
        'enrollment' => [
            'id' => $id,
            'student_id' => $data['student_id'],
            'course_id' => $data['course_id']
        ]
    ], 201);
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        sendJSON(['error' => 'Student already enrolled in this course'], 409);
    }
    sendJSON(['error' => 'Failed to create enrollment'], 500);
}
