<?php include 'includes/header.php'; ?>
<main class="product-details-main">
    <?php
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<div class="product-details">';
        echo '<img src="images/' . $row['image'] . '" alt="' . $row['name'] . '">';
        echo '<h2>' . $row['name'] . '</h2>';
        echo '<p>$' . $row['price'] . '</p>';
        echo '<p>' . $row['description'] . '</p>';
        if (isset($_SESSION['user_id'])){
            echo '<button class="btn primary-btn" onclick="addToCart(' . $row['id'] . ')">Add to Cart</button>';
        } else {
            echo '<p>Please <a href="login.php">login</a> to add to cart.</p>';
        }
        echo '</div>';
    } else {
        echo "Product not found.";
    }
    ?>
</main>
<?php include 'includes/footer.php'; ?>

<script>
    function addToCart(productId) {
        $.ajax({
            url: 'cart_actions.php', // Separate PHP file for cart actions
            type: 'POST',
            data: { action: 'add', product_id: productId },
            success: function(response) {
                alert(response); // Show success/error message
            }
        });
    }
</script>