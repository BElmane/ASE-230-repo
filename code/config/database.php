<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'Tacoshouse&2');
define('DB_NAME', 'student_course_system');

function getDBConnection() {
    try {
        $conn = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }
}

function sendJSON($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

function getRequestBody() {
    return json_decode(file_get_contents('php://input'), true);
}

function validateToken() {
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? '';
    
    if (empty($authHeader)) {
        sendJSON(['error' => 'Authorization header missing'], 401);
    }
    
    if (preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
        $token = $matches[1];
        $validTokens = ['secret_bebba_key_2025', 'super_secure_token'];
        
        if (!in_array($token, $validTokens)) {
            sendJSON(['error' => 'Invalid token'], 403);
        }
        
        return true;
    }
    
    sendJSON(['error' => 'Invalid authorization format'], 401);
}
