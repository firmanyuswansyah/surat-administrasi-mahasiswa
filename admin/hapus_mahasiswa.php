<?php
// Pastikan ada koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "pengelolaan_surat");

// Periksa apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Ambil nilai NIM yang dikirimkan melalui URL
$nim = $_GET['nim'];

// Buat query untuk menghapus entri mahasiswa dengan NIM tertentu
$query = "DELETE FROM mahasiswa WHERE nim='$nim'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    // Jika berhasil, redirect kembali ke halaman akun_mahasiswa.php atau halaman lainnya
    header("Location: akun_mahasiswa.php");
    exit(); // Penting untuk menghentikan eksekusi skrip setelah mengarahkan pengguna
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
