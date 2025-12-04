---
marp: true
---

# Project 2 Grading and Submission

Total Points: 200

## Grading Policy & Rule

- No points may be given if students do not check the checklist and grade correctly.
- The professor will grade again to add or deduct points.
- Check Canvas or ask the professor for any questions or details.

---

**!Check this to earn points**
**If you did not finish any of the tasks, do not check the item.**

[✓ ] I understand the policy & Rule.
[✓ ] I uploaded all my project results (module2) to GitHub.
[✓ ] I uploaded all my project document (module3) to GitHub.io.
[✓] I zipped all of my project results (module2) in the submission.
[✓ ] I zipped all of my project document (module3) in the submission.

---

**The links to your GitHub repository and Zip file names**
✓
- Your ASE230 Project GitHub Repository: https://github.com/BElmane/ASE-230-repo
  - GitHub Link to your code (module 2): https://github.com/BElmane/ASE-230-repo/tree/main/code
  - The Zip file name: code.zip and size: 1.7M
  - GitHub.io Link (module 3): https://BElmane.github.io/ASE-230-repo/
  - The Zip file name: presentation.zip and size: 25K

---

### FAQ

Q: For code link, what should I do?
A: You can give the link to your code in GitHub. For example, the first ASE 230 PHP server code can be found in <https://github.com/nkuase/ase230/tree/main/module1/code/1_First_PHP_Server>, you share the link similarly.

Q: Why do I need to check the zipped file size?
A: Some students copy all the GitHub files, not just code or document to make huge sized zip files. So, students need to check the zip file does not include any .git or similar hidden directories/files in it.

Q: Do I need to make two zipped files for code and document?
A: Yes, the code directory should contain the Laravel code and scripts (module 2), and the presentation directory should contain the GitHub.io files (module 3).

---

## 🔹 Laravel Implementation (40 pts)

- [ 15/15] Re-implemented Project 1 APIs using **Laravel framework** (must have same functionality as Project 1)
  - List your Laravel API endpoints:
  -Students (5 endpoints):
  ->POST /api/students - Create a new student
  ->GET /api/students - Get all students
  ->GET /api/students/{id} - Get student by ID
  ->PUT /api/students/{id} - Update student
  ->DELETE /api/students/{id} - Delete student
  -Courses (2 endpoints):
  ->POST /api/courses - Create a new course
  ->GET /api/courses - Get all courses
  -Enrollments (2 endpoints - protected with Bearer token):
  ->GET /api/enrollments - Get all enrollments (requires Bearer token)
  ->Grades (1 endpoint - protected with Bearer token):
  ->POST /api/grades - Create grade (requires Bearer token)
  
  - [T] Uses Laravel routing and controllers properly
- [ 15/15] Used **Eloquent ORM** for database operations (no raw SQL queries)
  - List your Eloquent models:Student, Course, Enrollment, Grade
  - [T] Proper model relationships implemented
- [ /10] Implemented authentication using **Laravel Sanctum** or similar
  - Authentication method used:Custom Bearer Token Middleware (ValidateCustomToken)
  - [T] Bearer token authentication working

---

### Grading Rule

- If you finished the task, give full points & select T.
- If you finished only partially, give partial points & select T.
- If you did not finish the task, select F.

The professor will regrade to add or subtract points.

---

