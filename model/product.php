<?php
require_once 'global/db.php';

class Product
{
    private $conn;

    public $id, $name, $price, $description, $image;

     public function __construct($connection,$name,$price,$description,$image)
    {
        $this->conn = $connection;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
    }
 
    public static function getAll($conn, $sort, $order, $start, $limit)
    {
        $sql = "SELECT * FROM products ORDER BY $sort $order LIMIT $start, $limit";
        return mysqli_query($conn, $sql);
    }


    public static function getProductsBySearch($conn, $search, $sort, $order)
    {
        $sql = "SELECT * FROM products 
                WHERE name LIKE '%$search%' OR price LIKE '%$search%' 
                ORDER BY $sort $order";
        return mysqli_query($conn, $sql);
    }


    public static function findById($conn, $id)
    {
        $sql = "SELECT * FROM products WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            throw new Exception("Product not found");
        }
    }


    public function add()
    {
        $sql = "INSERT INTO products (name, description, price, image) 
                VALUES ('$this->name', '$this->description', '$this->price', '$this->image')";
        return mysqli_query($this->conn, $sql);
    }


    public function delete()
    {
        $sql = "DELETE FROM products WHERE id = $this->id";
        return mysqli_query($this->conn, $sql);
    }


    public function edit()
    {
        if (!empty($_FILES['product_image']['name'])) {
            $this->image = basename($_FILES['product_image']['name']);
            $targetFile = "./uploads/" . $this->image;
            move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile);
        }

        $sql = "UPDATE products SET 
                    name='$this->name', 
                    price='$this->price', 
                    description='$this->description',
                    image='$this->image'
                WHERE id = $this->id";

        return mysqli_query($this->conn, $sql);
    }
}
