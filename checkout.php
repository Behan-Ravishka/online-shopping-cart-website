<?php include 'includes/header.php'; ?>
<main class="checkout-main">
    <h1>Checkout</h1>
    $coupon_code = $_POST['coupon_code'];
$sql = "SELECT * FROM coupons WHERE code = '$coupon_code'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $coupon = $result->fetch_assoc();
    $discount_amount = $coupon['discount_amount']; // Or calculate discount based on type
    $total_amount = $total_amount - $discount_amount;
}
    <a href="payment/dummy_payment.php" class="btn primary-btn">Pay Now</a>
</main>
<?php include 'includes/footer.php'; ?>