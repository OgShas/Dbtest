<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['student_id'])) {
    // Redirect to home.php if logged in
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration System</title>
</head>
<body>
<h1>Welcome to the Student Registration System</h1>

<!-- Display login and register links if not logged in -->
<a href="template/login.php">Login</a>
<a href="template/register.php">Register</a>

</body>
</html>
