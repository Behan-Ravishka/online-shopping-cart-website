<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AuraCart - Home</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="jquery.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <div id="loading-screen">
        <img src="images/logo.png" alt="AuraCart Logo" class="loading-logo">
        <h1 class="loading-text">AuraCart</h1>
    </div>
    <div id="content" style="display:none;">
        <?php include 'includes/header.php'; ?>
        <main class="home-main">
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to AuraCart</h1>
            <p>Your ultimate online shopping destination.</p>
            <a href="products.php" class="btn primary-btn">Shop Now</a>
        </div>
    </section>
    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <?php
            // Fetch and display featured products from the database
            // ... (SQL query and loop)
            ?>
        </div>
    </section>
    <section class="offers">
        <h2>Special Offers</h2>
        <div class="offer-countdown">
            <p>Offer ends in: <span id="countdown"></span></p>
        </div>
        <div class="offer-grid">
            <?php
            // Fetch and display special offers
            // ... (SQL query and loop)
            ?>
            </div>
    </section>
    </main>
        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>