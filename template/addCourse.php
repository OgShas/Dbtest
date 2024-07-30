<?php
require_once '../src/db-connection.php';
require_once '../src/dataHandler.php';

session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$dataHandler = new DataHandler();
$conn = new Database();

// Get the current student ID from the session
$currentStudentID = $_SESSION['student_id'];

// Fetch the current student details
$currentStudent = $dataHandler->getStudentById($currentStudentID);
$courses = $dataHandler->getCourse();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add_course':
            $courseID = $_POST['course'] ?? '';

            if (!is_numeric($courseID)) {
                die("Invalid course ID");
            }

            // Only allow assigning courses to the logged-in student
            $add_course_to_student = $dataHandler->addStudentToCourse($currentStudentID, $courseID);

            if ($add_course_to_student) {
                echo "Course assigned successfully!";
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

<h1>Assign Course to Yourself</h1>

<!-- Display current student information -->
<p><strong>Student ID:</strong> <?php echo htmlspecialchars($currentStudent['id']); ?></p>
<p><strong>Student Name:</strong> <?php echo htmlspecialchars($currentStudent['name']); ?></p>

<form method="POST" action="">
    <input type="hidden" name="action" value="add_course">

    <label for="course">Course:</label>
    <select id="course" name="course" required>
        <option value="">Select a course</option>
        <?php foreach ($courses as $course): ?>
            <option value="<?php echo htmlspecialchars($course['id']); ?>"><?php echo htmlspecialchars($course['name']); ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" value="Assign Course">
</form>
<a href="../home.php" class="btn btn-secondary mt-3">Go to Home</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
