<?php
// admin/admin_auth.php (Authentication check)
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>