<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .login-container{
            height: 260px;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="admin_login_process.php" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn primary-btn">Login</button>
        </form>
    </div>
</body>
<?php include 'includes/footer.php'; ?>
</html>