<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cong Thong Tin Phuong 1</title>
    <style>
        * { box-sizing:border-box; margin:0; padding:0; }
        body { font-family:Arial,sans-serif; background:#f0f4f8; }
        .header {
            background:linear-gradient(135deg,#003366,#0055a5);
            color:white; padding:20px; text-align:center;
        }
        .header h1 { font-size:22px; margin-bottom:5px; }
        .header p  { font-size:13px; opacity:.85; }
        .nav {
            background:#0055a5; padding:10px; text-align:center;
            border-bottom:3px solid #ffcc00;
        }
        .nav a {
            color:white; text-decoration:none;
            margin:0 18px; font-size:14px; font-weight:bold;
        }
        .nav a:hover { color:#ffcc00; }
        .container { max-width:900px; margin:30px auto; padding:0 15px; }
        .card {
            background:white; border-radius:8px; padding:25px;
            margin-bottom:20px; box-shadow:0 2px 8px rgba(0,0,0,.08);
            border-left:4px solid #0055a5;
        }
        .card h2 { color:#003366; margin-bottom:12px; }
        .card ul  { padding-left:20px; line-height:1.9; color:#444; }
        .btn {
            display:inline-block; background:#0055a5; color:white;
            padding:10px 22px; border-radius:4px; text-decoration:none;
            font-size:14px; margin:5px 5px 0 0;
        }
        .btn:hover { background:#003f7f; }
        .footer {
            background:#003366; color:#aac4e8;
            text-align:center; padding:14px; font-size:12px;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>&#127963; CONG THONG TIN DIEN TU PHUONG 1</h1>
    <p>Quan Hoan Kiem &mdash; Thanh pho Ha Noi</p>
</div>
<div class="nav">
    <a href="index.php">Trang chu</a>
    <a href="phan_anh.php">Phan anh kien nghi</a>
    <a href="login.php">Dang nhap can bo</a>
</div>
<div class="container">
    <div class="card">
        <h2>Chao mung den Cong Thong Tin Phuong 1</h2>
        <p style="color:#555;margin-bottom:14px;">
            Cong thong tin chinh thuc cua UBND Phuong 1,
            Quan Hoan Kiem phuc vu nguoi dan trong cac thu tuc hanh chinh.
        </p>
        <a href="phan_anh.php" class="btn">&#128221; Gui phan anh</a>
        <a href="login.php"    class="btn">&#128274; Dang nhap can bo</a>
    </div>
    <div class="card">
        <h2>Thong bao moi nhat</h2>
        <ul>
            <li>Lich tiep dan: Thu 2, 4, 6 (8h00 - 11h30)</li>
            <li>Cap CCCD tai tru so: 7h30 - 16h30 cac ngay lam viec</li>
            <li>Duong day nong: 024.3825.xxxx</li>
        </ul>
    </div>
</div>
<div class="footer">
    &copy; 2024 UBND Phuong 1, Quan Hoan Kiem, Ha Noi
</div>
</body>
</html>