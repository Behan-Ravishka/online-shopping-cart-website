<?php
// admin/login_process.php
session_start();
include 'db_connect.php';

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];

if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
    $sql = "SELECT id, password FROM admins WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            echo "<div class='message-container success-message'>";
            echo "<p>Admin Login Successful! Redirecting to Admin dashboard...</p>";
            echo "</div>";
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'dashboard.php';
                }, 1500);
            </script>";
            exit();
        } else {
            echo "<div class='message-container error-message'>";
            echo "<p>Invalid password.</p>";
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'admin_login.php';
                }, 1500);
            </script>";
            echo "</div>";
        }
    } else {
        echo "<div class='message-container error-message'>";
        echo "<p>Invalid email.</p>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'admin_login.php';
                }, 1500);
            </script>";
        echo "</div>";
    }

    $stmt->close();
} else {
    echo "<div class='message-container error-message'>";
    echo "<p>Invalid email or password.</p>";
    echo "<script>
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 1500);
            </script>";
    echo "</div>";
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