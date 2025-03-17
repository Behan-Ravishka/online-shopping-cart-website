// admin/dashboard.php
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}
include '../includes/header.php';
?>
<main class="admin-main">
    <h1>Admin Dashboard</h1>
    <a href="products.php">Manage Products</a>
    <a href="users.php">Manage Users</a>
    <a href="orders.php">Manage Orders</a>
</main>
<?php include '../includes/footer.php'; ?>

// admin/products.php (Example for product management)
<?php
// ... (Admin authentication)
include '../includes/header.php';
?>
<main class="admin-main">
    <h1>Manage Products</h1>
    <a href="add_product.php">Add New Product</a>
    <?php
    // Fetch and display products in a table
    ?>
</main>
<?php include '../includes/footer.php'; ?>