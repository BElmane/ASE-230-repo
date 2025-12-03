---
title: "Documentation"
date: 2025-12-03
draft: false
---

# Documentation

Complete documentation for the Student Course Management System.

## System Architecture

### Overview
The Student Course Management System follows the Model-View-Controller (MVC) architecture pattern provided by Laravel framework.

### Components

**Models**: Eloquent ORM models representing database entities
- `Student.php` - Student records with personal information
- `Course.php` - Course catalog data
- `Enrollment.php` - Student-course relationships
- `Grade.php` - Student grade records

**Controllers**: Handle HTTP requests and business logic
- `StudentController.php` - Student CRUD operations
- `CourseController.php` - Course management
- `EnrollmentController.php` - Enrollment operations (protected)
- `GradeController.php` - Grade management (protected)

**Routes**: Define API endpoints in `routes/api.php`
- Public endpoints for students and courses
- Protected endpoints for enrollments and grades

**Middleware**: Custom authentication middleware
- `VerifyBearerToken.php` - Validates Bearer tokens

## Database Design

### Students Table
- `id`: Primary key
- `first_name`: Student's first name
- `last_name`: Student's last name
- `email`: Unique email address
- `date_of_birth`: Birth date
- `major`: Field of study

### Courses Table
- `id`: Primary key
- `course_code`: Unique course identifier
- `course_name`: Full course title
- `credits`: Credit hours
- `description`: Course details

### Enrollments Table
- `id`: Primary key
- `student_id`: Foreign key to students
- `course_id`: Foreign key to courses
- `enrollment_date`: Date of enrollment
- `status`: Enrollment status

### Grades Table
- `id`: Primary key
- `enrollment_id`: Foreign key to enrollments
- `grade`: Letter grade
- `grade_date`: Date grade was assigned

## Installation Guide

### Method 1: Laravel Native Deployment

Run the deployment script:
```bash
chmod +x run.sh
./run.sh
```

The script automatically:
- Installs dependencies via Composer
- Creates `.env` file
- Generates application key
- Runs database migrations
- Seeds sample data
- Starts Laravel server on port 8000

### Method 2: Docker Deployment

Run the Docker setup script:
```bash
chmod +x setup.sh
./setup.sh
```

The script automatically:
- Builds Docker images
- Creates Docker network
- Starts all containers
- Runs migrations and seeds
- Configures Nginx

## Security Features

### Bearer Token Authentication

Custom middleware validates tokens before processing requests.

**Protected Resources**:
- Enrollment operations
- Grade operations

**Valid Tokens**:
- `secret_bebba_key_2025`
- `super_secure_token`

**Usage**:
```bash
curl -H "Authorization: Bearer secret_bebba_key_2025" http://localhost:8000/api/enrollments
```
