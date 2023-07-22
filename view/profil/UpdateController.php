<?php 
include "../../koneksi.php";

session_start();

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $new_name = $_POST['name'];
    $new_username = $_POST['username'];
    $new_tgl_lahir = $_POST['tgl_lahir'];

    $sql = "UPDATE users SET name = '$new_name', username = '$new_username', tgl_lahir = '$new_tgl_lahir' WHERE username = '$username'";
        if (mysqli_query($connect, $sql)) {
            $_SESSION['success'] = "Profil Telah di ubah";

            $_SESSION['username'] = $new_name;
            $_SESSION['name'] = $new_username;
            $_SESSION['tgl_lahir'] = $new_tgl_lahir;
            header("Location: index.php");
        }

}

?>