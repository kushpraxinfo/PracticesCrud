<?php
require_once 'global/db.php';
require_once 'models/products.php';
$product = new product($conn,$name,$price,$description,$image);
$id = $_GET['p_id'];
if (isset($_GET['p_id'])) {
    $product->id = $id;
    $product->delete();
    header("Location: index.php");
    exit();
}
mysqli_close($conn);
