<?php

require_once 'db.php';

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

    // Check if a new image was uploaded
    if (!empty($_FILES['product_image']['name'])) {
        $image = basename($_FILES['product_image']['name']);
        move_uploaded_file($_FILES['product_image']['tmp_name'], UPLOAD_PATH . $image);
    } else {
        // No new image uploaded, keep old one
        $image = $row['image'];
    }

    $sql = "UPDATE products SET 
                name='$name', 
                price='$price', 
                description='$desc',
                image='$image'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>


<h2>Edit Product</h2>
<div class="container ">
   <form method="POST" enctype="multipart/form-data">
        <label>Product Name:</label><br>
        <input type="text" name="product_name" value="<?php echo  $row['name'] ?>" required><br><br>

        <label>Price:</label><br>
        <input type="text" name="product_price" value="<?php echo  $row['price'] ?>" required><br><br>

        <label>Description:</label><br>
        <textarea name="product_description" rows="4" cols="50" required><?php echo $row['description'] ?></textarea><br><br>

        <label>Current Image:</label><br>
        <img src="uploads/<?php echo $row['image'] ?>" height="80"><br><br>

        <label>Change Image : </label><br>
        <input type="file" name="product_image"><br><br>

        <button type="submit" name="update">Update</button>
    </form> 
</div>
</body>

</html>