<?php
include 'admin_auth.php';
include '../db_connect.php';
include '../includes/header.php';
?>

<main class="admin-main">
    <h1>Admin Dashboard</h1>
    <a href="products.php">Manage Products</a>
    <a href="users.php">Manage Users</a>
    <a href="orders.php">Manage Orders</a>
</main>

// admin/products.php (Example for product management)
<?php
// ... (Admin authentication)
?>
<main class="admin-main">
    <h1>Manage Products</h1>
    <a href="add_product.php">Add New Product</a>
    <?php
    // Fetch and display products in a table
    ?>
</main>
<?php include '../includes/footer.php'; ?>