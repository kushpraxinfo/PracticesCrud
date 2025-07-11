<?php

require_once 'global/db.php';
require_once 'global/class_function.php';

$product = new Product($conn);
// print_r($_GET);

if (isset($_POST['update'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $name  = $_POST['product_name'];
    $price = $_POST['product_price'];
    $desc  = $_POST['product_description'];

    if (!empty($_FILES['product_image']['name'])) {
        $image = basename($_FILES['product_image']['name']);
        $targetFile = "./uploads/" . $image;
        move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile);
    }else{
        $image = $row['image'] ;
    }

    $product->editProduct($name, $desc, $price, $image, $id);
    header("Location: index.php");
    exit();
}
 




?>