<?php

require_once 'global/db.php';
require_once 'model/product.php';

// print_r($_GET);

if (isset($_POST['update'])) {
    $product = new Product($conn);
        $product->id = $_POST['id'];
    
        $row = Product::findById($conn, $product->id);
    
    $product->name = $_POST['product_name'];
    $product->price = $_POST['product_price'];
    $product->description = $_POST['product_description'];

    if (!empty($_FILES['product_image']['name'])) {
        $image = basename($_FILES['product_image']['name']);
        $targetFile = "./uploads/" . $image;
        move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile);
    } else {
          $product->image = $row['image'];
    }

    $product->edit();
    header("Location: index.php");
    exit();
}
