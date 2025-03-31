<?php
include 'admin_auth.php';
include 'db_connect.php';
include 'includes/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch product details
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<div class='message-container error-message'><p>Product not found.</p></div>";
        exit;
    }
} else {
    echo "<div class='message-container error-message'><p>Product ID not provided.</p></div>";
    exit;
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Image Upload Handling
    if ($_FILES['image']['error'] == 0) {
        $targetDir = "../uploads/";
        // Check if the uploads directory exists
        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) { // Create the directory if it doesn't exist
                echo "<div class='message-container error-message'><p>Error: Upload directory does not exist and could not be created.</p></div>";
                exit;
            }
        }
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
                $image = basename($_FILES["image"]["name"]);
                $sql = "UPDATE products SET name = ?, price = ?, description = ?, image = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdssi", $name, $price, $description, $image, $id);
            } else {
                echo "<div class='message-container error-message'><p>Sorry, there was an error uploading your file.</p></div>";
                exit;
            }
        }
    } else {
        $sql = "UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdsi", $name, $price, $description, $id);
    }

    if ($stmt->execute()) {
        echo "<div class='message-container success-message'><p>Product updated successfully.</p></div>";
        echo "<script>
            setTimeout(function() {
                window.location.href = 'products.php';
            }, 1500);
        </script>";
    } else {
        echo "<div class='message-container error-message'><p>Error updating product: " . $stmt->error . "</p></div>";
    }
}
?>

<main class="admin-main">
    <h1>Edit Product</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $product['description']; ?></textarea><br><br>

        <label for="image">Image (Optional):</label>
        <input type="file" name="image" accept="image/*"><br><br>

        <button type="submit" name="submit">Update Product</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>

<style>
    .admin-main form {
        max-width: 500px;
        margin: 20px auto;
    }

    .admin-main label {
        display: block;
        margin-bottom: 5px;
    }

    .admin-main input,
    .admin-main textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .admin-main button {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

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