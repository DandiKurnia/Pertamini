<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include '../../koneksi.php';

$username = "";


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    // Tangkap data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    // Cek apakah ada user dengan username dan password yang sesuai
    $stmt = $connect->prepare("SELECT password, id, name,tgl_lahir,level FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password, $id, $name, $tgl_lahir, $level);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['success'] = "Login Success!!!";   

        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['tgl_lahir'] = $tgl_lahir;
        $_SESSION['level'] = $level;

        header("Location: ../dashboard/index.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: Invalid username or password.";
        $_SESSION['inputUsername'] = $username;

        header("Location: login.php");
        exit();
    }

    $connect->close();
}
?>