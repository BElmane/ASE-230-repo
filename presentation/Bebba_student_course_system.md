---
marp: true
theme: default
paginate: true
---

# Student Course Management System
## Complete REST API Tutorial

**Developer: Bebba Elmane**
**ASE 230 - Project 1**

---

# Welcome! 

This tutorial will teach you how to build a complete REST API system.

**What you'll learn:**
1.  PHP basics
2. MySQL database
3. REST API concepts
4. API security
5. How to use the APIs

**By the end, you'll understand how to build your own REST API!**

---

# What We Built

A system to manage:
- **Students** - add, view, update, delete
- **Courses** - create and view courses
- **Enrollments** - sign students up (secured!)
- **Grades** - track student performance

**10 total APIs** with **2 secured endpoints**

Think: Mini version of a school registration system!

---

# Topic 1: PHP Basics

---

# What is PHP?

**PHP = Personal Home Page** (originally)
Now means: **PHP: Hypertext Preprocessor**

**Simple explanation:**
- It's a programming language that runs on servers
- Perfect for building websites and APIs
- Works great with databases (like MySQL)

**Why we use it:**
- Easy to learn
- Works well for REST APIs
- Built-in server for testing

---

# PHP Syntax Basics

**Hello World:**
```php
<?php
echo "Hello World!";
?>
```

**Variables:**
```php
<?php
$name = "Bebba";
$age = 20;
echo "My name is $name";
?>
```

**Arrays:**
```php
<?php
$students = ["John", "Jane", "Mike"];
echo $students[0]; // Outputs: John
?>
```

---

# PHP for Our APIs

**Example from our code:**
```php
<?php
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    sendJSON(['error' => 'Method not allowed'], 405);
}

$conn = getDBConnection();
$stmt = $conn->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

sendJSON(['students' => $students], 200);
?>
```

**What this does:** Gets all students from database and returns them as JSON

---

# Key PHP Concepts We Use

**1. Getting request data:**
```php
$_SERVER['REQUEST_METHOD'] 
$_GET['id']                 
file_get_contents('php://input') 
```

**2. Database connection:**
```php
$conn = new PDO("mysql:host=localhost;dbname=...", $user, $pass);
```

**3. Sending responses:**
```php
http_response_code(200);
header('Content-Type: application/json');
echo json_encode(['message' => 'Success']);
```

---

# PHP + MySQL = Perfect Match

**Why they work together:**
- PHP can easily talk to MySQL
- We use **PDO** (PHP Data Objects) for database
- Prepared statements prevent SQL injection

**Example:**
```php
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);
```

This safely gets one student from the database!


---

# Topic 2: MySQL Database ️

---

# What is MySQL?

**MySQL = Database Management System**

**Simple explanation:**
- Stores all your data in organized tables
- Like Excel, but much more powerful
- Keeps data safe and organized

**We use it to store:**
- Student information
- Course information
- Enrollments
- Grades

---

# Our 4 Tables

**1. students** - who are the students?
```sql
CREATE TABLE students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(255) UNIQUE
);
```

**2. courses** - what classes exist?
```sql
CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    course_code VARCHAR(20) UNIQUE,
    course_name VARCHAR(200),
    credits INT
);
```

---

# Our 4 Tables (continued)

**3. enrollments** - who's taking what?
```sql
CREATE TABLE enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    course_id INT,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);
```

**4. grades** - what grades did they get?
```sql
CREATE TABLE grades (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    course_id INT,
    grade VARCHAR(5),
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);
```

---

# How Tables Connect

**Example scenario:**
- Student "John Doe" (id=1) in students table
- Course "CS101" (id=2) in courses table
- Enrollment links them: student_id=1, course_id=2
- Grade shows: student_id=1, course_id=2, grade="A"

**This means:** John Doe is taking CS101 and got an A!

**The connections make sure:**
- You can't enroll a student that doesn't exist
- You can't assign a grade for a course that doesn't exist
- Everything stays organized!

---

# Basic SQL Commands We Use

**CREATE** - Add new record:
```sql
INSERT INTO students (first_name, last_name, email) 
VALUES ('John', 'Doe', 'john@student.edu');
```

**READ** - Get records:
```sql
SELECT * FROM students;
SELECT * FROM students WHERE id = 1;
```

**UPDATE** - Change record:
```sql
UPDATE students SET email = 'newemail@student.edu' WHERE id = 1;
```

**DELETE** - Remove record:
```sql
DELETE FROM students WHERE id = 1;
```

---

# MySQL in PHP

**How we use MySQL in our APIs:**
```php
// 1. Connect to database
$conn = getDBConnection();

// 2. Prepare SQL query (safe from injection!)
$stmt = $conn->prepare("INSERT INTO students (first_name, last_name, email) VALUES (?, ?, ?)");

// 3. Execute with data
$stmt->execute([$firstName, $lastName, $email]);

// 4. Get result
$id = $conn->lastInsertId();
```

**Safe and simple!** 

---

# Topic 3: REST APIs 

---

# What is REST?

**REST = Representational State Transfer**

