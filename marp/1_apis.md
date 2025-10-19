---
marp: true
theme: default
paginate: true
---

# My REST API Project
## Student Course Management System

**By: Bebba**
**Class: ASE 230**

---

# What Did I Build?

I built a simple system to manage:
- **Students** - add, view, update, delete
- **Courses** - add and view courses  
- **Enrollments** - sign students up for classes (secured!)
- **Grades** - check what grades students got

Think of it like a mini version of Canvas or Banner!

---

# Why Did I Build This?

**The Problem:**
Schools need to keep track of students and courses somehow.

**My Solution:**
A REST API that lets you manage everything through simple web requests.

Instead of clicking buttons on a website, you send requests like:
- "Give me all students"
- "Add this new course"
- "Enroll this student in that class"

---

# What's a REST API?

**Simple explanation:**
It's a way for programs to talk to each other.

**Example:**
- You type: `GET /students`
- API responds: "Here are all the students!"

It's like texting with a computer - you send a request, it sends back data.

---

# My 10 APIs - Students (5 APIs)

## 1 Create a Student
`POST /api/students/create.php`
- What it does: Adds a new student
- Need: first name, last name, email

## 2  Get All Students  
`GET /api/students/read.php`
- What it does: Shows you every student

## 3  Get One Student
`GET /api/students/read_one.php?id=1`
- What it does: Shows details for one specific student

---

# My 10 APIs - Students (continued)

## 4  Update a Student
`PUT /api/students/update.php?id=1`
- What it does: Change a student's info
- Example: Student got married, change their last name

## 5  Delete a Student
`DELETE /api/students/delete.php?id=1`
- What it does: Remove a student from the system
- Example: Student graduated or transferred

---

# My 10 APIs - Courses (2 APIs)

## 6  Create a Course
`POST /api/courses/create.php`
- What it does: Add a new course
- Need: course code (like "CS101"), course name, credits

## 7  Get All Courses
`GET /api/courses/read.php`
- What it does: Shows all available courses
- Example: CS101, MATH101, ENG201, etc.

---

# My 10 APIs - Enrollments (2 APIs) 

## 8  Enroll a Student (SECURED!)
`POST /api/enrollments/create.php`
- What it does: Sign up a student for a class
- **Special:** Needs a secret token (Bearer token)
- Why secured? Only staff should be able to enroll students

## 9  Remove Enrollment (SECURED!)
`DELETE /api/enrollments/delete.php?id=1`
- What it does: Drop a student from a class
- **Special:** Also needs the secret token

---

# My 10 APIs - Grades (1 API)

## 10  Get Student Grades
`GET /api/grades/read.php?student_id=1`
- What it does: Shows all grades for one student
- Shows: course name, grade, credits
- Example: "John got an A in CS101"

---

# All 10 APIs Summary

| What | How Many | Secured? |
|------|----------|----------|
| Student APIs | 5 | No |
| Course APIs | 2 | No |
| Enrollment APIs | 2 |  YES (Bearer Token) |
| Grade APIs | 1 | No |
| **TOTAL** | **10** | **2 are secured** |

---

# What I Used to Build This

- **PHP** - The programming language
- **MySQL** - The database (stores all the data)
- **JSON** - How data is sent back and forth
- **Bearer Tokens** - Secret keys for security

**That's it!** Pretty simple stack.

---

# Summary

**What I built:**
A working REST API with 10 endpoints

**What it does:**
Manages students, courses, enrollments, and grades

**What's special:**
2 APIs are secured with Bearer tokens (only authorized people can use them)

**Total APIs:** 10 
**Secured APIs:** 2 
