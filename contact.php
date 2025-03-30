<?php include 'includes/header.php'; ?>
<main class="contact-main">
    <h1>Contact Us</h1>
    <div class="contact-container">
        <div class="contact-form">
            <form action="contact_process.php" method="post">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <textarea name="message" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn primary-btn">Send Message</button>
            </form>
        </div>
        <div class="contact-info">
            <p><strong>Email:</strong> <a href="mailto:info@auracart.com">info@auracart.com</a></p>
            <p><strong>Phone:</strong> +94 23 456 7890</p>
            <p><strong>Address:</strong> 123 Main St, Anytown, USA</p>
        </div>
    </div>
</main>
<?php include 'includes/footer.php'; ?>

<style>
/* Contact Page Styles */
.contact-main {
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.contact-main h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #673AB7; /* Primary color */
}

.contact-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.contact-form {
    flex: 1 1 45%;
    min-width: 300px;
    background-color: #f8f8f8;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.contact-form .form-group {
    margin-bottom: 20px;
}

.contact-form input[type="text"],
.contact-form input[type="email"],
.contact-form textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

.contact-form textarea {
    height: 150px;
    resize: vertical;
}

.contact-info {
    flex: 1 1 45%;
    min-width: 300px;
    padding: 30px;
    background-color: #e9e9e9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.contact-info p {
    margin-bottom: 15px;
    line-height: 1.6;
    color: #333;
}

.contact-info a {
    color: #673AB7; /* Primary color */
    text-decoration: none;
}

.contact-info a:hover {
    text-decoration: underline;
}

/* Responsive Styles */
@media screen and (max-width: 768px) {
    .contact-container {
        flex-direction: column;
    }

    .contact-form, .contact-info {
        flex: 1 1 100%;
        margin-bottom: 20px;
    }
}

.btn.primary-btn {
    background-color: #FFC107;
    color: black;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.btn.primary-btn:hover {
    background-color: #FFD54F;
}

</style>