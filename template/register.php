<?php
require_once '../src/dataHandler.php';

$dataHandler = new DataHandler();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $name = $_POST['name'] ?? '';
    $townID = $_POST['town'] ?? '';
    $courseID = $_POST['course'] ?? '';

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    if (!is_numeric($townID) || !is_numeric($courseID)) {
        die("Invalid town or course ID");
    }

    // Add the student
    $addStudent = $dataHandler->addStudent($username, $password, $name, $townID);

    if ($addStudent) {
        $studentID = $addStudent;
        // Add the student to the course
        $add_current_student_to_course = $dataHandler->addStudentToCourse($studentID, $courseID);

        if ($add_current_student_to_course) {
            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $add_current_student_to_course->errorInfo()[2];
        }
    } else {
        echo "Error: " . $addStudent->errorInfo()[2];
    }
}

$towns = $dataHandler->getTowns();
$courses = $dataHandler->getCourse();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student</title>
</head>
<body>
<h1>Add New Student</h1>
<form method="POST" action="register.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br><br>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="town">Town:</label>
    <select id="town" name="town" required>
        <option value="">Select a town</option>
        <?php foreach ($towns as $town): ?>
            <option value="<?php echo htmlspecialchars($town['id']); ?>"><?php echo htmlspecialchars($town['name']); ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="course">Course:</label>
    <select id="course" name="course" required>
        <option value="">Select a course</option>
        <?php foreach ($courses as $course): ?>
            <option value="<?php echo htmlspecialchars($course['id']); ?>"><?php echo htmlspecialchars($course['name']); ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <input type="submit" value="Register">
</form>
</body>
</html>
