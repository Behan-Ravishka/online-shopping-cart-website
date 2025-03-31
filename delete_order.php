<?php
include 'admin_auth.php';
include 'db_connect.php';

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    $sql = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['order_delete_success'] = true;
        header("Location: orders.php");
        exit;
    } else {
        session_start();
        $_SESSION['order_delete_error'] = "Error deleting order: " . $stmt->error;
        header("Location: orders.php");
        exit;
    }
} else {
    session_start();
    $_SESSION['order_delete_error'] = "Order ID not provided.";
    header("Location: orders.php");
    exit;
}
?>