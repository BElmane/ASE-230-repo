---
title: "API Reference"
date: 2025-12-03
draft: false
---

# API Reference

Complete reference for all REST API endpoints in the Student Course Management System.

## Base URL

**Local Development**: `http://localhost:8000/api`  
**Docker Deployment**: `http://localhost:8080/api`

---

## Students API

### 1. Create Student

**Endpoint**: `POST /api/students`  
**Authentication**: None (Public)

**Request Body**:
```json
{
    "first_name": "John",
    "last_name": "Doe",
    "email": "john.doe@example.com",
    "date_of_birth": "2000-01-15",
    "major": "Computer Science"
}
```

**cURL Example**:
```bash
curl -X POST http://localhost:8000/api/students \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "John",
    "last_name": "Doe",
    "email": "john.doe@example.com",
    "date_of_birth": "2000-01-15",
    "major": "Computer Science"
  }'
```

---

### 2. Get All Students

**Endpoint**: `GET /api/students`  
**Authentication**: None (Public)

**cURL Example**:
```bash
curl http://localhost:8000/api/students
```

---

### 3. Get Student by ID

**Endpoint**: `GET /api/students/{id}`  
**Authentication**: None (Public)

**cURL Example**:
```bash
curl http://localhost:8000/api/students/1
```

---

### 4. Update Student

**Endpoint**: `PUT /api/students/{id}`  
**Authentication**: None (Public)

**cURL Example**:
```bash
curl -X PUT http://localhost:8000/api/students/1 \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "John",
    "last_name": "Doe",
    "email": "john.updated@example.com",
    "date_of_birth": "2000-01-15",
    "major": "Software Engineering"
  }'
```

---

### 5. Delete Student

**Endpoint**: `DELETE /api/students/{id}`  
**Authentication**: None (Public)

**cURL Example**:
```bash
curl -X DELETE http://localhost:8000/api/students/1
```

---

## Courses API

### 6. Create Course

**Endpoint**: `POST /api/courses`  
**Authentication**: None (Public)

**Request Body**:
```json
{
    "course_code": "CS101",
    "course_name": "Introduction to Computer Science",
    "credits": 3,
    "description": "Fundamental concepts of computer science"
}
```

**cURL Example**:
```bash
curl -X POST http://localhost:8000/api/courses \
  -H "Content-Type: application/json" \
  -d '{
    "course_code": "CS101",
    "course_name": "Introduction to Computer Science",
    "credits": 3,
    "description": "Fundamental concepts"
  }'
```

---

### 7. Get All Courses

**Endpoint**: `GET /api/courses`  
**Authentication**: None (Public)

**cURL Example**:
```bash
curl http://localhost:8000/api/courses
```

---

## Enrollments API

**Authentication Required**: Bearer token needed for all enrollment endpoints.

### 8. Create Enrollment

**Endpoint**: `POST /api/enrollments`  
**Authentication**: Bearer Token (Required)

**Request Body**:
```json
{
    "student_id": 1,
    "course_id": 1,
    "enrollment_date": "2025-01-15",
    "status": "active"
}
```

**cURL Example**:
```bash
curl -X POST http://localhost:8000/api/enrollments \
  -H "Authorization: Bearer secret_bebba_key_2025" \
  -H "Content-Type: application/json" \
  -d '{
    "student_id": 1,
    "course_id": 1,
    "enrollment_date": "2025-01-15",
    "status": "active"
  }'
```

---

### 9. Get All Enrollments

**Endpoint**: `GET /api/enrollments`  
**Authentication**: Bearer Token (Required)

**cURL Example**:
```bash
curl http://localhost:8000/api/enrollments \
  -H "Authorization: Bearer secret_bebba_key_2025"
```

---

## Grades API

**Authentication Required**: Bearer token needed.

### 10. Create Grade

**Endpoint**: `POST /api/grades`  
**Authentication**: Bearer Token (Required)

**Request Body**:
```json
{
    "enrollment_id": 1,
    "grade": "A",
    "grade_date": "2025-05-15"
}
```

**cURL Example**:
```bash
curl -X POST http://localhost:8000/api/grades \
  -H "Authorization: Bearer secret_bebba_key_2025" \
  -H "Content-Type: application/json" \
  -d '{
    "enrollment_id": 1,
    "grade": "A",
    "grade_date": "2025-05-15"
  }'
```

---

## Authentication

### Valid Bearer Tokens
- `secret_bebba_key_2025`
- `super_secure_token`

### Header Format
```
Authorization: Bearer secret_bebba_key_2025
```
