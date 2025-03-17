<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Account</h4>
            <ul>
                <?php if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) { ?>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Signup</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Contact Us</h4>
            <p>Email: info@auracart.com</p>
            <p>Phone: +1 123 456 7890</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> AuraCart. All rights reserved.</p>
    </div>
</footer>