<?php
require_once 'db.php';

$name = $_POST['product_name'];
$description = $_POST['description'];
$price = $_POST['price'];

$targetDir = "uploads/";
$fileName = basename($_FILES["product_image"]["name"]);
$targetFile = $targetFile . $fileName;

// Move file to upload folder
if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
    echo "The file ". htmlspecialchars($filename). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
    exit();
}

// Save data to database
$sql = "INSERT INTO products (name, description, price, image) 
        VALUES ('$name', '$description', $price, '$fileName')";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo "Product is not added: " . mysqli_error($conn);
}

mysqli_close($conn);


?>