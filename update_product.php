<?php

require_once 'global/db.php';
require_once 'models/products.php';

// print_r($_GET);


if (isset($_POST['update'])) {
    $id = $_POST['id'];

    $row = Product::findById($id);

    $product = new Product(
        $_POST['product_name'],
        $_POST['product_price'],
        $_POST['product_description'],
        $row['image']
    );
    $product->id = $id;

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
