<?php
// GET /grades/{studentId} - Get all grades for a student
require_once '../../config/database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    sendJSON(['error' => 'Method not allowed'], 405);
}

// Get student ID 
$studentId = $_GET['student_id'] ?? null;

if (!$studentId) {
    sendJSON(['error' => 'Student ID is required'], 400);
}

$conn = getDBConnection();

try {
    // Verify student 
    $stmt = $conn->prepare("SELECT id, first_name, last_name, email FROM students WHERE id = ?");
    $stmt->execute([$studentId]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$student) {
        sendJSON(['error' => 'Student not found'], 404);
    }
    
    // Get grades 
    $stmt = $conn->prepare("
        SELECT 
            g.id,
            g.grade,
            c.course_code,
            c.course_name,
            c.credits
        FROM grades g
        JOIN courses c ON g.course_id = c.id
        WHERE g.student_id = ?
    ");
    $stmt->execute([$studentId]);
    $grades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    sendJSON([
        'student' => $student,
        'grades' => $grades,
        'total_courses' => count($grades)
    ], 200);
} catch (PDOException $e) {
    sendJSON(['error' => 'Failed to retrieve grades'], 500);
}
