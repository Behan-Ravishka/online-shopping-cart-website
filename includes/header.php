<?php
session_start();
include 'db_connect.php'; // Database connection
?>
<header>
    <nav>
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt="AuraCart Logo"> AuraCart</a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])) { ?>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php } elseif (isset($_SESSION['admin_id'])) { ?>
                <li><a href="admin/dashboard.php">Admin Panel</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php } else { ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
            <?php } ?>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>
</header>