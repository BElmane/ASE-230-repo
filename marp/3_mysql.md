---
marp: true
theme: default
paginate: true
---

# My MySQL Database
## How I Store Everything

**Project 1 - ASE 230**

---

# What's a Database?

Think of it like Excel spreadsheets, but smarter!

**My database has 4 tables:**
1. **students** - stores student info
2. **courses** - stores course info
3. **enrollments** - tracks who's taking what class
4. **grades** - stores student grades

Each table is like a separate spreadsheet.

---

# Table 1: Students

**What it stores:** Student information

| Column | What It Means | Example |
|--------|---------------|---------|
| id | Student number (auto) | 1, 2, 3... |
| first_name | First name | "John" |
| last_name | Last name | "Doe" |
| email | Email address | "john@student.edu" |

**Which APIs use this table?**
- All 5 student APIs (create, read, read_one, update, delete)
- Grades API (to show student name with grades)

---

# Table 2: Courses

**What it stores:** Course information

| Column | What It Means | Example |
|--------|---------------|---------|
| id | Course number (auto) | 1, 2, 3... |
| course_code | Short code | "CS101" |
| course_name | Full name | "Intro to Programming" |
| credits | Credit hours | 3 |

**Which APIs use this table?**
- Both course APIs (create, read)
- Grades API (to show course info with grades)

---

# Table 3: Enrollments

**What it stores:** Which student is in which course

| Column | What It Means | Example |
|--------|---------------|---------|
| id | Enrollment number (auto) | 1, 2, 3... |
| student_id | Which student | 1 (John) |
| course_id | Which course | 2 (CS101) |

**Translation:** Student #1 is enrolled in Course #2

**Which APIs use this table?**
- Both enrollment APIs (create, delete)
- These are the SECURED ones! 

---

# Table 4: Grades

**What it stores:** Student grades for courses

| Column | What It Means | Example |
|--------|---------------|---------|
| id | Grade record number | 1, 2, 3... |
| student_id | Which student | 1 (John) |
| course_id | Which course | 2 (CS101) |
| grade | The grade | "A" |

**Which APIs use this table?**
- Grades API (reads from this table)

---

# How Tables Connect
```
students table          enrollments table        courses table
┌─────────────┐        ┌──────────────┐         ┌─────────────┐
│ id: 1       │───────→│ student_id:1 │         │ id: 2       │
│ name: John  │        │ course_id: 2 │←────────│ CS101       │
└─────────────┘        └──────────────┘         └─────────────┘
                              ↓
                       grades table
                       ┌──────────────┐
                       │ student_id:1 │
                       │ course_id: 2 │
                       │ grade: A     │
                       └──────────────┘
```

This shows: John (student 1) is in CS101 (course 2) and got an A!

---

# API to Table Mapping

## Student APIs → students table
- create.php → INSERT into students
- read.php → SELECT all from students
- read_one.php → SELECT one from students
- update.php → UPDATE students
- delete.php → DELETE from students

## Course APIs → courses table
- create.php → INSERT into courses
- read.php → SELECT all from courses

---

# API to Table Mapping (continued)

## Enrollment APIs → enrollments table (SECURE)
- create.php → INSERT into enrollments
- delete.php → DELETE from enrollments

## Grades API → Multiple tables!
- read.php → Reads from:
  - students (to get student name)
  - grades (to get the grade)
  - courses (to get course name)

This API joins 3 tables together!

---

# Summary

**4 Simple Tables:**
1. students - who they are
2. courses - what classes exist
3. enrollments - who's taking what
4. grades - what grades they got

**10 APIs** use these tables to:
- Add/view/change/delete data
- Keep everything organized
- Make sure data is connected correctly

That's it! Simple database, powerful system!
