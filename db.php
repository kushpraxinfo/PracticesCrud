<?php


$conn = mysqli_connect("localhost","root","","product-crud");

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }



   // if (isset($_GET['search']) && !empty($_GET['search'])) {
      //   $search = $_GET['search'];
      //   $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
      // } else {
      //   $sql = "SELECT * FROM products";
      // }
      // Records per page