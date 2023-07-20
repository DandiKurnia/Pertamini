<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include '../koneksi.php';


session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate form data

    // Check if username is empty
    if (empty($username)) {
        $_SESSION['error_message'] = "Error: Username cannot be empty.";
        header("Location: login.php");
        exit();
    }

    // Check if password is empty
    if (empty($password)) {
        $_SESSION['error_message'] = "Error: Password cannot be empty.";
        header("Location: login.php");
        exit();
    }

    $stmt = $connect->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();


if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    // Print the hashed password for debugging

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        $_SESSION['success'] = "Login Success!!!";
        // Password is correct, set session variables and redirect to home page
        $_SESSION['username'] = $username;
        header("Location: ../view/index.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: Invalid username or password.";
        header("Location: ../view/login.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "Error: Invalid username or .";
    header("Location: ../view/login.php");
    exit();
}

}
?>
