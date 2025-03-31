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

<main class="main-content checkout-page">
    <h1>Checkout</h1>
    <?php if ($result->num_rows > 0): ?>
        <div class="checkout-container">
            <div class="checkout-details">
                <h2>Order Summary</h2>
                <table class="checkout-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_amount = 0;
                        while ($row = $result->fetch_assoc()):
                            $item_total = $row['price'] * $row['quantity'];
                            $total_amount += $item_total;
                        ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>$<?php echo $row['price']; ?></td>
                                <td>$<?php echo $item_total; ?></td>
                            </tr>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="3" align="right"><strong>Total:</strong></td>
                            <td>$<?php echo $total_amount; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="payment-options">
                <h2>Payment Options</h2>
                <div class="payment-method">
                    <input type="radio" id="creditCard" name="paymentMethod" value="creditCard" checked>
                    <label for="creditCard">Credit Card</label>
                    <div class="payment-details" id="creditCardDetails">
                        <input type="text" placeholder="Card Number">
                        <input type="text" placeholder="Expiry Date">
                        <input type="text" placeholder="CVV">
                    </div>
                </div>
                <div class="payment-method">
                    <input type="radio" id="paypal" name="paymentMethod" value="paypal">
                    <label for="paypal">PayPal</label>
                    <div class="payment-details" id="paypalDetails" style="display: none;">
                        <input type="email" placeholder="PayPal Email">
                    </div>
                </div>
                <div class="payment-method">
                    <input type="radio" id="dummyBank" name="paymentMethod" value="dummyBank">
                    <label for="dummyBank">Dummy Bank Transfer</label>
                    <div class="payment-details" id="dummyBankDetails" style="display: none;">
                        <p>Bank Name: Dummy Bank</p>
                        <p>Account Number: 1234567890</p>
                    </div>
                </div>
                <button class="place-order-btn" onclick="processPayment(<?php echo $total_amount; ?>)">Place Order</button>
                <div id="paymentMessage" style="display: none;"></div>
            </div>
        </div>
    <?php else: ?>
        <p class="empty-cart-message">Your cart is empty. Please add items to your cart before checkout.</p>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>

<script>
    document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.payment-details').forEach(details => {
                details.style.display = 'none';
            });
            document.getElementById(this.value + 'Details').style.display = 'block';
        });
    });

    function processPayment(totalAmount) {
        let success = Math.random() < 0.8;

        let messageDiv = document.getElementById('paymentMessage');
        messageDiv.style.display = 'block';

        if (success) {
            messageDiv.innerHTML = '<div class="message-container success-message"><p>Payment processed successfully!</p></div>';
            setTimeout(function() {
                window.location.href = "order_confirmation.php?total=" + totalAmount;
            }, 1500);
        } else {
            messageDiv.innerHTML = '<div class="message-container error-message"><p>Payment failed. Please try again.</p></div>';
            setTimeout(function() {
                messageDiv.style.display = 'none';
            }, 3000);
        }
    }
</script>

<style>
    .checkout-page {
        padding: 50px 20px;
        max-width: 1200px;
        margin: 20px auto;
    }

    .checkout-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .checkout-details,
    .payment-options {
        flex: 1 1 48%;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .checkout-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .checkout-table th,
    .checkout-table td {
        border: 1px solid #ddd;
        padding: 12px 15px;
        text-align: left;
    }

    .checkout-table th {
        background-color: #f2f2f2;
        font-weight: 600;
    }

    .payment-method {
        margin-bottom: 15px;
    }

    .payment-details {
        margin-top: 10px;
    }

    .payment-details input,
    .payment-details p {
        width: 100%;
        padding: 8px;
        margin-bottom: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .place-order-btn {
        background-color: #28a745;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .place-order-btn:hover {
        background-color: #218838;
    }

    .empty-cart-message {
        text-align: center;
        margin-top: 30px;
        font-size: 1.1em;
        color: #555;
    }

    .message-container {
        padding: 20px;
        margin-top: 20px;
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

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .checkout-container {
            flex-direction: column;
        }

        .checkout-details,
        .payment-options {
            flex: 1 1 100%;
        }
    }
</style>