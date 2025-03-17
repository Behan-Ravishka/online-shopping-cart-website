<?php include 'includes/header.php'; ?>
<main class="contact-main">
    <h1>Contact Us</h1>
    <div class="contact-form">
        <form action="contact_process.php" method="post">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit" class="btn primary-btn">Send Message</button>
        </form>
    </div>
    <div class="contact-info">
        <p>Email: info@auracart.com</p>
        <p>Phone: +1 123 456 7890</p>
        <p>Address: 123 Main St, Anytown, USA</p>
    </div>
</main>
<?php include 'includes/footer.php'; ?>