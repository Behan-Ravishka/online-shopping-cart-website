<?php
include 'admin_auth.php';
include 'includes/header.php';
?>

<main class="admin-main">
    <h1>Add New Product</h1>
    <form method="post" action="add_product_process.php" enctype="multipart/form-data" class="add-product-form">
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Name" required>

        <label for="description">Description:</label>
        <textarea name="description" placeholder="Description" required></textarea>

        <label for="price">Price:</label>
        <input type="number" name="price" placeholder="Price" required>

        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit">Add Product</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>

<style>
    .admin-main {
        padding: 20px;
        max-width: 600px;
        margin: 20px auto;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .admin-main h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .add-product-form {
        display: flex;
        flex-direction: column;
    }

    .add-product-form label {
        margin-bottom: 5px;
    }

    .add-product-form input,
    .add-product-form textarea {
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .add-product-form button {
        padding: 10px 15px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .add-product-form button:hover {
        background-color: #218838;
    }
</style>