<?php
$error = isset($_GET['error']) ? true : false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    #<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/login.css">
    <title>Đăng nhập hệ thống</title>
</head>
<body>
    <form method = "POST" action="process_login.php">
        <h2>Đăng nhập hệ thống quản lý</h2>
        <input type="text" name="username" id="username" placeholder="Tên đăng nhập" required><br>
        <input type="password" name="password" id="password" placeholder="Mật khẩu" required><br>
        <button type="submit">Đăng nhập</button>

        <?php if ($error): ?>
        <p class="error" id="errorMessage">Sai tên đăng nhập hoặc mật khẩu!</p>
        <?php else: ?>
        <p class="error" id="errorMessage"></p>
        <?php endif; ?>
    </form>


</body>
</html>