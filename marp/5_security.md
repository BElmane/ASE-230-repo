---
marp: true
theme: default
paginate: true
---

# API Security
## How I Secured My Enrollment APIs

**By: Bebba**
**Project 1 - ASE 230**

---

# Why Do We Need Security?

**The Problem:**
Not everyone should be able to do everything!

**Example:**
-  Anyone can VIEW students and courses (that's OK)
-  Only staff should ENROLL students in classes
-  Only staff should DROP students from classes

**Solution:** Bearer Token Authentication 

---

# What's a Bearer Token?

Think of it like a VIP pass or secret key.

**How it works:**
1. You get a special token (like a password)
2. You include it in your request
3. API checks: "Do you have the right token?"
4. If YES → Request allowed
5. If NO → Request blocked 

**My tokens:**
- `secret_bebba_key_2025`
- `super_secure_token`

Only people with these tokens can use secured APIs!

---

# Which APIs Are Secured?

##  SECURED (Need Bearer Token):
1. **POST /api/enrollments/create.php**
   - Enroll a student in a course
   
2. **DELETE /api/enrollments/delete.php**
   - Remove a student from a course

##  NOT SECURED (Anyone Can Use):
- All 5 Student APIs
- All 2 Course APIs
- 1 Grades API

**Total: 2 out of 10 APIs are secured**

---

# How to Use Bearer Token

**Format:**
```
Authorization: Bearer <your_token_here>
```

**Example with curl:**
```bash
curl -X POST http://localhost:8000/api/enrollments/create.php \
  -H "Authorization: Bearer secret_bebba_key_2025" \
  -H "Content-Type: application/json" \
  -d '{
    "student_id": 1,
    "course_id": 2
  }'
```

**The important part:**
```
-H "Authorization: Bearer secret_bebba_key_2025"
```

Without this header → Request DENIED!

---

# What Happens Without Token?

**Request WITHOUT token:**
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

**The API says:** "Stop! You need a token to do this!" 

---

# What Happens with WRONG Token?

**Request with invalid token:**
```bash
curl -X POST http://localhost:8000/api/enrollments/create.php \
  -H "Authorization: Bearer wrong_fake_token" \
  -H "Content-Type: application/json" \
  -d '{
    "student_id": 1,
    "course_id": 2
  }'
```

**Response:**
```json
{
  "error": "Invalid token"
}
```

**Status Code:** 403 Forbidden

**The API says:** "I see your token, but it's not valid!"

---

# How I Implemented Security

**Location:** `config/database.php`

**The `validateToken()` function:**
```php
function validateToken() {
    // Get headers from request
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? '';
    
    // Check if Authorization header exists
    if (empty($authHeader)) {
        sendJSON(['error' => 'Authorization header missing'], 401);
    }
    
    // Extract token from "Bearer <token>"
    if (preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
        $token = $matches[1];
        
        // Check if token is valid
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

**In both enrollment APIs:**
```php
<?php
require_once '../../config/database.php';

// REQUIRE BEARER TOKEN
validateToken();

// Rest of the code...
```

**That's it!** Just one line: `validateToken();`

If the token is missing or wrong, the function stops everything and returns an error.

---

# Security Flow Diagram
```
User sends request
      ↓
Does request have "Authorization" header?
      ↓ NO → Return 401 "Authorization header missing"
      ↓ YES
      ↓
Extract token from header
      ↓
Is token in valid list?
      ↓ NO → Return 403 "Invalid token"
      ↓ YES
      ↓
 Allow request to proceed
```

---

# Why This Security Matters

**Real-world scenario:**

**Without security:**
- Students could enroll themselves in any class
- Students could drop other students from classes
- Anyone could mess up the enrollment system! 

**With Bearer token security:**
- Only staff with the token can enroll students
- Only staff with the token can drop students 
- System is protected! 

---

# Security Summary

**What I implemented:**
- Bearer Token Authentication
- Token validation function
- Proper error responses (401, 403)

**Where it's used:**
- Enrollment creation API
- Enrollment deletion API

**How it works:**
- Check for Authorization header
- Validate token against valid list
- Block request if invalid

**Result:**
2 APIs are properly secured! 

---

# Testing Security

**Test 1: Valid Token **
```bash
curl -H "Authorization: Bearer secret_bebba_key_2025" ...
```
Result: Works! 200/201 response

**Test 2: No Token **
```bash
curl ... (no Authorization header)
```
Result: 401 Unauthorized

**Test 3: Wrong Token**
```bash
curl -H "Authorization: Bearer fake_token" ...
```
Result: 403 Forbidden

**All security tests pass!**

---

# Summary

 **2 APIs secured** with Bearer token
 **Token validation** works correctly  
 **Proper error codes** (401, 403)
 **Easy to use** - just add header
 **Protects sensitive operations** (enrollments)

