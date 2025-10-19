CREATE DATABASE IF NOT EXISTS student_course_system;
USE student_course_system;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(20) NOT NULL UNIQUE,
    course_name VARCHAR(200) NOT NULL,
    credits INT NOT NULL
);

CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

CREATE TABLE grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    grade VARCHAR(5),
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

INSERT INTO students (first_name, last_name, email) VALUES
('John', 'Doe', 'john.doe@student.edu'),
('Jane', 'Smith', 'jane.smith@student.edu'),
('Michael', 'Johnson', 'michael.j@student.edu');

INSERT INTO courses (course_code, course_name, credits) VALUES
('CS101', 'Intro to Programming', 3),
('CS201', 'Data Structures', 4),
('MATH101', 'Calculus I', 4);

INSERT INTO enrollments (student_id, course_id) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 3);

INSERT INTO grades (student_id, course_id, grade) VALUES
(1, 1, 'A'),
(2, 1, 'B+'),
(3, 3, 'A-');
