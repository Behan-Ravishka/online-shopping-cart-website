<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        // Check if the email already exists
        $check_sql = "SELECT id FROM admins WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo "<div class='message-container error-message'><p>Email already exists. Please use a different email.</p></div>";
            exit();
        }

        $check_stmt->close();

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new admin
        $sql = "INSERT INTO admins (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $hashed_password);

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
}

$conn->close();
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
