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