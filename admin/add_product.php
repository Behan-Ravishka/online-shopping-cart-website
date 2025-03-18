// admin/add_product.php
<?php include '../includes/header.php'; ?>
<form method="post" action="add_product_process.php" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Name">
    <textarea name="description" placeholder="Description"></textarea>
    <input type="number" name="price" placeholder="Price">
    <input type="file" name="image">
    <button type="submit">Add Product</button>
</form>
<?php include '../includes/footer.php'; ?>