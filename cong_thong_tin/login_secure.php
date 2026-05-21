<?php
session_start();
require_once 'config.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    /*
     * ĐÃ VÁ: Dùng Prepared Statement (PDO)
     * Tham số ? được truyền riêng, KHÔNG ghép vào chuỗi SQL
     * → Dù nhập ' OR '1'='1' cũng chỉ được coi là ký tự thường
     */
    $stmt = $pdo->prepare(
        "SELECT * FROM can_bo
         WHERE username = ? AND password = ?"
    );
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user']      = $user;
        $_SESSION['logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Ten dang nhap hoac mat khau khong dung!";
        error_log(
            date('[Y-m-d H:i:s]') .
            " LOGIN FAILED | user=$username" .
            " | IP=" . $_SERVER['REMOTE_ADDR']
        );
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dang nhap An toan</title>
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
        .box h2 { text-align:center; color:#2d7a2d; margin-bottom:5px; }
        .stag {
            text-align:center; background:#e8f4e8; color:#2d7a2d;
            font-size:12px; padding:5px; border-radius:4px; margin-bottom:20px;
        }
        .fg { margin-bottom:18px; }
        .fg label {
            display:block; margin-bottom:6px;
            font-weight:bold; font-size:14px;
        }
        .fg input {
            width:100%; padding:10px; border:1px solid #ccc;
            border-radius:4px; font-size:14px;
        }
        .btn {
            width:100%; padding:12px; background:#2d7a2d; color:white;
            border:none; border-radius:4px; cursor:pointer; font-size:15px;
        }
        .btn:hover { background:#246024; }
        .err {
            color:red; background:#fff0f0; padding:8px;
            border-radius:4px; text-align:center;
            font-size:13px; margin-bottom:15px;
        }
    </style>
</head>
<body>
<div class="box">
    <h2>&#128274; Dang nhap Can bo</h2>
    <div class="stag">&#9989; Da bao mat: Prepared Statement (PDO)</div>
    <?php if ($error): ?>
        <div class="err"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="login_secure.php">
        <div class="fg">
            <label>Ten dang nhap:</label>
            <input type="text" name="username" placeholder="admin" required>
        </div>
        <div class="fg">
            <label>Mat khau:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" class="btn">&#128274; Dang nhap An toan</button>
    </form>
</div>
</body>
</html>