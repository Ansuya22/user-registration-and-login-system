# User Registration and Login System with File Upload

# Overview
This project implements a user registration and login system with the ability to upload a file using vanilla PHP.

# Features
User Registration: Allows users to register with their email, password, and file upload.

User Login: Allows users to log in with their email and password.

File Upload: Users can upload a file (e.g., profile picture or document) during registration.

Session Management: Keeps track of the logged-in user using PHP sessions.

# Requirements
PHP 7.4 or higher

MySQL database

A web server like Apache or Nginx

# Installation

# 1. Clone the Repository

Clone this repository to your local machine:

```
git clone https://github.com/Ansuya22/user-registration-and-login-system.git
cd user-registration-and-login-system
```

# 2. Database Setup

```
CREATE DATABASE testdb;
USE testdb;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);
```