**Simple explanation:**
A way for programs to talk to each other over the internet.

**Think of it like ordering at a restaurant:**
- You (client) tell the waiter what you want
- Waiter brings your order to the kitchen (server)
- Kitchen prepares it
- Waiter brings it back to you

**REST API = The waiter in this scenario!**

---

# REST API Principles

**1. Uses HTTP Methods:**
- **GET** = Read/retrieve data
- **POST** = Create new data
- **PUT** = Update existing data
- **DELETE** = Remove data

**2. Uses URLs (endpoints):**
- `/students` = All students
- `/students/1` = Student with ID 1
- `/courses` = All courses

**3. Returns JSON:**
```json
{
  "id": 1,
  "first_name": "John",
  "last_name": "Doe"
}
```

---

# Our 10 REST APIs

**Students (5):**
- POST `/api/students/create.php` - Create student
- GET `/api/students/read.php` - Get all students
- GET `/api/students/read_one.php?id=1` - Get one student
- PUT `/api/students/update.php?id=1` - Update student
- DELETE `/api/students/delete.php?id=1` - Delete student

**Courses (2):**
- POST `/api/courses/create.php` - Create course
- GET `/api/courses/read.php` - Get all courses

**Enrollments (2 - SECURED ):**
- POST `/api/enrollments/create.php` - Enroll student
- DELETE `/api/enrollments/delete.php?id=1` - Remove enrollment

**Grades (1):**
- GET `/api/grades/read.php?student_id=1` - Get student grades

---

# REST API Example

**Request:**
```
POST /api/students/create.php
Content-Type: application/json

{
  "first_name": "Alice",
  "last_name": "Johnson",
  "email": "alice@student.edu"
}
```

**Response:**
```json
{
  "message": "Student created successfully",
  "id": 5,
  "student": {
    "id": 5,
    "first_name": "Alice",
    "last_name": "Johnson",
    "email": "alice@student.edu"
  }
}
```

**Status Code:** 201 Created

---

# HTTP Status Codes We Use

**Success codes:**
- **200 OK** - Request successful
- **201 Created** - New record created

**Error codes:**
- **400 Bad Request** - Missing required fields
- **401 Unauthorized** - No auth token provided
- **403 Forbidden** - Invalid auth token
- **404 Not Found** - Record doesn't exist
- **405 Method Not Allowed** - Wrong HTTP method
- **409 Conflict** - Duplicate data (email already exists)
- **500 Server Error** - Something broke on server

These codes tell you what happened!

---

# RESTful Design in Our APIs

**Good REST design principles we follow:**

 **Resource-based URLs** - `/students`, `/courses`
 **HTTP methods match actions** - POST to create, GET to read
 **Stateless** - Each request is independent
 **JSON responses** - Easy to read and use
 **Proper status codes** - Know what happened
 **Consistent structure** - All APIs work similarly

**Result:** Clean, predictable APIs!

---

# Topic 4: Security 

---

# Why Security Matters

**The problem:**
Not everyone should be able to do everything!

**Example:**
-  Students can VIEW courses
-  Students should NOT be able to enroll themselves
-  Students should NOT be able to drop other students

**Solution:** Bearer Token Authentication

Only people with the secret token can use certain APIs!

---

# What is Bearer Token Authentication?

**Think of it like a VIP pass:**
- You need the pass to get into exclusive areas
- Without the pass, you're denied entry
- With a fake pass, you're also denied

**In our system:**
- Token = `secret_bebba_key_2025`
- Some APIs require this token
- Without it → Access denied!

---

# Which APIs Are Secured?

**🔒 SECURED (Need Bearer Token):**
1. POST `/api/enrollments/create.php`
2. DELETE `/api/enrollments/delete.php`

**🔓 NOT SECURED:**
- All 5 Student APIs
- All 2 Course APIs  
- 1 Grades API

**Why these 2?**
Only authorized staff should manage enrollments!

---

# How to Use Bearer Token

**Format:**
```
Authorization: Bearer <your_token>
```

**Example:**
```bash
curl -X POST http://localhost:8000/api/enrollments/create.php \
  -H "Authorization: Bearer secret_bebba_key_2025" \
  -H "Content-Type: application/json" \
  -d '{"student_id": 1, "course_id": 2}'
```

**Without the token → Request BLOCKED!** 

---

# Security Implementation

**In config/database.php:**
```php
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
```

---

# How Secured APIs Use It

**In enrollments/create.php:**
```php
<?php
require_once '../../config/database.php';

// This line checks the token!
validateToken();

// If token is valid, continue...
// If not, function stops and returns error
```

**Just one line of code protects the whole API!** ️

---

# Security Testing

**Test 1: With valid token **
```bash
curl -H "Authorization: Bearer secret_bebba_key_2025" ...
```
**Result:** Works! Returns 201 Created

**Test 2: Without token**
```bash
curl ... (no Authorization header)
```
**Result:** 401 Unauthorized - "Authorization header missing"

**Test 3: With wrong token **
```bash
curl -H "Authorization: Bearer fake_token" ...
```
**Result:** 403 Forbidden - "Invalid token"

