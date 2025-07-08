<?php

require_once 'db.php';

    $id = $_GET['p_id'];

    $sql = "DELETE FROM products WHERE p_id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo 'Cannot delete product.';
    }

mysqli_close($conn);
?>