<?php

require_once 'model/product.php';
$product = new product($conn);
$id = $_GET['p_id'];
if (isset($_GET['p_id'])) {
    $product->id = $id;
    $product->delete();
    header("Location: index.php");
    exit();
}
mysqli_close($conn);
