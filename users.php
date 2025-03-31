<?php
include 'admin_auth.php';
include 'db_connect.php';
include 'includes/header.php';

// Fetch users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<main class="admin-main">
    <h1>Manage Users</h1>

    <?php
    if (isset($_SESSION['user_delete_success']) && $_SESSION['user_delete_success']) {
        echo '<div class="message-container success-message"><p>User deleted successfully!</p></div>';
        unset($_SESSION['user_delete_success']); // Clear the session variable
    }

    if (isset($_SESSION['user_delete_error']) && $_SESSION['user_delete_error']) {
        echo '<div class="message-container error-message"><p>' . $_SESSION['user_delete_error'] . '</p></div>';
        unset($_SESSION['user_delete_error']); // Clear the session variable
    }
    ?>

    <table class="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Coins</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['coins']; ?></td>
                    <td>
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="delete-link" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php include 'includes/footer.php'; ?>

<style>
    .admin-main {
        padding: 120px;
        max-width: 1000px;
        margin: 20px auto;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .admin-main h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
    }

    .users-table th,
    .users-table td {
        border: 1px solid #ddd;
        padding: 12px 15px;
        text-align: left;
    }

    .users-table th {
        background-color: #f2f2f2;
        font-weight: 600;
    }

    .users-table tbody tr:nth-child(even) {
        background-color: #f5f5f5;
    }

    .delete-link {
        display: inline-block;
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
        background-color: #dc3545;
        color: white;
        transition: background-color 0.3s ease;
    }

    .delete-link:hover {
        background-color: #c82333;
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
    @media (max-width: 768px) {
        .admin-main {
            padding: 30px 10px;
        }

        .users-table th,
        .users-table td {
            padding: 10px;
            font-size: 0.9em;
        }

        .delete-link {
            padding: 6px 10px;
            font-size: 0.8em;
        }
    }
</style>