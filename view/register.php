<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

    session_start();
    $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
    $tgl_lahir = isset($_SESSION['tgl_lahir']) ? $_SESSION['tgl_lahir'] : "";
    
    unset($_SESSION['errors']);
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    unset($_SESSION['tgl_lahir']);

    $_SESSION['username'] = $username; // Simpan username yang sudah login ke dalam session
    header("Location: home.php"); // Arahkan ke halaman home.php atau halaman lain setelah login berhasil
    exit();

    $activePage = 'register';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        .container a:hover {
            color: #393646 !important;
            text-decoration: underline !important;
        }

        .noActive{
            color:rgba(84,83,83,1);
        }

        .active{
            color: #000 !important;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg" style="background-color: #0D71B0 !important;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <div class="d-flex align-items-end">
                    <img src="../assets/img/pertamini.png" alt="Logo" width="70" height="40"
                        class="d-inline-block align-text-top me-lg-2">
                    <h6 class="text-light text-bold mb-0">Pertamini</h6>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container">
        <div class="col-12 text-right mt-3" style="text-align: right !important">
            <a href="login.php" class="text-decoration-none noActive <?php echo ($activePage == 'login') ? 'class="active"' : ''; ?>">Login</a> ||
            <a href="register.php" class="text-decoration-none noActive <?php echo ($activePage == 'register') ? 'active' : ''; ?>">Register</a>
        </div>
    </div>
    <hr>

    <div class="container mb-3">
        <div class="row">
            <P>Home >> Register</P>
        </div>
    </div>

    <div class="container" style="height: 75vh !important;">
        <div class="row">
            <div class="col-5">
                <img src="" alt="">
            </div>
            <div class="col-6">
                <?php if (!empty($errors)) : ?>
                <div class="error">
                    <?php foreach ($errors as $error) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <form action="../controller/RegisterController.php" method="post">
                    <div class="mb-4">
                        <div>
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Nama Lengkap</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="name"
                                        style="width: 100% !important;" value="<?php echo htmlspecialchars($name); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div>
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Username</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" placeholder="Username" name="username"
                                        value="<?php echo htmlspecialchars($username); ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div>
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Tanggal Lahir</label>
                                </div>
                                <div class="col-8">
                                    <input type="date" class="form-control" placeholder="tgl_lahir" name="tgl_lahir"
                                        style="width: 100% !important;"
                                        value="<?php echo htmlspecialchars($tgl_lahir); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div>
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Password</label>
                                </div>
                                <div class="col-8">
                                    <input type="password" class="form-control" placeholder="Pasword" name="password"
                                        style="width: 100% !important;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div>
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Confirm Password</label>
                                </div>
                                <div class="col-8">
                                    <input type="password" class="form-control" placeholder="Confirm Password"
                                        name="confirm_password" style="width: 100% !important;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary me-4" type="submit">Register</button>
                            <div class="btn btn-secondary">Cancel</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer_area ">
        <div class="container">
            <div class="row">
                <!-- Single Widget-->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-footer-widget section_padding_0_130">
                        <!-- Footer Logo-->
                        <div class="footer-logo mb-3"></div>
                        <p>Appland is completely creative, lightweight, clean app landing page.</p>
                        <!-- Copywrite Text-->
                        <div class="copywrite-text mb-5">
                            <p class="mb-0">Made with <i class="lni-heart mr-1"></i>by<a class="ml-1"
                                    href="https://wrapbootstrap.com/user/DesigningWorld">PertaminiKu</a></p>
                        </div>
                        <!-- Footer Social Area-->
                        <div class="footer_social_area"><a href="#" data-toggle="tooltip" data-placement="top" title=""
                                data-original-title="Facebook"><i class="fa fa-facebook"></i></a><a href="#"
                                data-toggle="tooltip" data-placement="top" title="" data-original-title="Pinterest"><i
                                    class="fa fa-pinterest"></i></a><a href="#" data-toggle="tooltip"
                                data-placement="top" title="" data-original-title="Skype"><i
                                    class="fa fa-skype"></i></a><a href="#" data-toggle="tooltip" data-placement="top"
                                title="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></div>
                    </div>
                </div>
                <!-- Single Widget-->
                <div class="col-12 col-sm-6 col-lg">
                    <div class="single-footer-widget section_padding_0_130">
                        <!-- Widget Title-->
                        <h5 class="widget-title">About</h5>
                        <!-- Footer Menu-->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Corporate Sale</a></li>
                                <li><a href="#">Terms &amp; Policy</a></li>
                                <li><a href="#">Community</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Widget-->
                <div class="col-12 col-sm-6 col-lg">
                    <div class="single-footer-widget section_padding_0_130">
                        <!-- Widget Title-->
                        <h5 class="widget-title">Support</h5>
                        <!-- Footer Menu-->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Term &amp; Conditions</a></li>
                                <li><a href="#">Help &amp; Support</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Widget-->
                <div class="col-12 col-sm-6 col-lg">
                    <div class="single-footer-widget section_padding_0_130">
                        <!-- Widget Title-->
                        <h5 class="widget-title">Contact</h5>
                        <!-- Footer Menu-->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="#">Call Centre</a></li>
                                <li><a href="#">Email Us</a></li>
                                <li><a href="#">Term &amp; Conditions</a></li>
                                <li><a href="#">Help Center</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="../../js/bootstrap.min.js"></script>
</body>

</html>