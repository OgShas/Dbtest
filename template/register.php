
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

<h1>Add New Student</h1>
<form method="POST" action="?action=add_student">
    <input type="hidden" name="action" value="add_student">

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

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
    <input type="submit" value="Add Student">
</form>
