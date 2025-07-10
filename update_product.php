<?php

require_once 'db.php';
require_once 'functions.php';
// print_r($_GET);
if (isset($_GET['p_id'])) {
    $id = $_GET['p_id'];

    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found";
        exit();
    }
}

if (isset($_POST['update'])) {
    $name  = $_POST['product_name'];
    $price = $_POST['product_price'];
    $desc  = $_POST['product_description'];

    editProduct($name, $desc, $price, $image, $id);
    header("Location: index.php");
    exit();
}

?>