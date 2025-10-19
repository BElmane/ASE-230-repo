---
marp: true
theme: default
paginate: true
---

# How to Use My APIs
## Real Examples with Curl Commands

**Project 1 - ASE 230**

---

# Before You Start

**Start the server first:**
```bash
cd ~/Desktop/project1
php -S localhost:8000
```

Keep that terminal running!

**Then open a NEW terminal to test the APIs.**

All examples use: `http://localhost:8000/api`

---

# Example 1: Create a Student

**Command:**
```bash
curl -X POST http://localhost:8000/api/students/create.php \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "Alice",
    "last_name": "Johnson",
    "email": "alice.j@student.edu"
  }'
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
    "email": "alice.j@student.edu"
  }
}
```

**Status Code:** 201 Created

---

# Example 2: Get All Students

**Command:**
```bash
curl http://localhost:8000/api/students/read.php
```

**Response:**
```json
{
  "students": [
    {
      "id": 1,
      "first_name": "John",
      "last_name": "Doe",
      "email": "john.doe@student.edu"
    },
    {
      "id": 2,
      "first_name": "Jane",
      "last_name": "Smith",
      "email": "jane.smith@student.edu"
    }
  ],
  "count": 2
}
```

**Status Code:** 200 OK

---

# Example 3: Get One Student

**Command:**
```bash
curl "http://localhost:8000/api/students/read_one.php?id=1"
```

**Response:**
```json
{
  "student": {
    "id": 1,
    "first_name": "John",
    "last_name": "Doe",
    "email": "john.doe@student.edu"
  }
}
```

**Status Code:** 200 OK

**If student doesn't exist:**
```json
{
  "error": "Student not found"
}
```
**Status Code:** 404 Not Found

---

# Example 4: Update a Student

**Command:**
```bash
curl -X PUT "http://localhost:8000/api/students/update.php?id=1" \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "Johnny",
    "last_name": "Doe",
    "email": "johnny.doe@student.edu"
  }'
```

**Response:**
```json
{
  "message": "Student updated successfully",
  "student": {
    "id": 1,
    "first_name": "Johnny",
    "last_name": "Doe",
    "email": "johnny.doe@student.edu"
  }
}
```

**Status Code:** 200 OK

---

# Example 5: Delete a Student

**Command:**
```bash
curl -X DELETE "http://localhost:8000/api/students/delete.php?id=4"
```

**Response:**
```json
{
  "message": "Student deleted successfully"
}
```

**Status Code:** 200 OK

---

# Example 6: Create a Course

**Command:**
```bash
curl -X POST http://localhost:8000/api/courses/create.php \
  -H "Content-Type: application/json" \
  -d '{
    "course_code": "MATH201",
    "course_name": "Calculus II",
    "credits": 4
  }'
```

**Response:**
```json
{
  "message": "Course created successfully",
  "id": 5,
  "course": {
    "id": 5,
    "course_code": "MATH201",
    "course_name": "Calculus II",
    "credits": 4
  }
}
```

**Status Code:** 201 Created

---

# Example 7: Get All Courses

**Command:**
```bash
curl http://localhost:8000/api/courses/read.php
```

**Response:**
```json
{
  "courses": [
    {
      "id": 1,
      "course_code": "CS101",
      "course_name": "Intro to Programming",
      "credits": 3
    },
    {
      "id": 2,
      "course_code": "CS201",
      "course_name": "Data Structures",
      "credits": 4
    }
  ],
  "count": 2
}
```

**Status Code:** 200 OK

---

# Example 8: Enroll Student (SECURED 🔒)

**Command WITH token:**
```bash
curl -X POST http://localhost:8000/api/enrollments/create.php \
  -H "Authorization: Bearer secret_bebba_key_2025" \
  -H "Content-Type: application/json" \
  -d '{
    "student_id": 1,
    "course_id": 2
  }'
```

**Response:**
```json
{
  "message": "Student enrolled successfully",
  "id": 6,
  "enrollment": {
    "id": 6,
    "student_id": 1,
    "course_id": 2
  }
}
```

**Status Code:** 201 Created

---

# Example 8: Without Token (FAILS!)

**Command WITHOUT token:**
```bash
curl -X POST http://localhost:8000/api/enrollments/create.php \
  -H "Content-Type: application/json" \
  -d '{
    "student_id": 1,
    "course_id": 2
  }'
```

**Response:**
```json
{
  "error": "Authorization header missing"
}
```

**Status Code:** 401 Unauthorized

**This proves the security works!** 

---

# Example 9: Delete Enrollment (SECURED )

**Command WITH token:**
```bash
curl -X DELETE "http://localhost:8000/api/enrollments/delete.php?id=1" \
  -H "Authorization: Bearer secret_bebba_key_2025"
```

**Response:**
```json
{
  "message": "Enrollment deleted successfully"
}
```

**Status Code:** 200 OK

---

# Example 10: Get Student Grades

**Command:**
```bash
curl "http://localhost:8000/api/grades/read.php?student_id=1"
```

**Response:**
```json
{
  "student": {
    "id": 1,
    "first_name": "John",
    "last_name": "Doe",
    "email": "john.doe@student.edu"
  },
  "grades": [
    {
      "id": 1,
      "grade": "A",
      "course_code": "CS101",
      "course_name": "Intro to Programming",
      "credits": 3
    }
  ],
  "total_courses": 1
}
```

**Status Code:** 200 OK

---

# HTML/JavaScript Example

**Create a file: test.html**
```html
<!DOCTYPE html>
<html>
<head>
    <title>Test API</title>
</head>
<body>
    <h1>Get All Students</h1>
    <button onclick="getStudents()">Click Me</button>
    <div id="result"></div>

    <script>
    async function getStudents() {
        const response = await fetch('http://localhost:8000/api/students/read.php');
        const data = await response.json();
        document.getElementById('result').innerHTML = 
            JSON.stringify(data, null, 2);
    }
    </script>
</body>
</html>
```

---

# Summary

**All 10 APIs tested with:**

**Everything works!** Ready to use!
