<?php
session_start();
require_once '../src/dataHandler.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: index.php");
    exit;
}

$dataHandler = new DataHandler();
$students = $dataHandler->getStudents();
$courses = $dataHandler->getCourse();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_course'])) {
        $studentId = $_POST['student_id'];
        $courseId = $_POST['course'];

        $dataHandler->addStudentToCourse($studentId, $courseId);
        header("Location: manageStudents.php");
        exit;
    }

    if (isset($_POST['remove_course'])) {
        $studentId = $_POST['student_id'];
        $courseId = $_POST['course_id'];

        // Remove the student from the selected course
        $dataHandler->removeStudentFromCourse($studentId, $courseId);
        header("Location: manageStudents.php");
        exit;
    }
}

$selectedStudentId = isset($_POST['student_id']) ? $_POST['student_id'] : null;
$currentCourses = $selectedStudentId ? $dataHandler->getStudentCourses($selectedStudentId) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <h1>Manage Students & Courses</h1>

    <!-- Select Student Form -->
    <form action="manageStudents.php" method="POST">
        <div class="mb-3">
            <label for="student" class="form-label">Select Student</label>
            <select id="student" name="student_id" class="form-select" onchange="this.form.submit()">
                <option value="">--Select Student--</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?php echo htmlspecialchars($student['id']); ?>" <?php echo $selectedStudentId == $student['id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($student['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <!-- Show Current Courses and Management Options if a student is selected -->
    <?php if ($selectedStudentId): ?>
        <h2 class="mt-5">Manage Courses for <?php echo htmlspecialchars($students[array_search($selectedStudentId, array_column($students, 'id'))]['name']); ?></h2>

        <!-- Display Current Courses -->
        <h3>Current Courses</h3>
        <ul class="list-group mb-3">
            <?php if (count($currentCourses) > 0): ?>
                <?php foreach ($currentCourses as $course): ?>
                    <li class="list-group-item">
                        <?php echo htmlspecialchars($course['course_name']); ?>
                        <!-- Remove Course Form -->
                        <form action="manageStudents.php" method="POST" class="d-inline float-end ms-2">
                            <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($selectedStudentId); ?>">
                            <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course['course_id']); ?>">
                            <button type="submit" name="remove_course" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No courses assigned</li>
            <?php endif; ?>
        </ul>

        <!-- Add Course Form -->
        <h3>Add New Course</h3>
        <form action="manageStudents.php" method="POST">
            <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($selectedStudentId); ?>">
            <div class="mb-3">
                <label for="course" class="form-label">Select Course</label>
                <select id="course" name="course" class="form-select" required>
                    <option value="">--Select Course--</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo htmlspecialchars($course['id']); ?>">
                            <?php echo htmlspecialchars($course['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="add_course" class="btn btn-primary">Add Course</button>
        </form>

    <?php endif; ?>

    <!-- Display Student-Course Information -->
    <h2 class="mt-5">Student-Course Information</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Student Name</th>
            <th>Course Name</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $studentCourses = $dataHandler->get_Student_Course();
        foreach ($studentCourses as $sc):
            ?>
            <tr>
                <td><?php echo htmlspecialchars($sc['student_name']); ?></td>
                <td><?php echo htmlspecialchars($sc['course_name']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
