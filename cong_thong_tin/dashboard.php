<?php
session_start();
require_once 'config.php';

if (empty($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}
$user    = $_SESSION['user'];
$pa_list = mysqli_query($conn,
    "SELECT * FROM phan_anh ORDER BY ngay_gui DESC");
$cd_list = mysqli_query($conn,
    "SELECT * FROM cong_dan");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bang dieu khien - Can bo</title>
    <style>
        body  { font-family:Arial,sans-serif; background:#f0f4f8; margin:0; }
        .top  {
            background:#003366; color:white; padding:12px 20px;
            display:flex; justify-content:space-between; align-items:center;
        }
        .top a { color:#ffcc00; text-decoration:none; font-size:13px; }
        .wrap  { max-width:1050px; margin:25px auto; padding:0 15px; }
        .card  {
            background:white; padding:20px; border-radius:8px;
            box-shadow:0 2px 8px rgba(0,0,0,.08); margin-bottom:22px;
        }
        .card h3 { color:#003366; margin-bottom:15px; }
        table   { width:100%; border-collapse:collapse; font-size:13px; }
        th      { background:#003366; color:white; padding:9px 10px;
                  text-align:left; }
        td      { padding:8px 10px; border-bottom:1px solid #eee;
                  vertical-align:top; }
        tr:hover td { background:#f5f8ff; }
        .tag    {
            background:#e8f4e8; color:#2d7a2d;
            padding:2px 8px; border-radius:10px; font-size:11px;
        }
    </style>
</head>
<body>
<div class="top">
    <span>
        &#127963; Bang dieu khien &nbsp;|&nbsp;
        Xin chao: <strong><?= htmlspecialchars($user['ho_ten']) ?></strong>
        &mdash; <?= htmlspecialchars($user['chuc_vu']) ?>
    </span>
    <a href="logout.php">&#128682; Dang xuat</a>
</div>
<div class="wrap">
    <div class="card">
        <h3>&#128203; Phan Anh Kien Nghi cua Nguoi Dan</h3>
        <table>
            <tr>
                <th>#</th><th>Nguoi gui</th><th>Noi dung</th>
                <th>Email</th><th>Ngay gui</th><th>Trang thai</th>
            </tr>
            <?php $i=1; while ($r = mysqli_fetch_assoc($pa_list)): ?>
            <tr>
                <td><?= $i++ ?></td>
                <!-- ⚠️ XSS: hiển thị thẳng, không lọc
                     Cán bộ mở trang này → mã độc chạy -->
                <td><?= $r['ho_ten_nguoi_gui'] ?></td>
                <td><?= $r['noi_dung'] ?></td>
                <td><?= $r['email_nguoi_gui'] ?></td>
                <td><?= $r['ngay_gui'] ?></td>
                <td><span class="tag"><?= $r['trang_thai'] ?></span></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="card">
        <h3>&#128101; Danh sach Cong Dan</h3>
        <table>
            <tr>
                <th>#</th><th>Ho ten</th><th>CCCD</th>
                <th>Ngay sinh</th><th>Dia chi</th><th>SDD</th>
            </tr>
            <?php $i=1; while ($r = mysqli_fetch_assoc($cd_list)): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($r['ho_ten']) ?></td>
                <td><?= htmlspecialchars($r['cccd']) ?></td>
                <td><?= $r['ngay_sinh'] ?></td>
                <td><?= htmlspecialchars($r['dia_chi']) ?></td>
                <td><?= htmlspecialchars($r['so_dien_thoai']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>
</body>
</html>