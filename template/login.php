<?php
session_start();
require_once '../src/dataHandler.php';

$dataHandler = new DataHandler();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = $dataHandler->getUserByUsername($username);

    var_dump($user);
    var_dump($password);

    if ($user && $user['password']){
        $_SESSION['student_id'] = $user['Id'];
        $_SESSION['username'] = $user['Username'];

        header("Location: ../home.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>

<h1>Login</h1>
<form method="POST" action="login.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>
