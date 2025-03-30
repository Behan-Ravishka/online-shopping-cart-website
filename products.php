<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AuraCart - Products</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <style>
        .products-main{
            height: 400px;
        }
    </style>    
</head>
<?php include 'includes/header.php'; ?>
<main class="products-main">
    <h1>Our Products</h1>
    <div class="product-grid">
        <?php
        // Fetch products from the database
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<a href="product_details.php?id=' . $row['id'] . '">';
                echo '<img src="images/' . $row['image'] . '" alt="' . $row['name'] . '" loading="lazy">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p>$' . $row['price'] . '</p>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo "No products found.";
        }
        ?>
    </div>
</main>
<?php include 'includes/footer.php'; ?>