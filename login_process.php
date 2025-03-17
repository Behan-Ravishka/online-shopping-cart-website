// login_process.php
<?php
session_start();
include 'includes/db_connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT id, role FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['role'] == 'admin') {
        $_SESSION['admin_id'] = $row['id'];
        header("Location: admin/dashboard.php");
    } else {
        $_SESSION['user_id'] = $row['id'];
        header("Location: index.php");
    }
} else {
    echo "Invalid email or password.";
}
?>