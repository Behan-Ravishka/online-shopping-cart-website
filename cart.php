<?php include 'includes/header.php'; ?>
<main class="cart-main">
    <h1>Shopping Cart</h1>
    <div class="cart-items">
        <?php
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT cart.product_id, cart.quantity, products.name, products.price, products.image FROM cart INNER JOIN products ON cart.product_id = products.id WHERE cart.user_id = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="cart-item">';
                echo '<img src="images/' . $row['image'] . '" alt="' . $row['name'] . '">';
                echo '<div class="item-details">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p>Price: $' . $row['price'] . '</p>';
                echo '<p>Quantity: ' . $row['quantity'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </div>
    <a href="checkout.php" class="btn primary-btn">Proceed to Checkout</a>
</main>
<?php include 'includes/footer.php'; ?>