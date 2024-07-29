<?php
require_once 'src/db-connection.php';
require_once 'src/dataHandler.php';

$dataHandler = new DataHandler();
$conn = new Database();

$students = $dataHandler->getStudents();
$towns = $dataHandler->getTowns();
$courses = $dataHandler->getCourse();
$student_course = $dataHandler->get_Student_Course();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add_student':
            $username = $_POST['username'] ?? '';
            $name = $_POST['name'] ?? '';
            $townID = $_POST['town'] ?? '';
            $courseID = $_POST['course'] ?? '';

            if (!is_numeric($townID) || !is_numeric($courseID)) {
                die("Invalid town or course ID");
            }

            $addStudent = $dataHandler->addStudent($username, $name, $townID);

            if ($addStudent) {
                $studentID = $addStudent;
                $add_current_student_to_course = $dataHandler->addStudentToCourse($studentID, $courseID);

                if ($add_current_student_to_course) {
                    echo "New student and course registration added successfully!";
                } else {
                    echo "Error: " . $add_current_student_to_course->errorInfo()[2];
                }
            } else {
                echo "Error: " . $addStudent->errorInfo()[2];
            }
            break;

        case 'add_course':
            $studentID = $_POST['student'] ?? '';
            $courseID = $_POST['course'] ?? '';

            if (!is_numeric($studentID) || !is_numeric($courseID)) {
                die("Invalid student or course ID");
            }

            $add_course_to_student = $dataHandler->addStudentToCourse($studentID, $courseID);

            if ($add_course_to_student) {
                echo "Course assigned to student successfully!";
            } else {
                echo "Error: " . $add_course_to_student->errorInfo()[2];
            }
            break;

        default:
            echo "Invalid action.";
            break;
    }

    $conn->closeConnection();
}
?>

<h1>Go to Admin Page</h1>
<p>
    <a href="admin/index.php" class="btn btn-primary">Admin Login</a>
</p>

<h1>Add New Student</h1>
<form method="get" action="template/register.php">
    <button type="submit" class="btn btn-primary"> Register</button>
</form>

<h1>Assign Course to Existing Student</h1>
<form method="get" action="template/addCourse.php">
    <button type="submit" class="btn btn-primary">
        Add Course
    </button>
</form>
