<?php require_once 'global/db.php';
require_once 'model/product.php';
// print_r($_GET);
// $product = new Product($conn,$name,$description,$price,$fileName);

$row = [];
if(isset($_GET['p_id'])){
    $id = $_GET['p_id'];
    $row = Product::findById($conn, $id);
}

?>
<h2>Edit Product</h2>
<div class="container ">
    <form action="update_product.php" method="POST" enctype="multipart/form-data">
        
        <label>Product Id:</label><br>
        <input type="text" name="id" value="<?php echo  $row['id']; ?>" required><br><br>
    
        <label>Product Name:</label><br>
        <input type="text" name="product_name" value="<?php echo  $row['name']; ?>" required><br><br>

        <label>Price:</label><br>
        <input type="text" name="product_price" value="<?php echo  $row['price']; ?>" required><br><br>

        <label>Description:</label><br>
        <textarea name="product_description" rows="4" cols="50" required><?php echo $row['description']; ?></textarea><br><br>

        <label>Current Image:</label><br>
        <img src="uploads/<?php echo $row['image']; ?>" name="image" height="80"><br><br>

        <label>Change Image : </label><br>
        <input type="file" name="product_image"><br><br>

        <button type="submit" name="update">Update</button>
    </form>
</div>
</body>

</html>