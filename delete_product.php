<?php
include 'admin_auth.php';
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<div class='message-container success-message'>";
        echo "<p>Product deleted successfully.</p>";
        echo "<script>
            setTimeout(function() {
                window.location.href = 'products.php';
            }, 1500);
        </script>";
        echo "</div>";
        exit;
    } else {
        echo "<div class='message-container error-message'>";
        echo "<p>Error deleting product: " . $stmt->error . "</p>";
        echo "</div>";
    }
} else {
    echo "<div class='message-container error-message'>";
    echo "<p>Product ID not provided.</p>";
    echo "</div>";
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