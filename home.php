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
echo "<p>Add Course</p>";
?>

<a href="template/addCourse.php">Go to Add Course Page</a>

<!-- Logout Form -->
<form method="POST" action="template/logout.php" style="margin-top: 20px;">
    <input type="submit" value="Log Out" class="btn btn-danger">
</form>
