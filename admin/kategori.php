<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
</head>

<?php
if (isset($_POST['submit'])) {
    $kategori_surat = mysqli_real_escape_string($conn, $_POST['kategori_surat']);
    $format_surat = mysqli_real_escape_string($conn, $_POST['format_surat']);
    $prasyarat_surat = mysqli_real_escape_string($conn, $_POST['prasyarat_surat']);

    $checkQuery = "SELECT * FROM informasi_surat WHERE kategori_surat = '$kategori_surat' AND format_surat = '$format_surat' AND prasyarat_surat = '$prasyarat_surat'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Informasi Surat Sudah Ada!',
                text: 'Mohon periksa kembali data yang dimasukkan.',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $query = "INSERT INTO informasi_surat (kategori_surat, format_surat, prasyarat_surat) VALUES ('$kategori_surat', '$format_surat', '$prasyarat_surat')";
        if (mysqli_query($conn, $query)) {
            $script = "
                Swal.fire({
                    icon: 'success',
                    title: 'Informasi Surat Berhasil Ditambahkan!',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            ";
        } else {
            $script = "
                Swal.fire({
                    icon: 'error',
                    title: 'Informasi Surat Gagal Ditambahkan!',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            ";
        }
    }
}

if (isset($_POST['edit'])) {
    $id_informasi_surat = mysqli_real_escape_string($conn, $_POST['id_informasi_surat']);
    $kategori_surat = mysqli_real_escape_string($conn, $_POST['kategori_surat']);
    $format_surat = mysqli_real_escape_string($conn, $_POST['format_surat']);
    $prasyarat_surat = mysqli_real_escape_string($conn, $_POST['prasyarat_surat']);

    $query = "UPDATE informasi_surat SET kategori_surat = '$kategori_surat', format_surat = '$format_surat', prasyarat_surat = '$prasyarat_surat' WHERE id = '$id_informasi_surat'";

    if (mysqli_query($conn, $query)) {
        $script = "
            Swal.fire({
                icon: 'success',
                title: 'Informasi Surat Berhasil di Edit!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Informasi Surat Gagal Di-Edit!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    }
}

if (isset($_POST['hapus'])) {
    $id_informasi_surat = mysqli_real_escape_string($conn, $_POST['id_informasi_surat']);

    $query = "DELETE FROM informasi_surat WHERE id = '$id_informasi_surat'";

    if (mysqli_query($conn, $query)) {
        $script = "
            Swal.fire({
                icon: 'success',
                title: 'Informasi Surat Berhasil Dihapus!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Informasi Surat Gagal Di-Hapus!',
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
                                <i class="fas fa-plus-square"></i> Tambah Data Kategori Surat
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="kategori_surat">Kategori Surat:</label>
                                        <input type="text" class="form-control" id="kategori_surat" name="kategori_surat" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="format_surat">Format Surat:</label>
                                        <input type="text" class="form-control" id="format_surat" name="format_surat" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="prasyarat_surat">Prasyarat Surat:</label>
                                        <input type="text" class="form-control" id="prasyarat_surat" name="prasyarat_surat" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success w-100">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Kategori Surat</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataX" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kategori Surat</th>
                                            <th>Format Surat</th>
                                            <th>Prasyarat Surat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM informasi_surat");
                                        $stmt->execute();
                                        $informasi_surat = $stmt->get_result();
                                        ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($informasi_surat as $data) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= htmlspecialchars($data['kategori_surat']); ?></td>
                                                <td><?= htmlspecialchars($data['format_surat']); ?></td>
                                                <td><?= htmlspecialchars($data['prasyarat_surat']); ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal<?= $data['id'] ?>">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal<?= $data['id'] ?>">Hapus</a>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit Informasi Surat -->
                                            <div class="modal fade" id="editModal<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Informasi Surat</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id_informasi_surat" value="<?= $data['id']; ?>">
                                                                <div class="form-group">
                                                                    <label for="kategori_surat">Kategori Surat:</label>
                                                                    <input type="text" class="form-control" id="kategori_surat" name="kategori_surat" value="<?= htmlspecialchars($data['kategori_surat']); ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="format_surat">Format Surat:</label>
                                                                    <input type="text" class="form-control" id="format_surat" name="format_surat" value="<?= htmlspecialchars($data['format_surat']); ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="prasyarat_surat">Prasyarat Surat:</label>
                                                                    <input type="text" class="form-control" id="prasyarat_surat" name="prasyarat_surat" value="<?= htmlspecialchars($data['prasyarat_surat']); ?>" required>
                                                                </div>
                                                                <button type="submit" name="edit" class="btn btn-primary w-100">Simpan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Hapus Informasi Surat -->
                                            <div class="modal fade" id="hapusModal<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="hapusModalLabel">Hapus Informasi Surat</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus informasi surat dengan Kategori: <b><?= htmlspecialchars($data['kategori_surat']) ?></b>, Format: <b><?= htmlspecialchars($data['format_surat']) ?></b>, dan Prasyarat: <b><?= htmlspecialchars($data['prasyarat_surat']) ?></b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id_informasi_surat" value="<?= $data['id'] ?>">
                                                                <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <?php $i++; ?>
                                        <?php endforeach; ?>
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