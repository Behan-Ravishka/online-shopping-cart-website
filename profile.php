<?php include 'includes/header.php'; ?>
<main class="profile-main">
    <h1>Your Profile</h1>
    <?php
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<p>Name: ' . $row['name'] . '</p>';
        echo '<p>Email: ' . $row['email'] . '</p>';
        // Display order history, coins, coupons, etc.
    }
    ?>
</main>
<?php include 'includes/footer.php'; ?>