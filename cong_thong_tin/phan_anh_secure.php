<?php
require_once 'config.php';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /*
     * ĐÃ VÁ:
     * 1. htmlspecialchars() trước khi lưu → XSS không vào được DB
     * 2. Prepared Statement → chống SQL Injection đồng thời
     * 3. Khi hiển thị lại vẫn dùng htmlspecialchars() → 2 lớp bảo vệ
     */
    $ho_ten   = htmlspecialchars(trim($_POST['ho_ten']),
                    ENT_QUOTES, 'UTF-8');
    $email    = filter_var(trim($_POST['email']),
                    FILTER_SANITIZE_EMAIL);
    $noi_dung = htmlspecialchars(trim($_POST['noi_dung']),
                    ENT_QUOTES, 'UTF-8');

    $stmt = $pdo->prepare(
        "INSERT INTO phan_anh
             (ho_ten_nguoi_gui, email_nguoi_gui, noi_dung)
         VALUES (?, ?, ?)"
    );
    $stmt->execute([$ho_ten, $email, $noi_dung]);
    $success = "Phan anh da duoc gui thanh cong!";
}

$stmt = $pdo->query(
    "SELECT * FROM phan_anh ORDER BY ngay_gui DESC LIMIT 10"
);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Phan Anh An Toan</title>
    <style>
        body { font-family:Arial,sans-serif; background:#f0f4f8; margin:0; }
        .header { background:#2d7a2d; color:white; padding:15px 20px; }
        .container { max-width:800px; margin:25px auto; padding:0 15px; }
        .card {
            background:white; padding:22px; border-radius:8px;
            box-shadow:0 2px 8px rgba(0,0,0,.08); margin-bottom:20px;
        }
        .stag {
            background:#e8f4e8; color:#2d7a2d; font-size:12px;
            padding:7px 10px; border-radius:4px; margin-bottom:15px;
        }
        .fg { margin-bottom:15px; }
        .fg label { display:block; margin-bottom:5px; font-weight:bold; }
        .fg input, .fg textarea {
            width:100%; padding:9px; border:1px solid #ccc;
            border-radius:4px; font-size:14px;
        }
        .fg textarea { height:90px; }
        .btn {
            background:#2d7a2d; color:white; padding:10px 25px;
            border:none; border-radius:4px; cursor:pointer;
        }
        .ok {
            color:green; background:#f0fff0;
            padding:10px; border-radius:4px; margin-bottom:15px;
        }
        .item { border-bottom:1px solid #eee; padding:12px 0; }
        .meta { font-size:11px; color:#999; margin-top:4px; }
    </style>
</head>
<body>
<div class="header">
    <h2 style="margin:0">&#128221; Phan Anh Kien Nghi (Da bao mat)</h2>
</div>
<div class="container">
    <div class="card">
        <div class="stag">
            &#9989; Da bao mat: Prepared Statement + htmlspecialchars
        </div>
        <?php if ($success): ?>
            <div class="ok">&#10003; <?= $success ?></div>
        <?php endif; ?>
        <form method="POST" action="phan_anh_secure.php">
            <div class="fg">
                <label>Ho va ten (*):</label>
                <input type="text" name="ho_ten" required>
            </div>
            <div class="fg">
                <label>Email:</label>
                <input type="email" name="email">
            </div>
            <div class="fg">
                <label>Noi dung (*):</label>
                <textarea name="noi_dung" required></textarea>
            </div>
            <button type="submit" class="btn">Gui phan anh</button>
        </form>
    </div>
    <div class="card">
        <h3 style="color:#2d7a2d;margin-bottom:15px;">
            Cac phan anh (hien thi an toan)
        </h3>
        <?php foreach ($rows as $r): ?>
        <div class="item">
            <!-- ✅ htmlspecialchars: <script> chỉ hiện text, không chạy -->
            <strong>
                <?= htmlspecialchars($r['ho_ten_nguoi_gui'],
                        ENT_QUOTES,'UTF-8') ?>
            </strong>
            <p>
                <?= htmlspecialchars($r['noi_dung'],
                        ENT_QUOTES,'UTF-8') ?>
            </p>
            <div class="meta">
                <?= htmlspecialchars($r['email_nguoi_gui'],
                        ENT_QUOTES,'UTF-8') ?>
                &bull; <?= $r['ngay_gui'] ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>