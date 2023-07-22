<?php
    include "../../koneksi.php";

    session_start();

    // Jika pengguna belum login, arahkan kembali ke halaman login.php
    if (!isset($_SESSION['username'])) {
        header("Location: ../login/login.php");
        exit();
    }

    $success = isset($_SESSION['success']) ? $_SESSION['success'] : "";
    $error = isset($_SESSION['error']) ? $_SESSION['error'] : "";

    unset($_SESSION['success']);
    unset($_SESSION['error']);


    // Ambil nilai session username dan nama
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
    $level = $_SESSION['level'];

    $activePage = "bbm";

    $sql = "SELECT * FROM bbm";
    $result = $connect->query($sql);
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

    <div class="container">
        <div class="col-12 text-right mt-3" style="text-align: right !important">
            <div class="menu">
                <a href="../dashboard/index.php"
                    class="text-decoration-none noActive me-1 <?php echo ($activePage == 'dashboard') ? 'active' : ''; ?>">Dashboard</a>
                <a href="../profil/index.php"
                    class="text-decoration-none noActive me-1 <?php echo ($activePage == 'profil') ? 'active' : ''; ?>">Profil</a>
                <a href="../pembelian/index.php"
                    class="text-decoration-none noActive me-1 <?php echo ($activePage == 'pembelian') ? 'active' : ''; ?>">Pembelian</a>
                <?php 
                    if ($level == "admin"){ ?>
                <a href="index.php"
                    class="text-decoration-none noActive me-1 <?php echo ($activePage == "bbm") ? "active" : ""; ?>">BBM</a>
                <?php }
                ?>
                <a href="../../controller/LogoutController.php" class="text-decoration-none noActive">Logout</a>
            </div>
        </div>
    </div>
    <hr>

    <div class="container mb-3">
        <div class="row">
            <P>Home >> BBM</P>
            <!-- Alert Error -->
            <?php if (!empty($error)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            <!-- End Alert Error -->

            <!-- Alert Success -->
            <?php if (!empty($success)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            <!-- End Alert Success -->
        </div>
    </div>

    <div class="container" style="height: 100vh !important;">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <form action="InsertController.php" method="post">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6">
                                        Jenis Bahan Bakar :
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Jenis Bahan Bakar"
                                            name="jenis" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6">
                                        Harga Bahan Bakar
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" placeholder="Harga Bahan bakar"
                                            name="harga" required>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="table-responsive"
                        style="overflow-y: auto; max-height: 100vh !important;height: 45vh !important;">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jenis BBM</th>
                                    <th scope="col">Harga BBM</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $nomer = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<th scope='row'>" .$nomer . "</th>";
                                            echo "<td>" . $row["jenis"] . "</td>";
                                            echo "<td>" . $row["harga"] . "</td>";
                                            echo "<tr>";

                                            // Increment nomor urut
                                            $nomer++;
                                        }
                                    } else{
                                        echo "<tr><td colspan='2'>Tidak ada data.</td></tr>";
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