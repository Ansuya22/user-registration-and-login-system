<?php
require 'database.php';
require 'helpers.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['file'];

    $fileError = validateFile($file);
    if ($fileError) {
        die($fileError);
    }

    // File upload handling
    $uploadDir = 'uploads/';
    if (!is_dir(__DIR__ . '/' . $uploadDir)) {
        mkdir(__DIR__ . '/' . $uploadDir, 0755, true);
    }
    $fileName = uniqid() . '_' . basename($file['name']);
    $filePath = __DIR__ . '/' . $uploadDir . $fileName;
    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        die("File upload failed.");
    }

    // Save file path to database
    $stmt = $pdo->prepare("UPDATE users SET file_path = :file_path WHERE username = :username");
    $stmt->execute([':file_path' => $uploadDir.$fileName, ':username' => $_SESSION['user']]);

    echo "File uploaded successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?></h1>
    <p>This is your dashboard. You can upload a file below:</p>

    <form action="dashboard.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required><br>
        <button type="submit">Upload File</button>
    </form>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
