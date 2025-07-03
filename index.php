<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>CRUD PHP</title>
</head>

<body>
  <hr>
  <div id="heading">
    <h2>Project CRUD</h2>
  </div>
  <hr>

  <form method="GET" class="d-flex justify-content-lg-end me-5 mb-3">
    <input type="text" name="search" placeholder="Search by Name Or Price" class="form-control w-25 me-2">
    <button type="submit" class="btn btn-success">Search</button>
  </form>

  <div class="button-add mb-2 d-flex justify-content-lg-end me-5 ">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add Products</button>
  </div>
  <?php
  // $toggle =  $_GET['sort'] . "ASC" ? $_GET['sort'] . "DESC " : $_GET['sort'] . "ASC" ;

  $sort =  isset($_GET['sort']) ? $_GET['sort'] : 'p_id';
  $order = isset($_GET['order']) && $_GET['order'] == "ASC" ? "ASC" : "DESC";
  $toggle = $order == "ASC" ? "DESC" : "ASC";

  ?>
  <table id="mytable" class="table container" style="border: 2px solid black;">
    <thead>
      <tr>
        <th scope="col"><a href="?sort=p_id&order=<?php echo $toggle; ?>">Product_Id</a></th>
        <th scope="col"><a href="?sort=p_name&order=<?php echo $toggle; ?>">Name</a></th>
        <th scope="col">Description</th>
        <th scope="col"><a href="?sort=price&order=<?php echo $toggle; ?>">Price</a></th>
        <th scope="col">Product Image</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include 'db.php';

      $limit = 5;
      // Current page
      $page = isset($_GET['page']) ? $_GET['page'] : 1;
      $start = ($page - 1) * $limit;

      // Check for search value
      if (!empty($_GET['search'])) {
        $search =  $_GET['search'];

        // Query when searching
        $sql = "SELECT * FROM products WHERE price LIKE '%$search%' OR p_name LIKE '%$search%' LIMIT $start, $limit";
        $countSql = "SELECT COUNT(*) AS totalRecord FROM products WHERE p_name LIKE '%$search%'";
      } else {
        // Query when no search
        $sql = "SELECT * FROM products ORDER BY $sort $order LIMIT $start, $limit";
        $countSql = "SELECT COUNT(*) AS totalRecord FROM products";
      }

      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo
        "<tr>
        <td>{$row['p_id']}</td>
        <td>{$row['p_name']}</td>
        <td class='w-50'>{$row['p_description']}</td>
        <td>{$row['price']}</td>
        <td><img height='50px' src='./uploads/{$row["p_image"]}'></td>
        <td>
            <a class='btn-primary btn' href='edit_product.php?p_id={$row["p_id"]}'><i class='fa-solid fa-pen me-2'></i>Edit</a>   
            <a class='btn-danger btn' href='delete_product.php?p_id={$row["p_id"]}'><i class='fa-solid fa-trash me-2'></i>Delete</a>
        </td>
        </tr>";
      }
      ?>

    </tbody>
  </table>
  <!-- Pagination links -->

  <div class="d-flex justify-content-center mt-4">
    <ul class="pagination">
      <?php
      $countResult = mysqli_query($conn, $countSql);
      $totalRecords = mysqli_fetch_row($countResult)['totalRecord'];
      $totalPages = ceil($totalRecords / $limit);

      if ($page > 1) {
        echo "<li class='page-item'>
                <a class='page-link' href='index.php?page=" . ($page - 1) . "'>Prev</a>
              </li>";
      }

      for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $page) ? 'active' : '';

        echo "<li class='page-item $active'>
        <a class='page-link' href='index.php?page=$i'>$i</a></li>";
      }
      if ($totalPages > $page) {
        echo "<li class='page-item $active'>
              <a class='page-link' href='index.php?page=" . ($page + 1) . "'>Next</a>
            </li>";
      }

      ?>
    </ul>
  </div>
  <!--  end pagination link  -->

  <!-- modal  -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Add products Here
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form action="save-data.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" id="recipient-name" name="product_name" required>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Description</label>
              <input type="text" class="form-control" id="recipient-name" name="description" required>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Price:</label>
              <input type="text" class="form-control" id="recipient-name" name="price" required>
            </div>
            <div class="mb-3">
              <label>Product Image</label>
              <input type="file" name="product_image"
                required><br><br>
            </div>
            <button type="submit" class="btn btn-primary">Save Product</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>