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

<style>
    .cart-main {
        height: 320px;
        margin: 20px auto;
        max-width: 800px;
        padding: 20px;
        background-color: rgba(103, 58, 181);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        color: white;
    }

    .cart-main h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #FFC107;
    }

    .cart-items {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .cart-item {
        display: flex;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 10px;
    }

    .cart-item img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }

    .item-details {
        margin-left: 10px;
    }

    .item-details h3 {
        margin: 0;
        color: #FFC107;
    }

    .item-details p {
        margin: 5px 0;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin-top: 20px;
        text-align: center;
        text-decoration: none;
        color: black;
        background-color: #FFC107;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #FFA000;
    }

    .primary-btn {
        background-color: #FFC107;
    }

    .primary-btn:hover {
        background-color: #FFA000;
    }
</style>    