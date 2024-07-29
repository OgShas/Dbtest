<?php
session_start();
require_once '../src/dataHandler.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: index.php");
    exit;
}

$dataHandler = new DataHandler();
$students = $dataHandler->getStudents();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <h1>Admin Dashboard</h1>
    <p><a href="studentsInfo.php" class="btn btn-primary">See Students Info</a></p>
    <p><a href="manageStudents.php" class="btn btn-secondary">Manage Students & Courses</a></p>
    <form action="logout.php" method="POST">
        <button type="submit" class="btn btn-secondary">Logout</button>
    </form>
</div>
</body>
</html>
