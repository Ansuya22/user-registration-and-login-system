<?php
require 'database.php';
$error = "";

if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}

if (isset($_GET['success'])) {
    $success = "Registration successful! Please log in.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register and Login</title>
    <script>
        function toggleSection(section) {
            document.getElementById('register-section').style.display = section === 'register' ? 'block' : 'none';
            document.getElementById('login-section').style.display = section === 'login' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <h1>Welcome</h1>
    <?php if (!empty($error)) : ?>
        <div style="color: red;"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if (!empty($success)) : ?>
        <div style="color: green;"><?php echo $success; ?></div>
    <?php endif; ?>

    <div id="register-section">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="javascript:toggleSection('login')">Login here</a>.</p>
    </div>

    <div id="login-section" style="display: none;">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="javascript:toggleSection('register')">Register here</a>.</p>
    </div>
</body>
</html>
