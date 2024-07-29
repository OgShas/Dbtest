<?php
require_once '../src/db-connection.php';
require_once '../src/dataHandler.php';

$dataHandler = new DataHandler();
$conn = new Database();

$students = $dataHandler->getStudents();
$towns = $dataHandler->getTowns();
$courses = $dataHandler->getCourse();
$student_course = $dataHandler->get_Student_Course();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';

    switch ($action) {
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

<h1>Assign Course to Existing Student</h1>

<form method="POST" action="?action=add_course">
    <input type="hidden" name="action" value="add_course">

    <label for="student">Student:</label>
    <select id="student" name="student" required>
        <option value="">Select a student</option>
        <?php foreach ($students as $student): ?>
            <option value="<?php echo htmlspecialchars($student['id']); ?>"><?php echo htmlspecialchars($student['name']); ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="course">Course:</label>
    <select id="course" name="course" required>
        <option value="">Select a course</option>
        <?php foreach ($courses as $course): ?>
            <option value="<?php echo htmlspecialchars($course['id']); ?>"><?php echo htmlspecialchars($course['name']); ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" value="Assign Course">
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>

