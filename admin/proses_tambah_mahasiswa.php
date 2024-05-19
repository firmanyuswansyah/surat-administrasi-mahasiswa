<?php
// Pastikan form telah disubmit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai NIM dari form
    $nim = $_POST["nim"];

    // Menghubungkan ke database
    $koneksi = mysqli_connect("localhost", "root", "", "pengelolaan_surat");

    // Memeriksa koneksi
    if (!$koneksi) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Membuat query untuk menambahkan data mahasiswa ke dalam tabel 'mahasiswa'
    $query = "INSERT INTO mahasiswa (nim) VALUES ('$nim')";

    // Menjalankan query
    if (mysqli_query($koneksi, $query)) {
        // Redirect kembali ke halaman akun_mahasiswa.php setelah berhasil menambahkan mahasiswa
        header("Location: akun_mahasiswa.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Menutup koneksi
    mysqli_close($koneksi);
}
?>
