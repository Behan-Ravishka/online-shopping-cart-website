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

<style>
    .profile-main {
        height: 320px; /* Adjusted to auto for dynamic content */
        margin: 20px auto; /* Centered with auto margins */
        max-width: 800px; /* Added max width for better readability */
        padding: 20px;
        background-color: rgba(103, 58, 181); /* Glass background */
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        color: white; /* Text color for better visibility */
    }

    .profile-main h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #FFC107; /* Primary color for heading */
    }

    .profile-main p {
        margin-bottom: 10px;
        font-size: 1.1em;
    }

    /* Add more styles for order history, coins, coupons, etc. as needed */
</style>