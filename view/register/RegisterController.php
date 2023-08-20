<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include '../../koneksi.php';

// Validate form data
$errors = [];
$name = "";
$username = "";
$tgl_lahir = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if password is empty
    if (empty($password)) {
        $errors[] = "Error: Password cannot be empty.";
    }

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        // Passwords do not match
        $errors[] = "Error: Passwords do not match.";
    }

    // var_dump($errors);

    // Check if the username already exists
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($connect, $check_query);
    if (mysqli_num_rows($result) > 0) {
        // Username already exists
        $errors[] = "Error: Username already exists. Please choose a different username.";
    }

    if (empty($errors)) {
        // Encrypt the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // var_dump($hashed_password);
        // die;
        // Insert user data into database
        $stmt = $connect->prepare("INSERT INTO users (name, username, tgl_lahir, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $username, $tgl_lahir, $hashed_password);

        if ($stmt->execute()) {
            session_start();
            $_SESSION['success_message'] = "Registration successful. Please login with your credentials.";
            header("Location: ../login/login.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Error: Registration failed.";
            header("Location: ../register.php");
            exit();
        }

        mysqli_close($connect);
    }
}

// Redirect to register.php with errors (if any)
if (!empty($errors)) {
    session_start();
    $_SESSION['errors'] = $errors;
    $_SESSION['name'] = $name;
    $_SESSION['username'] = $username;
    $_SESSION['tgl_lahir'] = $tgl_lahir;
    header("Location: register.php");
    exit();
}
?>