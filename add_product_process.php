<?php
include 'admin_auth.php';
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Image Upload Handling
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "<div class='message-container error-message'><p>File is not an image.</p></div>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "<div class='message-container error-message'><p>Sorry, your file is too large.</p></div>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "<div class='message-container error-message'><p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p></div>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<div class='message-container error-message'><p>Sorry, your file was not uploaded.</p></div>";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $sql = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssds", $name, $description, $price, basename($_FILES["image"]["name"]));

            if ($stmt->execute()) {
                echo "<div class='message-container success-message'><p>Product added successfully.</p></div>";
                 echo "<script>
                    setTimeout(function() {
                        window.location.href = 'products.php';
                    }, 1500);
                </script>";
            } else {
                echo "<div class='message-container error-message'><p>Error adding product: " . $stmt->error . "</p></div>";
            }
        } else {
            echo "<div class='message-container error-message'><p>Sorry, there was an error uploading your file.</p></div>";
        }
    }
}
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