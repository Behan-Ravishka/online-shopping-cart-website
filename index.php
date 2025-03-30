<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AuraCart - Home</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                    <a href="products.php" class="btn primary-btn" style = "text-decoration : none">Shop Now</a>
                </div>
            </section>
            <section class="featured-products">
                <h2>Featured Products</h2>
                <div class="product-grid">
                    <?php
                    // Fetch and display featured products from the database
                    // Example SQL: SELECT * FROM products WHERE featured = 1 LIMIT 8;
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
                    // Example SQL: SELECT * FROM offers WHERE active = 1;
                    // ... (SQL query and loop)
                    ?>
                </div>
            </section>
            <section class="trending-categories">
                <h2>Trending Categories</h2>
                <div class="category-grid">
                    <?php
                    // Fetch and display trending categories
                    // Example SQL: SELECT * FROM categories WHERE trending = 1 LIMIT 6;
                    // ... (SQL query and loop)
                    ?>
                </div>
            </section>
            <section class="customer-reviews">
                <h2>What Our Customers Say</h2>
                <div class="review-grid">
                    <?php
                    // Fetch and display customer reviews
                    // Example SQL: SELECT * FROM product_reviews ORDER BY review_date DESC LIMIT 3;
                    // ... (SQL query and loop)
                    ?>
                </div>
            </section>
            <section class="recommendations">
                <h2>Recommended For You</h2>
                <div class="recommendation-grid">
                    <?php
                    // Fetch and display recommended products based on user history or trending items
                    // Example SQL: SELECT * FROM products WHERE category IN (SELECT category FROM product_views WHERE user_id = $user_id) LIMIT 4;
                    // ... (SQL query and loop)
                    ?>
                </div>
            </section>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>