<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Check if the product exists
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Check if the product is already in the cart
        $sql = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $cartResult = $stmt->get_result();

        if ($cartResult->num_rows > 0) {
            // Product already in cart, increment quantity
            $sql = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $user_id, $product_id);
            if ($stmt->execute()) {
                echo "<div class='message-container success-message'><p>Product quantity updated in cart.</p></div>";
                echo "<script>setTimeout(function(){ window.location.href = 'products.php'; }, 1500);</script>";
            } else {
                echo "<div class='message-container error-message'><p>Error updating cart: " . $stmt->error . "</p></div>";
                echo "<script>setTimeout(function(){ window.location.href = 'products.php'; }, 1500);</script>";
            }
        } else {
            // Product not in cart, add it
            $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $user_id, $product_id);
            if ($stmt->execute()) {
                echo "<div class='message-container success-message'><p>Product added to cart.</p></div>";
                echo "<script>setTimeout(function(){ window.location.href = 'cart.php'; }, 1500);</script>";
            } else {
                echo "<div class='message-container error-message'><p>Error adding to cart: " . $stmt->error . "</p></div>";
                echo "<script>setTimeout(function(){ window.location.href = 'cart.php'; }, 1500);</script>";
            }
        }
    } else {
        echo "<div class='message-container error-message'><p>Product not found.</p></div>";
    }
} else {
    echo "<div class='message-container error-message'><p>Product ID not provided.</p></div>";
}
?>

<style>
    .message-container {
        padding: 20px;
        margin: 20px auto;
        max-width: 400px;
        border-radius: 8px;
        text-align: center;
        font-size: 1.1em;
    }

    .success-message {
        background-color: rgba(220, 255, 220, 0.8);
        color: #28a745;
        border: 1px solid #28a745;
    }

    .error-message {
        background-color: rgba(255, 220, 220, 0.8);
        color: #dc3545;
        border: 1px solid #dc3545;
    }

    .message-container p {
        margin: 0;
    }

    @media (max-width: 600px) {
        .message-container {
            max-width: 90%;
            padding: 15px;
            font-size: 1em;
        }
    }
</style>