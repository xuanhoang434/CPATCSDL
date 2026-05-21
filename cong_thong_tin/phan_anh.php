<?php
require_once 'config.php';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ho_ten   = $_POST['ho_ten'];
    $email    = $_POST['email'];
    $noi_dung = $_POST['noi_dung'];

    /*
     * ⚠️ LỖ HỔNG CỐ Ý:
     * 1. Không lọc dữ liệu trước khi lưu vào DB
     * 2. Khi hiển thị lại không dùng htmlspecialchars
     * → Dẫn đến Stored XSS: mã độc lưu trong DB,
     *   chạy trên trình duyệt của bất kỳ ai xem trang
     */
    $ho_ten   = $_POST['ho_ten'];
    $email    = $_POST['email'];
    $noi_dung = $_POST['noi_dung'];

    /*
     * ⚠️ LỖ HỔNG CỐ Ý:
     * 1. Không lọc dữ liệu trước khi lưu vào DB
     * 2. Khi hiển thị lại không dùng htmlspecialchars
     * → Dẫn đến Stored XSS: mã độc lưu trong DB,
     *   chạy trên trình duyệt của bất kỳ ai xem trang
     */
    $q = "INSERT INTO phan_anh
              (ho_ten_nguoi_gui, email_nguoi_gui, noi_dung)
          VALUES ('$ho_ten','$email','$noi_dung')";
    mysqli_query($conn, $q);
    $success = "Phan anh da duoc gui thanh cong!";
}

$rows = mysqli_query(
    $conn,
    "SELECT * FROM phan_anh ORDER BY ngay_gui DESC LIMIT 10"
);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Phan Anh Kien Nghi</title>
    <style>
        body { font-family:Arial,sans-serif; background:#f0f4f8; margin:0; }
        .header { background:#003366; color:white; padding:15px 20px; }
        .container { max-width:800px; margin:25px auto; padding:0 15px; }
        .card {
            background:white; padding:22px; border-radius:8px;
            box-shadow:0 2px 8px rgba(0,0,0,.08); margin-bottom:20px;
        }
        .fg { margin-bottom:15px; }
        .fg label { display:block; margin-bottom:5px; font-weight:bold; }
        .fg input, .fg textarea {
            width:100%; padding:9px; border:1px solid #ccc;
            border-radius:4px; font-size:14px;
        }
        .fg textarea { height:90px; resize:vertical; }
        .btn {
            background:#0055a5; color:white; padding:10px 25px;
            border:none; border-radius:4px; cursor:pointer; font-size:14px;
        }
        .ok {
            color:green; background:#f0fff0; padding:10px;
            border-radius:4px; margin-bottom:15px;
        }
        .item { border-bottom:1px solid #eee; padding:12px 0; }
        .meta { font-size:11px; color:#999; margin-top:4px; }
    </style>
</head>
<body>
<div class="header">
    <h2 style="margin:0">&#128221; Gui Phan Anh Kien Nghi</h2>
</div>
<div class="container">
    <div class="card">
        <?php if ($success): ?>
            <div class="ok">&#10003; <?= $success ?></div>
        <?php endif; ?>
        <form method="POST" action="phan_anh.php">
            <div class="fg">
                <label>Ho va ten (*):</label>
                <input type="text" name="ho_ten" required>
            </div>
            <div class="fg">
                <label>Email:</label>
                <input type="email" name="email">
            </div>
            <div class="fg">
                <label>Noi dung phan anh (*):</label>
                <textarea name="noi_dung" required></textarea>
            </div>
            <button type="submit" class="btn">Gui phan anh</button>
        </form>
    </div>

    <div class="card">
        <h3 style="color:#003366;margin-bottom:15px;">
            Cac phan anh gan day
        </h3>
        <?php while ($r = mysqli_fetch_assoc($rows)): ?>
        <div class="item">
            <!-- ⚠️ XSS: echo trực tiếp, không htmlspecialchars -->
            <strong><?= $r['ho_ten_nguoi_gui'] ?></strong>
            <p><?= $r['noi_dung'] ?></p>
            <div class="meta">
                <?= $r['email_nguoi_gui'] ?> &bull; <?= $r['ngay_gui'] ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>