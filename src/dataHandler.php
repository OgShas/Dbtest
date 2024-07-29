<?php

require_once 'db-connection.php';

class DataHandler
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function isAdmin($username, $password) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM admins WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }
    public function getStudents()
    {
        $query = "SELECT id , name, username  FROM students";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTowns()
    {
        $query = "SELECT id, name FROM town";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourse()
    {
        $query = "SELECT id, name FROM courses";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_Student_Course()
    {
        $query = "
  SELECT
    s.name AS student_name,
    c.name AS course_name
FROM
    studentscourses sc
JOIN
    students s ON sc.studentID = s.id
JOIN
    courses c ON sc.courseID = c.id;
";

        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addStudent($username, $name, $townID)
    {
        $query = "INSERT INTO students (Username, Name, townID) VALUES (:username, :name, :townID)";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':townID', $townID, PDO::PARAM_INT);

        $stmt->execute();
        return $this->db->lastInsertID();
    }

    public function addStudentToCourse($studentID, $courseID)
    {
        $query = "INSERT INTO studentscourses (studentID, courseID) VALUES (:studentID, :courseID)";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':studentID', $studentID, PDO::PARAM_INT);
        $stmt->bindParam(':courseID', $courseID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getStudentCourses($studentID)
    {
        $query = "
        SELECT
            c.id AS course_id,
            c.name AS course_name
        FROM
            studentscourses sc
        JOIN
            courses c ON sc.courseID = c.id
        WHERE
            sc.studentID = :studentID
    ";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':studentID', $studentID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeStudentFromCourse($studentID, $courseID)
    {
        $query = "DELETE FROM studentscourses WHERE studentID = :studentID AND courseID = :courseID";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':studentID', $studentID, PDO::PARAM_INT);
        $stmt->bindParam(':courseID', $courseID, PDO::PARAM_INT);
        return $stmt->execute();
    }

}