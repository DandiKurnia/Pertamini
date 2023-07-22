<?php
session_start();

// Hapus session saat pengguna logout
session_unset();
session_destroy();

// Set pesan untuk ditampilkan setelah logout
$_SESSION['logout_message'] = "Anda telah berhasil logout.";

header("Location: ../view/login/login.php"); // Arahkan kembali ke halaman login setelah logout
exit();
?>
