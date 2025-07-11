<?php
require_once 'global/db.php';
require_once 'global/class_function.php';
$product = new Product($conn);

$name = $_POST['product_name'];
$description = $_POST['description'];
$price = $_POST['price'];

$targetDir = "uploads/";
$fileName = basename($_FILES["product_image"]["name"]);
$targetFile = $targetDir . $fileName;

// Move uploaded file
if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
    // Save to DB
        $product->addProduct($name, $description, $price, $fileName);
        header("Location: index.php");
        exit();
    } else {
        echo "Product is not added: " . mysqli_error($conn);
    }

mysqli_close($conn);
?>
