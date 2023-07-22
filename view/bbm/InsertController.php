<?php 
include "../../koneksi.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    
    // Check jenis bbm
    $check_query = "SELECT * FROM bbm WHERE jenis='$jenis'";
    $result = mysqli_query($connect, $check_query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = "Jenis BBM sudah ada";
        header("Location: index.php");
    } else {
        $sql = "INSERT INTO bbm (id,jenis, harga) VALUES (null,'$jenis', '$harga')";
        
        if (mysqli_query($connect, $sql)) {
            $_SESSION['success'] = "Jenis BBM berhasil dimasukan";
            header("Location: index.php");
        }
    }

    
}

?>