<?php
// Konfigurasi koneksi database
$servername = "localhost"; // Ganti dengan nama server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "dksystem_upskill"; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mulai transaksi
$conn->begin_transaction();

try {
    // Ambil ID dan username terbaru dari tabel akun
    $sql_latest_id = "SELECT id, username FROM akun ORDER BY id DESC LIMIT 1";
    $result_latest_id = $conn->query($sql_latest_id);

    if ($result_latest_id->num_rows > 0) {
        $row_latest_id = $result_latest_id->fetch_assoc();
        $latest_id = $row_latest_id["id"];
        $username = $row_latest_id["username"];

        // Masukkan data ke dalam tabel userprofiles
        $sql_insert_profile = "INSERT INTO userprofiles (id, username, province, city, street, postal_code, education, institution, degree, expertise, phone) 
                               VALUES ('$latest_id', '$username', ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Persiapkan pernyataan SQL untuk dimasukkan
        $stmt = $conn->prepare($sql_insert_profile);
        $stmt->bind_param("sssssssss", $province, $city, $street, $postal_code, $education, $institution, $degree, $expertise, $phone);
        
        // Ambil data dari formulir
        $province = $_POST['province'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $postal_code = $_POST['postal_code'];
        $education = $_POST['education'];
        $institution = $_POST['institution'];
        $degree = $_POST['degree'];
        $expertise = $_POST['expertise'];
        $phone = $_POST['phone'];
        
        // Eksekusi pernyataan SQL
        $stmt->execute();
        
        // Commit transaksi
        $conn->commit();
        
        // Tampilkan pesan berhasil
        echo "Data berhasil ditambahkan ke dalam tabel userprofiles";
        
        // Pengalihan ke halaman login
        header("Location: ../Login/Login.html");
        exit();
    } else {
        echo "Tidak ada data yang ditemukan dalam tabel akun";
    }
} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Tutup pernyataan dan koneksi
$stmt->close();
$conn->close();
?>
