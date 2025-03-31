<?php
include 'admin_auth.php';
include 'db_connect.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    echo "<p class='error-message'>Order ID not provided.</p>";
    exit;
}

$order_id = $_GET['id'];

// Fetch order details
$sql = "SELECT orders.*, users.name AS user_name FROM orders JOIN users ON orders.user_id = users.id WHERE orders.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_result = $stmt->get_result();

if ($order_result->num_rows == 0) {
    echo "<p class='error-message'>Order not found.</p>";
    exit;
}

$order = $order_result->fetch_assoc();

// Fetch order items
$sql_items = "SELECT order_items.*, products.name FROM order_items JOIN products ON order_items.product_id = products.id WHERE order_items.order_id = ?";
$stmt_items = $conn->prepare($sql_items);
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$items_result = $stmt_items->get_result();
?>

<main class="admin-main">
    <h1>View Order #<?php echo $order_id; ?></h1>

    <div class="order-details">
        <p><strong>User:</strong> <?php echo $order['user_name']; ?></p>
        <p><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>
        <p><strong>Total Amount:</strong> $<?php echo $order['total_amount']; ?></p>
    </div>

    <h2>Order Items</h2>
    <table class="order-items-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            while ($item = $items_result->fetch_assoc()):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>$<?php echo $item['price']; ?></td>
                    <td>$<?php echo $subtotal; ?></td>
                </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="3" align="right"><strong>Total:</strong></td>
                <td>$<?php echo $total; ?></td>
            </tr>
        </tbody>
    </table>
</main>

<?php include 'includes/footer.php'; ?>

<style>
    .admin-main {
        padding: 50px 20px;
        max-width: 1000px;
        margin: 20px auto;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .order-details {
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f0f0f0;
        border-radius: 5px;
    }

    .order-items-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
    }

    .order-items-table th,
    .order-items-table td {
        border: 1px solid #ddd;
        padding: 12px 15px;
        text-align: left;
    }

    .order-items-table th {
        background-color: #f2f2f2;
        font-weight: 600;
    }

    .order-items-table tbody tr:nth-child(even) {
        background-color: #f5f5f5;
    }

    .error-message {
        color: #dc3545;
        text-align: center;
        margin-top:20px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .admin-main {
            padding: 30px 10px;
        }

        .order-items-table th,
        .order-items-table td {
            padding: 10px;
            font-size: 0.9em;
        }
    }
</style>