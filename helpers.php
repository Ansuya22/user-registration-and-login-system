<?php
function validatePassword($password) {
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must contain at least one uppercase letter.";
    }
    if (!preg_match('/\d/', $password)) {
        return "Password must contain at least one number.";
    }
    return null;
}

function validateFile($file) {
    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    $maxSize = 2 * 1024 * 1024;

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return "Error uploading file.";
    }
    if (!in_array($file['type'], $allowedTypes)) {
        return "Invalid file type. Allowed types are JPEG, PNG, and PDF.";
    }
    if ($file['size'] > $maxSize) {
        return "File size exceeds the 2MB limit.";
    }
    return null;
}
?>