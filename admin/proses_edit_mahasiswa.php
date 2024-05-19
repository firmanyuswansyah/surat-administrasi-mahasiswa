<?php
// Pastikan form telah disubmit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai NIM baru dari form
    $new_nim = $_POST["nim"];

    // Ambil NIM lama dari URL
    $nim = $_GET["nim"];

    // Menghubungkan ke database
    $koneksi = mysqli_connect("localhost", "root", "", "pengelolaan_surat");

    // Memeriksa koneksi
    if (!$koneksi) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Membuat query untuk mengupdate data mahasiswa di tabel 'mahasiswa'
    $query = "UPDATE mahasiswa SET nim='$new_nim' WHERE nim='$nim'";

    // Menjalankan query
    if (mysqli_query($koneksi, $query)) {
        // Redirect kembali ke halaman akun_mahasiswa.php setelah berhasil mengedit mahasiswa
        header("Location: akun_mahasiswa.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Menutup koneksi
    mysqli_close($koneksi);
}
?>
