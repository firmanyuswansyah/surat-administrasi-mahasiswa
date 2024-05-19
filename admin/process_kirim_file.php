<?php
// Establish database connection
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "pengelolaan_surat"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Skrip untuk menangani unggah file PDF
if (isset($_FILES['file_pdf'])) {
    $pengajuan_id = $_POST['pengajuan_id'];
    $file_name = $_FILES['file_pdf']['name'];
    $file_tmp = $_FILES['file_pdf']['tmp_name'];
    $file_type = $_FILES['file_pdf']['type'];
    
    // Tentukan direktori tempat menyimpan file PDF
    $target_dir = "uploads/";
    
    // Pindahkan file PDF ke direktori tujuan
    if (move_uploaded_file($file_tmp, $target_dir . $file_name)) {
        echo "File PDF berhasil diunggah.";
        
        // Update database record with file information
        $query_update = "UPDATE pengajuan_surat SET file_pdf = '$file_name' WHERE id = '$pengajuan_id'";
        if (mysqli_query($conn, $query_update)) {
            echo "Informasi unggah file PDF berhasil disimpan ke database.";
        } else {
            echo "Gagal menyimpan informasi unggah file PDF ke database: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal mengunggah file PDF.";
    }
}

// Close database connection
$conn->close();
?>
