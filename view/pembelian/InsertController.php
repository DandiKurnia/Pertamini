<?php 
include "../../koneksi.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $users_id = $_POST['users_id'];
    $bbm_id = $_POST['bbm_id'];
    $jumlah_liter = $_POST['jumlah_liter'];
    $jumlah_uang = $_POST['jumlah_uang'];
    $date = date("Y-m-d");

        $sql = "INSERT INTO pembelian (id, users_id, bbm_id, tanggal_pembelian, jumlah_liter, jumlah_uang) VALUES (null,'$users_id', '$bbm_id', '$date', '$jumlah_liter', '$jumlah_uang')";
        
        if (mysqli_query($connect, $sql)) {
            $_SESSION['success'] = " Transaksi Behasil!!";
            header("Location: index.php");
        } else {
            $_SESSION['error'] = "data tidak masuk";
            header("Location: index.php");
        }

    
}

?>