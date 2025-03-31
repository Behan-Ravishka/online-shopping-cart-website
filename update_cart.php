<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_id'];

    if ($quantity < 1) {
        echo "<div class='message-container error-message'><p>Quantity must be at least 1.</p></div>";
    } else {
        $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $quantity, $user_id, $product_id);

        if ($stmt->execute()) {
            echo "<div class='message-container success-message'><p>Cart updated successfully.</p></div>";
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'cart.php';
                }, 1500);
            </script>";
        } else {
            echo "<div class='message-container error-message'><p>Error updating cart: " . $stmt->error . "</p></div>";
        }
    }
} else {
    echo "<div class='message-container error-message'><p>Invalid request.</p></div>";
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