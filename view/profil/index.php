<?php
    include "../../koneksi.php";

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    session_start();

    $success = isset($_SESSION['success']) ? $_SESSION['success'] : "";
    unset($_SESSION['success']);

    // Jika pengguna belum login, arahkan kembali ke halaman login.php
    if (!isset($_SESSION['username'])) {
        header("Location: ../login/login.php");
        exit();
    }

    // Ambil nilai session username dan nama
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
    $level = $_SESSION['level'];
    $tgl_lahir = $_SESSION['tgl_lahir'];
    $id = $_SESSION['id'];

    $activePage = "profil";

    $sql = "SELECT pembelian.*, users.name, bbm.jenis
        FROM pembelian
        INNER JOIN users ON pembelian.users_id = users.id
        INNER JOIN bbm ON pembelian.bbm_id = bbm.id
        WHERE users.username = '$username'";
    
    $result = mysqli_query($connect, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<?php include "../partials/head.php" ?>

<body>

    <nav class="navbar navbar-expand-lg" style="background-color: #fff !important;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <div class="d-flex align-items-end">
                    <img src="../../assets/img/pertamina.png" alt="Logo" width="200"
                        class="d-inline-block align-text-top me-lg-2">
                    <h6 class="text-black text-bold mb-0">Pertamina</h6>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <hr>

    <!-- Menu -->

    <div class="container">
        <div class="col-12 text-right mt-3" style="text-align: right !important">
            <div class="menu">
                <a href="../dashboard/index.php"
                    class="text-decoration-none noActive me-1 <?php echo ($activePage == 'dashboard') ? 'active' : ''; ?>">Dashboard</a>
                <a href="index.php"
                    class="text-decoration-none noActive me-1 <?php echo ($activePage == 'profil') ? 'active' : ''; ?>">Profil</a>
                <a href="../pembelian/index.php"
                    class="text-decoration-none noActive me-1 <?php echo ($activePage == 'pembelian') ? 'active' : ''; ?>">Pembelian</a>
                <?php 
                    if ($level == "admin"){ ?>
                <a href="../bbm/index.php"
                    class="text-decoration-none noActive me-1 <?php echo ($activePage == "bbm") ? "active" : ""; ?>">BBM</a>
                <?php }
                ?>
                <a href="../../controller/LogoutController.php" class="text-decoration-none noActive">Logout</a>
            </div>
        </div>
    </div>

    <!-- Menu -->

    <hr>

    <div class="container mb-3">
        <div class="row">

            <P>Home >> profil</P>

            <!-- Alert -->
            <?php if (!empty($success)) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $success; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            <!-- End Alert -->
        </div>
    </div>

    <div class="container" style="height: 70vh !important;">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <form action="UpdateController.php" method="post">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6">
                                        Name :
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Name" name="name" required
                                            value="<?php echo $name; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6">
                                        Username :
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Username" name="username"
                                            value="<?php echo $username; ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6">
                                        Tanggal Lahir :
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" placeholder="Username" name="tgl_lahir"
                                            value="<?php echo $tgl_lahir; ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "../partials/footer.php"?>
    <!-- End Footer -->
    <script src="../../assets/js/bootstrap.min.js"></script>
</body>

</html>