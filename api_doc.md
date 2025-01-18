# Authentication API Documentation

This API provides endpoints for user authentication, registration, password reset, and logout using Laravel Sanctum for token-based authentication.

---

## **Base URL**
All endpoints are relative to:
```
http://your-domain.com/api
```

---

## **Endpoints**

### **1. Login**
- **Endpoint:** `POST /login`
- **Description:** Authenticates a user and generates an access token.
- **Headers:**
  - `Content-Type: application/json`
- **Request Body:**
  ```json
  {
      "email": "user@example.com",
      "password": "password123"
  }
  ```
- **Responses:**
  - **200 OK:**
    ```json
    {
        "success": true,
        "message": "Login successful",
        "data": {
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "user@example.com"
            },
            "token": "your-api-token"
        }
    }
    ```
  - **401 Unauthorized:**
    ```json
    {
        "success": false,
        "message": "Invalid login details",
        "errors": null
    }
    ```
  - **422 Unprocessable Entity:** Validation errors.

---

### **2. Register**
- **Endpoint:** `POST /register`
- **Description:** Registers a new user.
- **Headers:**
  - `Content-Type: application/json`
- **Request Body:**
  ```json
  {
      "name": "John Doe",
      "email": "user@example.com",
      "password": "password123",
      "password_confirmation": "password123"
  }
  ```
- **Responses:**
  - **200 OK:**
    ```json
    {
        "success": true,
        "message": "User created successfully",
        "data": {
            "id": 1,
            "name": "John Doe",
            "email": "user@example.com"
        }
    }
    ```
  - **422 Unprocessable Entity:** Validation errors.

---

### **3. Password Reset**
- **Endpoint:** `POST /password-reset`
- **Description:** Sends a password reset link to the user's email.
- **Headers:**
  - `Content-Type: application/json`
- **Request Body:**
  ```json
  {
      "email": "user@example.com"
  }
  ```
- **Responses:**
  - **200 OK:**
    ```json
    {
        "success": true,
        "message": "A password reset link has been sent to your email address.",
        "data": []
    }
    ```
  - **400 Bad Request:** Unable to send link.
  - **422 Unprocessable Entity:** Validation errors.

---

### **4. Logout**
- **Endpoint:** `POST /logout`
- **Description:** Logs out the user by revoking the current token.
- **Headers:**
  - `Authorization: Bearer {token}`
  - `Content-Type: application/json`
- **Request Body:** None
- **Responses:**
  - **200 OK:**
    ```json
    {
        "success": true,
        "message": "Logged out successfully",
        "data": []
    }
    ```
  - **401 Unauthorized:**
    ```json
    {
        "success": false,
        "message": "Unauthorized",
        "errors": null
    }
    ```