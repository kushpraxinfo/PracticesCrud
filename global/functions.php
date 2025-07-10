<?php


function getAllProducts($sort, $order, $start, $limit)
{
    global $conn;

    $sql = "SELECT * FROM products ORDER BY $sort $order LIMIT $start, $limit";
    return mysqli_query($conn, $sql);
}

function getProductsBySearch($search, $sort, $order)
{
    global $conn;

    $sql = "SELECT * FROM products 
            WHERE name LIKE '%$search%' OR price LIKE '%$search%' 
            ORDER BY $sort $order";
    return mysqli_query($conn, $sql);
}

function addProduct($name, $description, $price, $image)
{
    global $conn;
    $sql = "INSERT INTO products (name, description, price, image) 
            VALUES ('$name', '$description', '$price', '$image')";
    return mysqli_query($conn, $sql);
}

function deleteProduct($id){
    global $conn;
    $sql = "DELETE FROM products WHERE id = $id";
    return mysqli_query($conn,$sql);
}

function editProduct($name, $description, $price, $image ,$id){
    global $conn;

       if (!empty($_FILES['product_image']['name'])) {
        $image = basename($_FILES['product_image']['name']);
            $targetFile = "./uploads/" . $image;
        move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile);
    }

    $sql = "UPDATE products SET 
                name='$name', 
                price='$price', 
                description='$description',
                image='$image'
            WHERE id = $id";

    return mysqli_query($conn,$sql);
}
