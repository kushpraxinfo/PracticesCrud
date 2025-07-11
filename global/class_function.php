<?php
require_once 'global/db.php';
class Product
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }
    public function getAllProducts($sort, $order, $start, $limit)
    {
        global $conn;

        $sql = "SELECT * FROM products ORDER BY $sort $order LIMIT $start, $limit";
        return mysqli_query($conn, $sql);
    }

    public function getProductsBySearch($search, $sort, $order)
    {
        global $conn;

        $sql = "SELECT * FROM products 
            WHERE name LIKE '%$search%' OR price LIKE '%$search%' 
            ORDER BY $sort $order";
        return mysqli_query($conn, $sql);
    }

    public function addProduct($name, $description, $price, $image)
    {
        global $conn;
        $sql = "INSERT INTO products (name, description, price, image) 
            VALUES ('$name', '$description', '$price', '$image')";
        return mysqli_query($conn, $sql);
    }

    public function deleteProduct($id)
    {
        global $conn;
        $sql = "DELETE FROM products WHERE id = $id";
        return mysqli_query($conn, $sql);
    }

    public function editProduct($name, $description, $price, $image, $id)
    {
        global $conn;

        $sql = "UPDATE products SET 
                name='$name', 
                price='$price', 
                description='$description',
                image='$image'
            WHERE id = $id";

        return mysqli_query($conn, $sql);
    }
}
