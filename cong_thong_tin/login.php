<?php
session_start();
require_once 'config.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    /*
     * LỖ HỔNG CỐ Ý: Ghép biến trực tiếp vào chuỗi SQL
     * Không dùng Prepared Statement → dễ bị SQL Injection
     * Chỉ dùng cho mục đích thực nghiệm
     */
   $query  = "SELECT * FROM can_bo
               WHERE username='$username' AND  password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user']      = $user;
        $_SESSION['logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Ten dang nhap hoac mat khau khong dung!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dang nhap Can bo</title>
    <style>
        body {
            font-family:Arial,sans-serif; background:#f0f4f8;
            display:flex; justify-content:center;
            align-items:center; min-height:100vh;
        }
        .box {
            background:white; padding:35px 40px; border-radius:10px;
            box-shadow:0 4px 20px rgba(0,0,0,.12); width:360px;
        }
        .box h2 { text-align:center; color:#003366; margin-bottom:25px; }
        .fg { margin-bottom:18px; }
        .fg label {
            display:block; margin-bottom:6px;
            font-weight:bold; color:#333; font-size:14px;
        }
        .fg input {
            width:100%; padding:10px; border:1px solid #ccc;
            border-radius:4px; font-size:14px;
        }
        .fg input:focus { border-color:#0055a5; outline:none; }
        .btn {
            width:100%; padding:12px; background:#003366; color:white;
            border:none; border-radius:4px; cursor:pointer; font-size:15px;
        }
        .btn:hover { background:#0055a5; }
        .err {
            color:red; background:#fff0f0; padding:8px;
            border-radius:4px; font-size:13px;
            margin-bottom:15px; text-align:center;
        }
        .back { text-align:center; margin-top:15px; font-size:13px; }
        .back a { color:#0055a5; }
    </style>
</head>
<body>
<div class="box">
    <h2>&#128274; Dang nhap Can bo</h2>
    <?php if ($error): ?>
        <div class="err"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <div class="fg">
            <label>Ten dang nhap:</label>
            <input type="text" name="username"
                   placeholder="Vi du: admin" required>
        </div>
        <div class="fg">
            <label>Mat khau:</label>
            <input type="password" name="password"
                   placeholder="Nhap mat khau" required>
        </div>
        <button type="submit" class="btn">Dang nhap</button>
    </form>
    <div class="back">
        <a href="index.php">&#8592; Quay lai trang chu</a>
    </div>
</div>
</body>
</html>