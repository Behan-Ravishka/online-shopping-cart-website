<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add' && isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $user_id = $_SESSION['user_id'];

        // Check if the product is already in the cart
        $sql = "SELECT quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Update quantity
            $row = $result->fetch_assoc();
            $new_quantity = $row['quantity'] + 1;
            $sql = "UPDATE cart SET quantity = $new_quantity WHERE user_id = $user_id AND product_id = $product_id";
        } else {
            // Add new item to cart
            $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Product added to cart.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        if ($conn->query($sql) === TRUE) {
            echo "<script> showOfferPopup('Success','Product added to cart.'); </script>";
        } else {
            echo "<script> showOfferPopup('Error','Error adding product.'); </script>";
        }

        // cart_actions.php (after payment)
$coins_earned = 10; // Example: 10 coins per purchase
$sql = "UPDATE users SET coins = coins + $coins_earned WHERE id = $user_id";
$conn->query($sql);
$sql = "INSERT into coins_history(user_id, amount, description) VALUES ($user_id, $coins_earned, 'Purchase reward')";
$conn->query($sql);
    }
    // Add other cart actions (remove, update) here...
}
?>