| Task                                      | Points | Earned  |
|-------------------------------------------|--------|---------|
| Laravel API endpoints (same as Project 1) | 15     | [ 15/15]|
| ↳ Uses Laravel routing/controllers        | T/F    | [ T     |
| Eloquent ORM usage (no raw SQL)           | 15     | [ 15/15]  |
| ↳ Proper model relationships              | T/F    | [ T/F ] |
| Laravel authentication implementation     | 10     | [ 10/10]  |
| ↳ Bearer token authentication working     | T/F    | [ T] |
| **Total**                                 | **40** | [ 40/40]  |

---

## 🔹 Deploy with a shell script (40 pts)

- [ 15/15] Understand **existing shell script examples** from course materials as reference
  - Reference materials used:Course shell script examples and Laravel documentation
  - [T] Properly adapted existing scripts for Laravel
- [15 /15] Created **automated deployment script** (`run.sh`) for one-command Laravel deployment
  - Script file name:run.sh
  - [T] Script successfully deploys Laravel application
- [10 /10] Created a screen capture to show the script can start the Laravel REST API project
  - GitHub Link or Filename of the screen capture:code/screenshots/run_sh_success.png
  - [T] Screen capture included

---

| Task                                  | Points | Earned  |
|---------------------------------------|--------|---------|
| Automated deployment script (run.sh)  | 15     | [ 15/15]  |
| ↳ Script successfully deploys Laravel | T/F    | [ T ] |
| Used existing shell script examples   | 15     | [ 15/15]  |
| ↳ Properly adapted for Laravel        | T/F    | [ T ] |
| Created a screen capture              | 10     | [ 10/10]  |
| ↳ Clear success/failure messages      | T/F    | [ T ] |
| **Total**                             | **40** | [ 40/40]  |

---

## FAQ

Q: For screen capture, what should I do?
A: You should prove that your code (or script) works by screen capture your output. After the screen capture, you can include that in your document, upload to GitHub, or copy the screen capture as part of your submission, and share the link or file name.

---

## 🔹 Deploy with Docker (40 pts)

- [ 15/15] **Containerized Laravel application** using Docker and Docker Compose
  - Docker files created:Dockerfile, docker-compose.yml, nginx/default.conf
  - [T] Dockerfile properly configured for Laravel
- [ 15/15] Created **setup script** (`setup.sh`) for one-command Docker deployment
  - Setup script file name:setup.sh
  - [T] Script successfully builds and runs Docker containers
- [ 10/10] Created a screen capture to show the script can setup and run Docker
  - GitHub Link or Filename of the screen capture:code/screenshots/docker_success.png
  - [T/F] Screen capture included

---

| Task                                  | Points | Earned  |
|---------------------------------------|--------|---------|
| Docker containerization (Laravel app) | 15     | [ 15/15]  |
| ↳ Dockerfile properly configured      | T/F    | [ T ] |
| Setup script for Docker deployment    | 15     | [ 15/15]  |
| ↳ Script builds and runs containers   | T/F    | [ T ] |
| Created a screen capture              | 10     | [ 10/10]  |
| ↳ Clear success/failure messages      | T/F    | [ T ] |
| **Total**                             | **40** | [ 40/40]  |

---

## 🔹 Re-implement Project 1 Documentation (40 pts)

- [ 15/15] **Re-implemented Project 1 documentation** using Hugo (transformed from Marp)
  - Hugo site structure created:content/, layouts/, static/ directories with custom templates
  - [T] Successfully converted Marp to Hugo markdown
- [15 /15] **Added portfolio pages** to Hugo site
  - Portfolio pages added:Home, About, Documentation, API Reference
  - [T] Portfolio showcases ASE230 projects effectively
- [ 1O/10] Created a screen capture to show you can use Hugo to build web site for your portfolio
  - GitHub Link or Filename of the screen capture:code/screenshots/github_pages_live.png
  - [T] Screen capture included

---

| Task                             | Points | Earned  |
|----------------------------------|--------|---------|
| Hugo documentation (from Marp)   | 15     | [ 15/15]  |
| ↳ Successfully converted to Hugo | T/F    | [ T ] |
| Portfolio pages added to Hugo    | 15     | [15 /15]  |
| ↳ Effective project showcase     | T/F    | [ T ] |
| Created a screen capture         | 10     | [10 /10]  |
| ↳ Clear success/failure messages | T/F    | [ T ] |
| **Total**                        | **40** | [ 40/40]  |

---

## FAQ

Q1: What information do I upload for my GitHub.io?
A1: For REST API, you upload your project 1 document. For your portfolio page, it's up to you; upload your projects so far.

Q2: I don't know what information do I upload to Hugo about my portfolio. What should I do?
A2: As a starter, you can add your ASE230 projects (PHP/Laravel REST API implementation, documentation using Hugo/Marp, and deployment using Docker & GitHub action); you can add more projects in the future.

---

## 🔹 Automatic Deploy to GitHub.io (40 pts)

- [ 15/15] **Published documentation to GitHub.io** using GitHub Actions
  - GitHub.io site URL:https://BElmane.github.io/ASE-230-repo/
  - [T] Site is publicly accessible and functional
- [15 /15] **Uploaded complete source to GitHub** for automatic transformation
  - GitHub repository URL:https://github.com/BElmane/ASE-230-repo
  - [T] GitHub Actions successfully builds and deploys
- [ 10/10] Created a screen capture to show you can run GitHub.io to deploy Hugo project
  - GitHub Link or Filename of the screen capture:code/screenshots/github_actions_success.png
  - [T] Screen capture included

---

### Grading Rule

- If you finished the task, give full points & select T.
- If you finished only partially, give partial points & select T.
- If you did not finish the task, select F.

Professor will regrade to add or subtract points.

---

| Task                                  | Points | Earned  |
|---------------------------------------|--------|---------|
| GitHub.io publication                 | 15     | [ 15/15]  |
| ↳ Site publicly accessible            | T/F    | [ T ] |
| Complete source uploaded to GitHub    | 15     | [ 15/15]  |
| ↳ GitHub Actions builds and deploys   | T/F    | [ T ] |
| GitHub Actions workflow configuration | 10     | [ 10/10]  |
| ↳ Automatic deployment on push        | T/F    | [ T] |
| **Total**                             | **40** | [ 40/40]  |

---

## 🏁 Final Checks

- [✓ ] I understand that I may deduct points if the results are of poor quality.
- [✓ ] I understand that I may be reported as plagiarism if I used other work (including AI) without proper reference.
- [ ✓] Pushed to GitHub
- [✓ ] Zipped the code/document.
- [ ✓] Checked there is no .git directory or any hidden directories included from the zipped file size (code.zip: 1.7M;presentation.zip: 25K). <- write the file sizes
- [ ✓] Copy zipped files in correct directory: `code/`, `presentation/`, `plan/`  
- [ ✓] Project ready for **professional portfolio showcase**  
- [ ✓] Hugo site deployed to GitHub.io and accessible  

---

## 📊 Project 2 Total Points

| Task                                    | Points  | Earned  |
|-----------------------------------------|---------|---------|
| 🔹 Laravel Implementation               | 40      | [ 40/40]  |
| 🔹 Deploy with a shell script           | 40      | [ 40/40]  |
| 🔹 Deploy with Docker                   | 40      | [ 40/40]  |
| 🔹 Re-implement Project 1 Documentation | 40      | [ 40/40]  |
| 🔹 Automatic Deploy to GitHub.io        | 40      | [ 40/40]  |
| **Total**                               | **200** | [200 /200] |

---

Ask any questions when you need help!
