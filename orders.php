<?php
// orders.php (modified to display messages)
include 'admin_auth.php';
include 'db_connect.php';
include 'includes/header.php';

// Fetch orders from the database
$sql = "SELECT orders.*, users.name AS user_name FROM orders JOIN users ON orders.user_id = users.id ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<main class="admin-main">
    <h1>Manage Orders</h1>

    <?php

    if (isset($_SESSION['order_delete_success']) && $_SESSION['order_delete_success']) {
        echo '<div class="message-container success-message"><p>Order deleted successfully!</p></div>';
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'orders.php';
                }, 1500);
            </script>";
        unset($_SESSION['order_delete_success']);
    }

    if (isset($_SESSION['order_delete_error']) && $_SESSION['order_delete_error']) {
        echo '<div class="message-container error-message"><p>' . $_SESSION['order_delete_error'] . '</p></div>';
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'orders.php';
                }, 1500);
            </script>";
        unset($_SESSION['order_delete_error']);
    }
    ?>

    <table class="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td>$<?php echo $row['total_amount']; ?></td>
                    <td>
                        <a href="view_order.php?id=<?php echo $row['id']; ?>" class="view-link">View</a>
                        <a href="delete_order.php?id=<?php echo $row['id']; ?>" class="delete-link" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php include 'includes/footer.php'; ?>

<style>
    .admin-main {
        padding: 120px 20px;
        max-width: 1000px;
        margin: 20px auto;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .admin-main h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
    }

    .orders-table th,
    .orders-table td {
        border: 1px solid #ddd;
        padding: 12px 15px;
        text-align: left;
    }

    .orders-table th {
        background-color: #f2f2f2;
        font-weight: 600;
    }

    .orders-table tbody tr:nth-child(even) {
        background-color: #f5f5f5;
    }

    .view-link,
    .delete-link {
        display: inline-block;
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
        margin-right: 5px;
        transition: background-color 0.3s ease;
    }

    .view-link {
        background-color: #17a2b8;
        color: white;
    }

    .delete-link {
        background-color: #dc3545;
        color: white;
    }

    .view-link:hover {
        background-color: #138496;
    }

    .delete-link:hover {
        background-color: #c82333;
    }

    .message-container {
        padding: 20px;
        margin-bottom: 20px;
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

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .admin-main {
            padding: 30px 10px;
        }

        .orders-table th,
        .orders-table td {
            padding: 10px;
            font-size: 0.9em;
        }

        .view-link,
        .delete-link {
            padding: 6px 10px;
            font-size: 0.8em;
        }
    }
</style>