<?php
include 'db_connect.php';

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];

if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {

    $sql = "INSERT INTO admins (email, password) VALUES (?, ?)"; // Correct table
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        echo "<div class='message-container success-message'><p>Admin signup successful! Redirecting to Admin login...</p></div>";
        echo "<script>setTimeout(function(){ window.location.href = 'admin_login.php'; }, 1500);</script>";
    } else {
        echo "<div class='message-container error-message'><p>Error: " . $stmt->error . "</p></div>";
    }

    $stmt->close();
} else {
    echo "<div class='message-container error-message'><p>Invalid email or password.</p></div>";
}

$conn->close();
?>

<style>
    /* Message styles (same as login_process.php) */
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