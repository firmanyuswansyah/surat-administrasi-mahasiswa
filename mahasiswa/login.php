<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SISTEM PENGELOLAAN ADMINISTRASI SURAT MAHASISWA STMIK BANDUNG </title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
</head>
<?php

session_start();
include '../functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(0);
    $nim = $_POST["nim"];

    $nim = mysqli_real_escape_string($conn, $nim);

    $sql = "SELECT * FROM mahasiswa WHERE nim = '$nim' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION["mahasiswa"] = true;
        $_SESSION["nim"] = $nim;
        header("Location: ./index.php");
        exit();
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'NIM Tidak Ditemukan!',
                text: 'Hubungi admin untuk menambahkan nim anda.',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    }
}

?>

<body>

<div class="container-fluid" style="background-color: #007bff;">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="d-flex flex-column align-items-center">
                <h4 class="mt-5 text-center text-white">SISTEM PENGELOLAAN ADMINISTRASI SURAT MAHASISWA STMIK BANDUNG</h4>
                <h4 class="mt-5 text-center text-white">Login untuk Mahasiswa</h4>

                <div class="mt-3">
                    <img src="../img/stmik_bandung.png" class="img-fluid" width="100" alt="Logo">
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10">
            <div class="card o-hidden border-0 my-5" style="background-color: #f8d426;">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col">
                            <div class="p-5">
                                <form class="user" method="POST" action="">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="nim" placeholder="Masukkan NIM" required>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>

    <?php include "footer.php"; ?>
    <?php include "plugin.php"; ?>

    <script>
        <?php if (isset($script)) {
            echo $script;
        } ?>
    </script>

</body>

</html>