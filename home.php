<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$studentID = $_SESSION['student_id'];
$username = $_SESSION['username'];

echo "<h1>Welcome, $username!</h1>";
echo "<p>This is your homepage.</p>";
echo "<p><a href='template/logout.php'>Logout</a></p>";
?>
