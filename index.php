<?php
require_once 'db.php';
require_once 'functions.php';
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';  //one line add
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
$toggle = ($order === 'ASC') ? 'DESC' : 'ASC';

if (!empty($search)) {
    $result = getProductsBySearch($search, $sort, $order);
} else {
    $result = getAllProducts($sort, $order, $start, $limit);
}
// $result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD PHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" />
</head>
<body>
  <hr>
  <div id="heading" class="text-center">
    <h2>Project CRUD</h2>
  </div>
  <hr>

  <form method="GET" class="d-flex justify-content-lg-end me-5 mb-3">
    <input type="text" name="search" placeholder="Search by Name Or Price" class="form-control w-25 me-2" value="<?php echo $search; ?>">
    <button type="submit" class="btn btn-success">Search</button>
  </form>

  <div class="button-add mb-2 d-flex justify-content-lg-end me-5">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Products</button>
  </div>

  <table class="table container" style="border: 2px solid black;">
    <thead>
      <tr>
        <th><a href="?sort=id&order=<?php echo $toggle; ?>">Product ID</a></th>
        <th><a href="?sort=name&order=<?php echo $toggle; ?>">Name</a></th>
        <th>Description</th>
        <th><a href="?sort=price&order=<?php echo $toggle; ?>">Price</a></th>
        <th>Product Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
       <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td class="w-50"><?php echo $row['description']; ?></td>
          <td><?php echo $row['price']; ?></td>
          <td><img height="50px" src="./uploads/<?php echo $row['image']; ?>"></td>
          <td>
            <a class="btn btn-primary" href="edit_product.php?p_id=<?php echo $row['id']; ?>"><i class="fa-solid fa-pen me-2"></i>Edit</a>
            <a class="btn btn-danger" href="delete_product.php?p_id=<?php echo $row['id']; ?>"><i class="fa-solid fa-trash me-2"></i>Delete</a>
          </td>
        </tr> 
      <?php } ?>
    </tbody>
  </table>

  <!-- Pagination -->
  <div class="d-flex justify-content-center mt-4">
    <ul class="pagination">
      <?php
      if (empty($search)) {
        $countQuery = "SELECT COUNT(*) as total FROM products";
        $countResult = mysqli_query($conn, $countQuery);
        $totalRecords = mysqli_fetch_assoc($countResult)['total'];
        $totalPages = ceil($totalRecords / $limit);

        if ($page > 1) {
          echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "'>Prev</a></li>";
        }

        for ($i = 1; $i <= $totalPages; $i++) {
          $active = ($i == $page) ? 'active' : '';
          echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
        }

        if ($page < $totalPages) {
          echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "'>Next</a></li>";
        }
      }
      ?>
    </ul>
  </div>

  <!-- Modal to Add Product -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form action="save_data.php" method="POST" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3"><label>Name:</label><input type="text" class="form-control" name="product_name" required></div>
          <div class="mb-3"><label>Description:</label><input type="text" class="form-control" name="description" required></div>
          <div class="mb-3"><label>Price:</label><input type="text" class="form-control" name="price" required></div>
          <div class="mb-3"><label>Product Image:</label><input type="file" name="product_image" required></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Product</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
