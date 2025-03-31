<?php
// Process the contact form submission
// Send email or store message in the database

// Dummy success message
$success = true; // or false based on form processing
$redirect = false; // Initialize $redirect

if ($success) {
    $message = "Message sent successfully!";
    $messageClass = "success-message";
    $redirect = true; // Set redirect flag
} else {
    $message = "Failed to send message. Please try again.";
    $messageClass = "error-message";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Response</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .message-container {
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 1.1em;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
</head>
<body>
    <div class="message-container <?php echo $messageClass; ?>">
        <p><?php echo $message; ?></p>
        <?php if ($redirect): ?>
            <script>
                setTimeout(function(){
                    window.location.href = 'contact.php';
                }, 1500);
            </script>
        <?php endif; ?>
    </div>
</body>
</html>