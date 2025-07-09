<?php

require_once 'db.php';
require_once 'functions.php';
$id = $_GET['p_id'];
if (isset($_GET['p_id'])) {
    deleteProduct($id);
    header("Location: index.php");
    exit();
}

mysqli_close($conn);
