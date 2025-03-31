<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .login-container {
            height: auto; /* Allow container to grow based on content */
            padding: 50px;
            max-width: 400px;
            margin: 50px auto;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box; /* Include padding and border in element's total width and height */
        }

        .login-container .btn.primary-btn {
            width: 100%;
            padding: 10px;
            background-color: #FFC107;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container .btn.primary-btn:hover {
            background-color: #FFD54F;
        }

        .message-container {
            padding: 20px;
            margin-bottom: 20px;
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

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .login-container {
                max-width: 90%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="login-container">
        <h2>User Login</h2>

        <?php

        if (isset($_SESSION['login_success']) && $_SESSION['login_success']) {
            echo '<div class="message-container success-message"><p>Login successful!</p></div>';
            unset($_SESSION['login_success']); // Clear the session variable
        }

        if (isset($_SESSION['login_error']) && $_SESSION['login_error']) {
            echo '<div class="message-container error-message"><p>' . $_SESSION['login_error'] . '</p></div>';
            unset($_SESSION['login_error']); // Clear the session variable
        }
        ?>

        <form method="post" action="login_process.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn primary-btn">Login</button>
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>