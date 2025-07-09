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


// function getSortedProducts($sortColumn, $sortOrder)
// {
//     global $conn;
    
//     // Allow only specific columns to sort
//     $allowedColumns = ['id', 'name', 'price'];
//     $sortColumn = in_array($sortColumn, $allowedColumns) ? $sortColumn : 'id';

//     // Order validation
//     $sortOrder = ($sortOrder === 'ASC') ? 'ASC' : 'DESC';

//     $sql = "SELECT * FROM products ORDER BY $sortColumn $sortOrder";
//     return mysqli_query($conn, $sql);
// }