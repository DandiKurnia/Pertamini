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
    $id = $_SESSION['id'];

    $activePage = "dashboard";

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
                <a href="index.php"
                    class="text-decoration-none noActive me-1 <?php echo ($activePage == 'dashboard') ? 'active' : ''; ?>">Dashboard</a>
                <a href="../profil/index.php"
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

            <P>Home >> Dashboard</P>

            <!-- Alert -->
            <?php if (!empty($success)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            <!-- End Alert -->
        </div>
    </div>

    <div class="container" style="height: 70vh !important;">
        <div class="row">
            <div class="col-md-3" style="width: 18rem;">
                <div class="card p-3">
                    <img src="../../assets/img/avatar.jpg" alt="">
                    <div class="card-body" style="padding-left: 0 !important;">
                        <h5 class="text-capitalize" style="margin: 0 !important;"><?php echo $username ?></h5>
                        <h5 class="text-capitalize" style="margin: 0 !important;"><?php echo $name ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card p-2">
                    <div class="table-responsive"
                        style="overflow-y: auto; max-height: 100vh !important;height: 45vh !important;">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Jenis BBM</th>
                                    <th scope="col">Total Pembelian</th>
                                    <th scope="col">Total Liter</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomer = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $b = $row['tanggal_pembelian'];
                                    $date = new DateTime($b);
                                    echo "<tr>
                                            <th scope='row'>" . $nomer . "</th>
                                            <td>" . $date->format('d - M - Y') . "</td>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['jenis'] . "</td>
                                            <td>" . $row['jumlah_uang'] . "</td>
                                            <td>" . $row['jumlah_liter'] . "</td>
                                        </tr>";
                                        $nomer++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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