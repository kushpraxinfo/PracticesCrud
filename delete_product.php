<?php

require_once 'global/db.php';
require_once 'global/class_function.php';
$product = new product($conn);
$id = $_GET['p_id'];
if (isset($_GET['p_id'])) {
    $product->deleteProduct($id);
    header("Location: index.php");
    exit();
}

mysqli_close($conn);
