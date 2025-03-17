// signup_process.php
<?php
include 'includes/db_connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'user')";

if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>