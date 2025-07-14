<?php
require_once 'global/Database.php';
require_once 'models/Products.php';

// Collect form data
$name = $_POST['product_name'];
$description = $_POST['description'];
$price = $_POST['price'];

// Handle file upload
$targetDir = "uploads/";
$fileName = basename($_FILES["product_image"]["name"]);
$targetFile = $targetDir . $fileName;

if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
    // Create product object and add to database
    $product = new Product($name, $price, $description, $fileName);
    
    if ($product->add()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Product could not be added: " . mysqli_error(Database::getInstance()->getConnection());
    }
} else {
    echo "File upload failed.";
}
