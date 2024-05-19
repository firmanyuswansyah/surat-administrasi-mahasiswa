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

if (isset($_POST['edit_status'])) {
    $id_pengajuan_surat = mysqli_real_escape_string($conn, $_POST['id_pengajuan_surat']);
    $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);

    $query = "UPDATE pengajuan_surat SET status = '$new_status' WHERE id = '$id_pengajuan_surat'";

    if (mysqli_query($conn, $query)) {
        $script = "
            Swal.fire({
                icon: 'success',
                title: 'Status Pengajuan Surat Berhasil di Ubah!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Status Pengajuan Surat Gagal Diubah!',
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
                                            <th>Aksi</th>
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

                                                <!-- //LOGIKA KIRIM FILE -->
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?= $row['id'] ?>">Ubah Status Pengajuan</a>
                                                    <?php if ($row['status'] == "Selesai") : ?>
                                                        <!-- Form untuk mengunggah file PDF -->
                                                        <form action="process_kirim_file.php" method="post" enctype="multipart/form-data">
                                                            <input type="hidden" name="pengajuan_id" value="<?= $row['id']; ?>">
                                                            <div class="form-group">
                                                                <label for="file_pdf<?= $row['id'] ?>">Pilih File PDF</label>
                                                                <input type="file" class="form-control-file" id="file_pdf<?= $row['id'] ?>" name="file_pdf" accept=".pdf">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary btn-sm">Kirim File PDF ke Mahasiswa</button>
                                                        </form>
                                                    <?php endif; ?>
                                                </td>


                                                <div class="modal fade" id="editModal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Edit Status Pengajuan Surat</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="POST">
                                                                    <input type="hidden" name="id_pengajuan_surat" value="<?= $row['id']; ?>">
                                                                    <div class="form-group">
                                                                        <label for="new_status">Pilih Status Baru:</label>
                                                                        <select class="form-control" id="new_status" name="new_status">
                                                                            <option value="Diterima">Diterima</option>
                                                                            <option value="Diproses">Diproses</option>
                                                                            <option value="Ditolak">Ditolak</option>
                                                                            <option value="Selesai">Selesai</option>
                                                                        </select>
                                                                    </div>
                                                                    <button type="submit" name="edit_status" class="btn btn-primary w-100">Simpan Perubahan</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
