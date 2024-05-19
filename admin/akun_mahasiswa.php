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
                        <h1 class="h3 mb-0 text-gray-800">Daftar Akun Mahasiswa</h1>
                        <!-- Tempatkan tombol Tambah di sini -->
                        <a href='tambah_mahasiswa.php' class='btn btn-sm btn-success'>Tambah Mahasiswa</a>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>NIM</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Menghubungkan ke database
                                                $koneksi = mysqli_connect("localhost", "root", "", "pengelolaan_surat");
                                                // Menjalankan query
                                                if (!$koneksi) {
                                                    die("Koneksi ke database gagal: " . mysqli_connect_error());
                                                }

                                                // Menjalankan query untuk mengambil data mahasiswa setelah proses edit
                                                $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");

                                                // Menampilkan setiap baris hasil query
                                                while ($data = mysqli_fetch_assoc($query)) {
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($data['nim']) . "</td>";
                                                    // Tampilkan tombol edit dan hapus, atau tindakan lainnya
                                                    echo "<td>";
                                                    echo "<a href='edit_mahasiswa.php?nim=" . $data['nim'] . "' class='btn btn-sm btn-primary'>Edit</a> ";
                                                    echo "<a href='hapus_mahasiswa.php?nim=" . $data['nim'] . "' class='btn btn-sm btn-danger'>Hapus</a>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                                mysqli_close($koneksi);
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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
