<?php
    include "../../koneksi.php";

    session_start();

    $success = isset($_SESSION['success']) ? $_SESSION['success'] : "";
    unset($_SESSION['success']);

    // Jika pengguna belum login, arahkan kembali ke halaman login.php
    if (!isset($_SESSION['username'])) {
        header("Location: ../login/login.php");
        exit();
    }

    // Ambil nilai session username dan nama
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
    $level = $_SESSION['level'];

    $activePage = "pembelian";

    $sql = "SELECT id, jenis, harga FROM bbm";
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
                <a href="index.php"
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
    <hr>

    <div class="container mb-3">
        <div class="row">
            <P>Home >> Pembelian</P>
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

    <div class="container" style="height: 70vh !important;">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <form action="InsertController.php" method="post">
                        <input type="hidden" value="<?php echo $id; ?>" name="users_id">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6">
                                        Jenis Bahan Bakar :
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select bahanBakar" onchange="isiHargaBBM(this)"
                                            name="bbm_id">
                                            <option selected>Pilih Bahan Bakar</option>
                                            <?php 
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . $row["id"] . '" data-harga="' . $row["harga"] . '">' . $row["jenis"] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6">
                                        Harga Per Liter :
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control hargaBbm" placeholder="Harga Per Linter"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6">
                                        Jumlah Uang (Rp.) :
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control inputUang"
                                            placeholder="Jumlah Uang (Rp.)" name="jumlah_uang" oninput="hitungHasil()"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6">
                                        Jumlah Liter
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control inputLiter" placeholder="Jumlah Liter"
                                            name="jumlah_liter" readonly>
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


    <script>
        function isiHargaBBM(selectElement) {
            const hargaBBMInput = document.querySelector('.hargaBbm');
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const hargaBBM = selectedOption.getAttribute('data-harga');
            hargaBBMInput.value = hargaBBM;
            const inputUang = document.querySelector('.inputUang');
            inputUang.removeAttribute('disabled');
        }

        function hitungHasil() {
            const hargaBBM = parseFloat(document.querySelector('.hargaBbm').value);
            const inputUang = parseFloat(document.querySelector('.inputUang').value);
            const hasil = inputUang / hargaBBM;
            document.querySelector('.inputLiter').value = hasil.toFixed(2);
        }
    </script>
    <!-- End Footer -->
    <script src="../../assets/js/bootstrap.min.js"></script>
</body>

</html>