<?php

require_once 'global/db.php';
require_once 'model/product.php';


if (isset($_POST['update'])) {
    $product = new Product($conn,$name,$description,$price,$fileName);
    
    $product->id = $_POST['id'];
    $product->name = $_POST['product_name'];
    $product->price = $_POST['product_price'];
    $product->description = $_POST['product_description'];

    if (!empty($_FILES['product_image']['name'])) {
        $image = basename($_FILES['product_image']['name']);
        $targetFile = "./uploads/" . $image;
        move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile);
    } else {
        $row = Product::findById($conn, $product->id);
          $product->image = $row['image'];
    }

    $product->edit();
    header("Location: index.php");
    exit();
}
