<?php
// Ambil nilai NIM yang dikirimkan melalui URL
$nim = $_GET['nim'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
</head>

<body id="page-top" style="background-color: #f8d426;">

    <div id="wrapper">

        <?php include "sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include "topbar.php"; ?>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Mahasiswa</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                <form action="proses_edit_mahasiswa.php?nim=<?php echo $nim; ?>" method="post">
                                    <div class="form-group">
                                        <label for="nim">NIM:</label>
                                        <!-- Di sini Anda dapat mengubah input untuk memungkinkan pengguna mengedit NIM -->
                                        <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <?php include "footer.php"; ?>

        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include "plugin.php"; ?>
</body>

</html>
