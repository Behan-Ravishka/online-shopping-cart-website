<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .signup-container {
            height: auto;
            padding: 20px;
            max-width: 400px;
            margin: 50px auto;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .signup-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .signup-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .signup-container .btn.primary-btn {
            width: 100%;
            padding: 10px;
            background-color: #FFC107;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .signup-container .btn.primary-btn:hover {
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

        @media (max-width: 600px) {
            .signup-container {
                max-width: 90%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="signup-container">
        <h2>User Signup</h2>

        <?php

        if (isset($_SESSION['signup_success']) && $_SESSION['signup_success']) {
            echo '<div class="message-container success-message"><p>Signup successful!</p></div>';
            unset($_SESSION['signup_success']);
        }

        if (isset($_SESSION['signup_error']) && $_SESSION['signup_error']) {
            echo '<div class="message-container error-message"><p>' . $_SESSION['signup_error'] . '</p></div>';
            unset($_SESSION['signup_error']);
        }
        ?>

        <form method="post" action="signup_process.php">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn primary-btn">Signup</button>
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>