**Security works!** 


---

# Topic 5: How to Access APIs 

---

# Three Ways to Use Our APIs

**1. curl** - Command line tool (for testing)
**2. HTML/JavaScript** - For web pages
**3. Any programming language** - Python, Java, etc.

We'll show you curl and HTML/JavaScript!

---

# Using curl

**curl = Command line tool to make HTTP requests**

**Basic curl syntax:**
```bash
curl [OPTIONS] [URL]
```

**Common options:**
- `-X` = Specify method (GET, POST, PUT, DELETE)
- `-H` = Add header
- `-d` = Send data

**Example:**
```bash
curl -X POST http://localhost:8000/api/students/create.php \
  -H "Content-Type: application/json" \
  -d '{"first_name":"John","last_name":"Doe","email":"j@s.edu"}'
```

---

# curl Examples for Each API

**GET request (simple):**
```bash
curl http://localhost:8000/api/students/read.php
```

**GET with parameter:**
```bash
curl "http://localhost:8000/api/students/read_one.php?id=1"
```

**POST request (create):**
```bash
curl -X POST http://localhost:8000/api/students/create.php \
  -H "Content-Type: application/json" \
  -d '{"first_name":"Alice","last_name":"Smith","email":"a@s.edu"}'
```

**PUT request (update):**
```bash
curl -X PUT "http://localhost:8000/api/students/update.php?id=1" \
  -H "Content-Type: application/json" \
  -d '{"first_name":"John","last_name":"Updated","email":"new@s.edu"}'
```

---

# curl Examples (continued)

**DELETE request:**
```bash
curl -X DELETE "http://localhost:8000/api/students/delete.php?id=5"
```

**POST with Bearer token (secured):**
```bash
curl -X POST http://localhost:8000/api/enrollments/create.php \
  -H "Authorization: Bearer secret_bebba_key_2025" \
  -H "Content-Type: application/json" \
  -d '{"student_id":1,"course_id":2}'
```

**DELETE with Bearer token (secured):**
```bash
curl -X DELETE "http://localhost:8000/api/enrollments/delete.php?id=1" \
  -H "Authorization: Bearer secret_bebba_key_2025"
```

---

# Using HTML + JavaScript

**Create a simple web page to test APIs:**
```html
<!DOCTYPE html>
<html>
<head>
    <title>Student API Test</title>
</head>
<body>
    <h1>Student Course System</h1>
    
    <h2>Get All Students</h2>
    <button onclick="getStudents()">Load Students</button>
    <div id="students"></div>

    <h2>Create Student</h2>
    <input id="fname" placeholder="First Name">
    <input id="lname" placeholder="Last Name">
    <input id="email" placeholder="Email">
    <button onclick="createStudent()">Create</button>
    <div id="result"></div>
```

---

# JavaScript Functions
```html
    <script>
    // Get all students
    async function getStudents() {
        const response = await fetch('http://localhost:8000/api/students/read.php');
        const data = await response.json();
        document.getElementById('students').innerHTML = 
            '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
    }

    // Create new student
    async function createStudent() {
        const data = {
            first_name: document.getElementById('fname').value,
            last_name: document.getElementById('lname').value,
            email: document.getElementById('email').value
        };
        
        const response = await fetch('http://localhost:8000/api/students/create.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        document.getElementById('result').innerHTML = 
            '<pre>' + JSON.stringify(result, null, 2) + '</pre>';
    }
    </script>
</body>
</html>
```

---

# JavaScript with Bearer Token

**For secured APIs, add Authorization header:**
```javascript
async function enrollStudent(studentId, courseId) {
    const data = {
        student_id: studentId,
        course_id: courseId
    };
    
    const response = await fetch('http://localhost:8000/api/enrollments/create.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer secret_bebba_key_2025'
        },
        body: JSON.stringify(data)
    });
    
    const result = await response.json();
    console.log(result);
}
```

**Just add the Authorization header!** 

---

# Quick Start Guide

**Step 1: Start the server**
```bash
cd ~/Desktop/project1
php -S localhost:8000
```

**Step 2: Test with curl**
```bash
curl http://localhost:8000/api/students/read.php
```

**Step 3: Create HTML file and open in browser**
```html
<!-- Use the HTML example from previous slides -->
```

**Step 4: Start building!** 

---

# Summary - What You Learned

 **PHP** - Server-side programming language
 **MySQL** - Database with 4 connected tables
 **REST APIs** - 10 endpoints following REST principles
 **Security** - Bearer token authentication for 2 APIs
 **Access** - How to use via curl and HTML/JavaScript

---

# Final Project Stats

📊 **By the numbers:**
- **10** REST API endpoints
- **4** MySQL tables
- **2** secured APIs
- **5** HTTP methods used (GET, POST, PUT, DELETE, OPTIONS)
- **8** different status codes


---

# Resources & Next Steps

**What's next:**
- Add more features (search, filtering, pagination)
- Improve security (database tokens, JWT)
- Add user authentication
- Deploy to a real server
- Build a frontend interface


---

# Thank You! :)

