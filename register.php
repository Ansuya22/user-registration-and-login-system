<?php
require 'database.php';
require 'helpers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($username) || empty($password)) {
        header("Location: index.php?error=" . urlencode("Username and password are required."));
        exit;
    }

    // Check if username already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        header("Location: index.php?error=" . urlencode("Username already exists. Please choose a different username."));
        exit;
    }

    $passwordError = validatePassword($password);
    if ($passwordError) {
        header("Location: index.php?error=" . urlencode($passwordError));
        exit;
    }

    // Hash password and insert into database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->execute([':username' => $username, ':password' => $hashedPassword]);

    header("Location: index.php?success=1");
    exit;
}
?>