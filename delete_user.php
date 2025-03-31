<?php
include 'admin_auth.php';
include 'db_connect.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $_SESSION['user_delete_success'] = true;
        header("Location: users.php");
        exit;
    } else {
        $_SESSION['user_delete_error'] = "Error deleting user: " . $stmt->error;
        header("Location: users.php");
        exit;
    }
} else {
    $_SESSION['user_delete_error'] = "User ID not provided.";
    header("Location: users.php");
    exit;
}
?>