<?php
include 'db.php';

$p_name = $_POST['product_name'];
$description = $_POST['description'];
$price = $_POST['price'];

$targetDir = "uploads/";
$filename = basename($_FILES["product_image"]["name"]);
$targetFile = $targetDir . $filename;

// Move file to upload folder
if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
    echo "The file ". htmlspecialchars($filename). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
    exit();
}

// Save data to database
$sql = "INSERT INTO products (p_name, p_description, price, p_image) 
        VALUES ('$p_name', '$description', $price, '$filename')";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo "Product is not added: " . mysqli_error($conn);
}

mysqli_close($conn);


//   $searchParam = !empty($search) ? "&search=" . $search : "";
      //   echo "<li class='page-item $active'>
      //         <a class='page-link' href='index.php?page=$i$searchParam'>$i</a>
      //       </li>";
?>
