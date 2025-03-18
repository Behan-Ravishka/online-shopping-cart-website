<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'db_connect.php'; // Database connection
?>
<header>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php" class="logo-link">
                <img src="images/logo.png" alt="AuraCart Logo" class="logo-img">
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php" class="nav-link">Home</a></li>
            <li><a href="products.php" class="nav-link">Products</a></li>
            <li><a href="contact.php" class="nav-link">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])) { ?>
                <li><a href="cart.php" class="nav-link">Cart</a></li>
                <li><a href="profile.php" class="nav-link">Profile</a></li>
                <li><a href="logout.php" class="nav-link">Logout</a></li>
            <?php } elseif (isset($_SESSION['admin_id'])) { ?>
                <li><a href="logout.php" class="nav-link">Logout</a></li>
            <?php } else { ?>
                <li class="dropdown">
                    <a href="login.php" class="nav-link">Login</a>
                    <div class="dropdown-content">
                        <a href="login.php">User Login</a>
                        <a href="admin/login.php">Admin Login</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="signup.php" class="nav-link">Signup</a>
                    <div class="dropdown-content">
                        <a href="signup.php">User Signup</a>
                        <a href="admin/signup.php">Admin Signup</a>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>
</header>
<link rel="stylesheet" href="css/style.css">
<script src="js/script.js"></script>

<style>
/* header styles */
header {
    background-color: #673AB7; /* Primary color */
    color: white;
    padding: 10px 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}

.logo-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: white;
}

.logo-img {
    width: 100px; /* Adjusted logo size */
    height: 66px;
    margin-right: 10px;
    transition: transform 0.3s ease;
}

.logo-img:hover {
    transform: scale(1.1);
}

.nav-links {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

.nav-link {
    color: white;
    text-decoration: none;
    padding: 10px 15px;
    transition: background-color 0.3s ease, color 0.3s ease;
    border-radius: 5px;
}

.nav-link:hover, .nav-link.active {
    background-color: rgba(255, 255, 255, 0.1);
    color: #FFC107; /* Secondary Color for hover */
}

.burger {
    display: none;
    cursor: pointer;
}

.burger div {
    width: 25px;
    height: 3px;
    background-color: white;
    margin: 5px;
    transition: all 0.3s ease;
}

/* Responsive styles */
@media screen and (max-width: 768px) {
    .nav-links {
        position: absolute;
        right: 0px;
        height: 92vh;
        top: 8vh;
        background-color: #673AB7;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 50%;
        transform: translateX(100%);
        transition: transform 0.5s ease-in;
    }

    .nav-links li {
        opacity: 0;
    }

    .burger {
        display: block;
    }
}

.nav-active {
    transform: translateX(0%);
}

/* Burger animations */
.toggle .line1 {
    transform: rotate(-45deg) translate(-5px, 6px);
}

.toggle .line2 {
    opacity: 0;
}

.toggle .line3 {
    transform: rotate(45deg) translate(-5px, -6px);
}

@keyframes navLinkFade {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0px);
    }
}

/* Dropdown styles */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #673AB7;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* Burger menu dropdown styles */
@media screen and (max-width: 768px) {
    .nav-links .dropdown-content {
        position: static;
        background-color: transparent;
        box-shadow: none;
        width: 100%;
    }

    .nav-links .dropdown-content a {
        padding: 10px 20px;
    }
}

</style>