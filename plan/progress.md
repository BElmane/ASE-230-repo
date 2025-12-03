# Project 2 Progress Report

Student: Bebba Elmane
Course: ASE 230 - PHP to Laravel
Institution: Northern Kentucky University
Project: Student Course Management System - Laravel Migration

---

## Overall Progress

Module 2 (Laravel Implementation & Deployment): Complete
Module 3 (Documentation & GitHub Pages): Complete

---

## What I Completed

### Laravel Implementation

I converted all 10 REST APIs from my Project 1 (raw PHP) to Laravel framework. I created 4 Eloquent models: Student, Course, Enrollment, and Grade. Each model has the proper relationships set up. I also implemented Bearer token authentication using custom middleware.

All 10 endpoints are working:
- 5 Student endpoints (Create, Get All, Get by ID, Update, Delete)
- 2 Course endpoints (Create, Get All)
- 2 Enrollment endpoints (Create, Get All) - protected with Bearer token
- 1 Grade endpoint (Create) - protected with Bearer token

I tested all endpoints using cURL commands and they work correctly.

### Deployment Scripts

I created two deployment scripts:

run.sh - This script deploys the Laravel application with one command. It installs dependencies, sets up the environment file, generates the application key, runs migrations, seeds the database, and starts the server.

setup.sh - This script deploys the application using Docker. It builds the containers, starts them, and runs the migrations.

Both scripts work successfully and I have screenshots saved.

### Docker Containerization

I containerized the Laravel application using Docker Compose. The setup includes three containers:
- Laravel application container
- Nginx web server container  
- MySQL database container

All containers communicate properly and the application runs on localhost:8080 when using Docker.

### Hugo Documentation

I created a documentation website using Hugo static site generator. The site includes four main pages:

Home Page - Shows project overview and key features
About Page - Explains my development journey and what I learned
Documentation Page - Contains system architecture, database design, and installation instructions
API Reference Page - Documents all 10 API endpoints with examples

I created custom HTML layouts and CSS styling for a professional look. I tested the site locally and it works correctly.

### GitHub Repository

I organized my project with the correct folder structure:
- code folder contains all Laravel files
- presentation folder contains the Hugo documentation
- plan folder contains plan.md and progress.md

I pushed everything to my GitHub repository at github.com/BElmane/ASE-230-repo

I also created a GitHub Actions workflow file so the Hugo site will automatically deploy to GitHub Pages when I enable it.

---

## Challenges I Faced

Challenge 1: Setting up Docker
At first, the containers could not communicate with each other. I fixed this by properly configuring the Docker network in docker-compose.yml and making sure all services are linked correctly.

Challenge 2: Bearer Token Authentication
Laravel Sanctum seemed complicated for this project. Instead, I created a custom middleware that validates Bearer tokens, which is simpler and works well for this use case.

Challenge 3: Hugo Configuration
Hugo wanted a theme but I wanted to use my own design. I removed the theme requirement from the config file and created custom layouts and CSS instead.

---

## Testing

I tested everything to make sure it works:

Laravel APIs - Tested all 10 endpoints with cURL commands. All CRUD operations work and authentication works on protected endpoints.

run.sh script - Successfully starts Laravel server on localhost:8000
setup.sh script - Successfully starts Docker containers on localhost:8080

Hugo site - Tested with hugo server command. All pages display correctly with proper styling and navigation.

---

## What I Learned

Through this project, I learned how to:
- Use Laravel framework and Eloquent ORM
- Create proper database relationships in Laravel
- Write shell scripts for automated deployment
- Containerize applications with Docker
- Create static websites with Hugo
- Set up GitHub Actions for automated deployment

This project helped me understand how modern web applications are built and deployed using professional tools and practices.

---

Project Status: Complete
Date: December 3, 2025
