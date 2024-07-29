<?php
session_start();

require_once '../src/dataHandler.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dataHandler = new DataHandler();
$courses = $dataHandler->getCourse();
$students = $dataHandler->getStudents();
$towns = $dataHandler->getTowns();
$student_course = $dataHandler->get_Student_Course();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="p-3 border bg-light">
                <h1>Courses</h1>
                <br>
                <?php foreach ($courses as $course) : ?>
                    <p><?php echo 'id = ' . htmlspecialchars($course['id']) . '  name = ' . htmlspecialchars($course['name']); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="p-3 border bg-light">
                <h1>Towns</h1>
                <br>
                <?php foreach ($towns as $town) : ?>
                    <p> <?php echo 'id = ' . htmlspecialchars($town['id']) . ' name = ' . htmlspecialchars($town['name']); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="p-3 border bg-light">
                <h1>Students</h1>
                <br>
                <?php foreach ($students as $student) : ?>
                    <p> <?php echo 'id = ' . htmlspecialchars($student['id']) . ' name = ' . htmlspecialchars($student['username']); ?> </p>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="p-3 border bg-light">
                <h2>Student - Course</h2>
                <br>
                <?php foreach ($student_course as $value) : ?>
                    <p> <?php echo htmlspecialchars($value['student_name']) . ' course = ' . htmlspecialchars($value['course_name']); ?> </p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
