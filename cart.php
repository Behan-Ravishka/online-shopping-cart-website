<?php
session_start();
include 'db_connect.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch cart items
$sql = "SELECT cart.*, products.name, products.price FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<main class="main-content cart-page">
    <h1>Shopping Cart</h1>
    <?php if ($result->num_rows > 0): ?>
        <div class="cart-container">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_cart_amount = 0;
                    while ($row = $result->fetch_assoc()):
                        $total_item_price = $row['price'] * $row['quantity'];
                        $total_cart_amount += $total_item_price;
                    ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td>$<?php echo $row['price']; ?></td>
                            <td>
                                <form method="post" action="update_cart.php" class="quantity-form">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                    <div class="quantity-input">
                                        <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1">
                                        <button type="submit" class="update-link">Update</button>
                                    </div>
                                </form>
                            </td>
                            <td>$<?php echo $total_item_price; ?></td>
                            <td>
                                <a href="remove_from_cart.php?id=<?php echo $row['product_id']; ?>" class="remove-link">Remove</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="3" align="right"><strong>Total:</strong></td>
                        <td>$<?php echo $total_cart_amount; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="checkout-area">
                <a href="checkout.php" class="checkout-link">Proceed to Checkout</a>
            </div>
        </div>
    <?php else: ?>
        <p class="empty-cart-message">Your cart is empty.</p>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>

<style>
    .cart-page {
        padding: 50px 20px;
        max-width: 1200px;
        margin: 20px auto;
    }

    .cart-container {
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
    }

    .cart-table th,
    .cart-table td {
        border: 1px solid #ddd;
        padding: 12px 15px;
        text-align: left;
    }

    .cart-table th {
        background-color: #f2f2f2;
        font-weight: 600;
    }

    .cart-table tbody tr:nth-child(even) {
        background-color: #f5f5f5;
    }

    .quantity-form {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        display: flex;
        align-items: center;
    }

    .quantity-input input[type="number"] {
        width: 60px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-right: 5px;
        text-align: center;
    }

    .remove-link,
    .update-link {
        display: inline-block;
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
        margin-right: 5px;
        font-size: 0.9em;
        transition: background-color 0.3s ease;
    }

    .remove-link {
        background-color: #dc3545;
        color: white;
    }

    .update-link {
        background-color: #007bff;
        color: white;
    }

    .remove-link:hover,
    .update-link:hover {
        opacity: 0.8;
    }

    .checkout-area {
        margin-top: 30px;
        text-align: right;
    }

    .checkout-link {
        display: inline-block;
        padding: 12px 20px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 1em;
        transition: background-color 0.3s ease;
    }

    .checkout-link:hover {
        background-color: #218838;
    }

    .empty-cart-message {
        text-align: center;
        margin-top: 30px;
        font-size: 1.1em;
        color: #555;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .cart-page {
            padding: 30px 10px;
        }

        .cart-table th,
        .cart-table td {
            padding: 10px;
            font-size: 0.9em;
        }

        .quantity-input input[type="number"] {
            width: 50px;
        }

        .remove-link,
        .update-link,
        .checkout-link {
            padding: 8px 12px;
            font-size: 0.8em;
        }
    }
</style>