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

// Handle file download
if (isset($_POST['pengajuan_id'])) {
    // Retrieve pengajuan ID from the form
    $pengajuan_id = $_POST['pengajuan_id'];

    // Query to retrieve file name from the database based on pengajuan ID
    $query = "SELECT file_pdf FROM pengajuan_surat WHERE id = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param("i", $pengajuan_id);
        
        // Execute the statement
        $stmt->execute();

        // Bind the result variables
        $stmt->bind_result($file_pdf);

        // Fetch the result
        $stmt->fetch();

        // Set headers for file download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="file.pdf"');
        header('Content-Length: ' . strlen($file_pdf));

        // Output the file contents
        echo $file_pdf;

        // Close the statement
        $stmt->close();
    } else {
        // If the statement preparation fails, display an error message
        echo "Error: " . $conn->error;
    }
} else {
    // If the pengajuan ID is not provided, display an error message
    echo "Pengajuan ID tidak valid.";
}

// Close the database connection
$conn->close();
?>
