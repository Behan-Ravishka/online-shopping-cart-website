<?php
session_start();
include 'db_connect.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$total_amount = $_GET['total'] ?? 0;

// Store order in the orders table
$sql_orders = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
$stmt_orders = $conn->prepare($sql_orders);
$stmt_orders->bind_param("id", $user_id, $total_amount);

if ($stmt_orders->execute()) {
    $order_id = $conn->insert_id;
    $order_date = date("Y-m-d H:i:s");

    // Fetch cart items to store in order_items table
    $sql_cart = "SELECT cart.*, products.price FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";
    $stmt_cart = $conn->prepare($sql_cart);
    $stmt_cart->bind_param("i", $user_id);
    $stmt_cart->execute();
    $cart_result = $stmt_cart->get_result();

    while ($cart_item = $cart_result->fetch_assoc()) {
        $sql_items = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt_items = $conn->prepare($sql_items);
        $stmt_items->bind_param("iiid", $order_id, $cart_item['product_id'], $cart_item['quantity'], $cart_item['price']);
        $stmt_items->execute();
    }

    // Clear the cart
    $sql_clear_cart = "DELETE FROM cart WHERE user_id = ?";
    $stmt_clear_cart = $conn->prepare($sql_clear_cart);
    $stmt_clear_cart->bind_param("i", $user_id);
    $stmt_clear_cart->execute();

} else {
    $_SESSION['order_error'] = true;
    $_SESSION['order_error_message'] = "Error placing order: " . $stmt_orders->error;
    header("Location: checkout.php");
    exit;
}
?>

<main class="main-content confirmation-page">
    <h1>Order Confirmation</h1>
    <div class="confirmation-container">
        <div class="message-container success-message">
            <p>Your order has been placed successfully!</p>
            <p>Order ID: <?php echo $order_id; ?></p>
            <p>Order Date: <?php echo $order_date; ?></p>
            <p>Total Amount: $<?php echo $total_amount; ?></p>
        </div>
        <a href="index.php" class="continue-shopping-btn">Continue Shopping</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
<style>
    .confirmation-page {
        padding: 50px 20px;
        max-width: 800px;
        margin: 20px auto;
    }

    .confirmation-container {
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 30px;
        text-align: center;
    }

    .message-container {
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
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
        margin: 5px 0;
    }

    .continue-shopping-btn {
        display: inline-block;
        padding: 12px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 1em;
        transition: background-color 0.3s ease;
    }

    .continue-shopping-btn:hover {
        background-color: #0056b3;
    }

    @media (max-width: 600px) {
        .confirmation-page {
            padding: 30px 10px;
        }

        .message-container {
            font-size: 1em;
        }

        .continue-shopping-btn {
            padding: 10px 15px;
            font-size: 0.9em;
        }
    }
</style>