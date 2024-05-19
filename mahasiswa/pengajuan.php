<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
</head>

<?php
if (isset($_POST['submit'])) {
    $nim = $_SESSION['nim'];
    $id_informasi_surat = mysqli_real_escape_string($conn, $_POST['id_informasi_surat']);
    $keperluan = mysqli_real_escape_string($conn, $_POST['keperluan']);
    $status = "Diproses";
    $tanggal_pengajuan = date("Y-m-d");

    $query = "INSERT INTO pengajuan_surat (nim, id_informasi_surat, keperluan, status, tanggal_pengajuan) VALUES ('$nim', '$id_informasi_surat', '$keperluan', '$status', '$tanggal_pengajuan')";

    if (mysqli_query($conn, $query)) {
        $script = "
            Swal.fire({
                icon: 'success',
                title: 'Pengajuan Surat Berhasil Ditambahkan!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Pengajuan Surat Gagal Ditambahkan!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    }
}


?>



<body id="page-top">

    <div id="wrapper">

        <?php include "sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include "topbar.php"; ?>

                <div class="container-fluid">
                    <div class="mb-3">
                        <p>
                            <a class="btn btn-success" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fas fa-plus-square"></i> Tambah Data Pengajuan Surat
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <form method="POST" action="" enctype="multipart/form-data">

                                    <?php
                                    $sql = "SELECT id, CONCAT(kategori_surat, ' - ', format_surat, ' - ', prasyarat_surat) AS informasi_surat FROM informasi_surat";
                                    $result = mysqli_query($conn, $sql);
                                    ?>

                                    <select class="form-control mb-3" id="id_informasi_surat" name="id_informasi_surat" required>
                                        <option value="">Pilih Kategori Surat</option>
                                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['informasi_surat']; ?></option>
                                        <?php endwhile; ?>
                                    </select>

                                    <div class="form-group">
                                        <label for="keperluan">Keperluan Pengajuan:</label>
                                        <input type="text" class="form-control" id="keperluan" name="keperluan" required>
                                    </div>


                                    <input type="hidden" name="nim" value="<?php echo $_SESSION['nim']; ?>">
                                    <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>



                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Surat</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataX" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIM</th>
                                            <th>Kategori Surat</th>
                                            <th>Format Surat</th>
                                            <th>Prasyarat Surat</th>
                                            <th>Status</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Unduh File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Query untuk mengambil data pengajuan surat
                                        $query = "SELECT * FROM pengajuan_surat";
                                        $result = mysqli_query($conn, $query);

                                        // Perulangan untuk menampilkan data
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // Mengambil detail informasi surat berdasarkan id_informasi_surat
                                            $id_informasi_surat = $row['id_informasi_surat'];
                                            $query_detail = "SELECT * FROM informasi_surat WHERE id = $id_informasi_surat";
                                            $result_detail = mysqli_query($conn, $query_detail);
                                            $detail_surat = mysqli_fetch_assoc($result_detail);
                                        ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= htmlspecialchars($row['nim']); ?></td>
                                                <td><?= htmlspecialchars($detail_surat['kategori_surat']); ?></td>
                                                <td><?= htmlspecialchars($detail_surat['format_surat']); ?></td>
                                                <td><?= htmlspecialchars($detail_surat['prasyarat_surat']); ?></td>
                                                <td><?= htmlspecialchars($row['status']); ?></td>
                                                <td><?= htmlspecialchars($row['tanggal_pengajuan']); ?></td>
                                                <td>
                                                    <?php if ($row['status'] == "Selesai") : ?>
                                                        <form action="download_pdf.php" method="post">
                                                            <input type="hidden" name="pengajuan_id" value="<?= $row['id']; ?>">
                                                            <button type="submit" class="btn btn-primary btn-sm">Unduh PDF</button>
                                                        </form>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        } ?>
                                    </tbody>
                                </table>
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

    <script>
        $(document).ready(function() {
            $('#dataX').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sLast": "Terakhir",
                        "sNext": "Selanjutnya",
                        "sPrevious": "Sebelumnya"
                    },
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sSearch": "Cari:",
                    "sEmptyTable": "Tidak ada data yang tersedia dalam tabel",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ada data yang cocok dengan pencarian Anda"
                }
            });
        });
    </script>

    <script>
        <?php if (isset($script)) {
            echo $script;
        } ?>
    </script>
</body>

</html>