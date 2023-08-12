<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    
    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Format email tidak valid");
    }

    // Cek apakah file berhasil diunggah
    if ($_FILES["file"]["error"] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png'];

        if (in_array($_FILES["file"]["type"], $allowedTypes)) {
            $targetDir = "fileuploads/";
            $targetFile = $targetDir . basename($_FILES["file"]["name"]);

            // Pindahkan file yang diunggah ke direktori target
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                echo "File berhasil diunggah.";
            } else {
                echo "Gagal mengunggah file.";
            }
        } else {
            echo "Hanya file JPEG dan PNG yang diizinkan.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
}
?>
