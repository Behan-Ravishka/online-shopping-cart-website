<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.php" class="footer-link">Home</a></li>
                <li><a href="products.php" class="footer-link">Products</a></li>
                <li><a href="contact.php" class="footer-link">Contact</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Account</h4>
            <ul>
                <?php if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) { ?>
                    <li><a href="profile.php" class="footer-link">Profile</a></li>
                    <li><a href="logout.php" class="footer-link">Logout</a></li>
                <?php } else { ?>
                    <li><a href="login.php" class="footer-link">Login</a></li>
                    <li><a href="signup.php" class="footer-link">Signup</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Contact Us</h4>
            <p>Email: <a href="mailto:info@auracart.com" class="footer-contact-link">info@auracart.com</a></p>
            <p>Phone: +94 23 456 7890</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> AuraCart. All rights reserved.</p>
    </div>
</footer>

<style>
/* footer styles */
footer {
    background-color: #372161; /* Darker variant of primary color */
    color: white;
    padding: 40px 20px 10px;
    font-size: 0.9em;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1); /* Shadow at the top */
}

.footer-content {
    display: flex;
    justify-content: space-around;
    max-width: 1200px;
    margin: -40px auto -20px;
    flex-wrap: wrap; /* Allows sections to wrap on smaller screens */
}

.footer-section {
    margin-bottom: 80px;
    width: 280px;
    height: 50px;
}

.footer-section h4 {
    margin-bottom: 15px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    padding-bottom: 8px;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-link {
    color: white;
    text-decoration: none;
    display: block;
    padding: 5px 0;
    transition: color 0.3s ease;
}

.footer-link:hover {
    color: #FFC107; /* Secondary color on hover */
}

.footer-contact-link {
    color: white;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-contact-link:hover {
    color: #FFC107;
}

.footer-bottom {
    text-align: center;
    padding-top: 10px;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    margin-top: 30px;
}

/* Responsive adjustments */
@media screen and (max-width: 768px) {
    .footer-content {
        flex-direction: column; /* Stack sections vertically */
        align-items: center;
    }

    .footer-section {
        width: 100%; /* Take full width on smaller screens */
        text-align: center;
    }
}
</style>