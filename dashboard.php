<?php
include 'admin_auth.php';
include 'db_connect.php';
include 'includes/header.php';
?>

<main class="admin-main">
    <h1>Admin Dashboard</h1>
    <div class="dashboard-links">
        <a href="products.php" class="dashboard-link">Manage Products</a>
        <a href="users.php" class="dashboard-link">Manage Users</a>
        <a href="orders.php" class="dashboard-link">Manage Orders</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<style>
    .admin-main {
        padding: 110px;
        max-width: 800px;
        margin: 20px auto;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .admin-main h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .dashboard-links {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    .dashboard-link {
        display: block;
        padding: 15px 20px;
        margin: 10px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        text-align: center;
        min-width: 150px; /* Ensures consistent button widths */
    }

    .dashboard-link:hover {
        background-color: #0056b3;
    }

    @media (max-width: 600px) {
        .dashboard-link {
            width: 100%;
            margin: 10px 0;
        }
    }
</style>