<?php
include 'db_connect.php';
include 'includes/header.php';

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<main class="main-content">
    <h1>Products</h1>

    <?php if (isset($_SESSION['admin_id'])): ?>
        <div class="add-product-container">
            <a href="add_product.php" class="add-product-btn">Add Product</a>
        </div>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <div class="products-grid">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-item">
                    <h3><?php echo $row['name']; ?></h3>
                    <p>Price: $<?php echo $row['price']; ?></p>
                    <p><?php echo $row['description']; ?></p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="product_details.php?id=<?php echo $row['id']; ?>" class="view-details">View Details</a>
                        <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="add-to-cart">Add to Cart</a>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['admin_id'])): ?>
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="edit-link">Edit</a>
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="delete-link" onclick="return confirm('Are you sure?')">Delete</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>

<style>
    .main-content {
        padding: 20px;
        max-width: 1200px;
        margin: 20px auto;
    }

    .add-product-container {
        text-align: right;
        margin-bottom: 20px;
    }

    .add-product-btn {
        display: inline-block;
        padding: 10px 15px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .product-item {
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .product-item h3 {
        margin-bottom: 10px;
    }

    .product-item p {
        margin-bottom: 5px;
    }

    .view-details,
    .add-to-cart,
    .edit-link,
    .delete-link {
        display: inline-block;
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
        margin-right: 5px;
        margin-top: 10px;
    }

    .view-details {
        background-color: #007bff;
        color: white;
    }

    .add-to-cart {
        background-color: #28a745;
        color: white;
    }

    .edit-link {
        background-color: #007bff;
        color: white;
    }

    .delete-link {
        background-color: #dc3545;
        color: white;
    }
</style>