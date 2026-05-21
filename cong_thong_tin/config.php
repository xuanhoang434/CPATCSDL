<?php
$host   = 'localhost';
$dbname = 'cong_thong_tin_phuong';
$dbuser = 'root';
$dbpass = '';

// Kết nối PDO — dùng cho file đã vá
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $dbuser, $dbpass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Loi PDO: " . $e->getMessage());
}

// Kết nối mysqli — dùng cho file có lỗ hổng
$conn = mysqli_connect($host, $dbuser, $dbpass, $dbname);
mysqli_set_charset($conn, 'utf8mb4');
?>