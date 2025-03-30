<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
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
        <h2>User Login</h2>
        <form method="post" action="login_process.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn primary-btn">Login</button>
        </form>
    </div>
</body>
<?php include 'includes/footer.php'; ?>
</html>