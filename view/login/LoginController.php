<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include '../../koneksi.php';


session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = mysqli_query($connect, "select * from users where username='$username'");
    $data = mysqli_fetch_array($sql);
    $jml = mysqli_num_rows($sql);
    
    // Cek Username
    if ($jml > 0) {
        if (password_verify($password, $data['password'])) {
            $_SESSION['success'] = "Login Success!!!";

            $_SESSION['id'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['level'] = $data['level'];
            $_SESSION['tgl_lahir'] = $data['tgl_lahir'];


            header("Location: ../dashboard/index.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Error: Invalid username or password.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Error: Invalid username or . password";
        header("Location: login.php");
        exit();
    }

}
?>
