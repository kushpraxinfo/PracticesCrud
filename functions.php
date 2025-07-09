<?php

// 2. Count total products for pagination
function getTotalProducts($conn, $search = '') {
    $search_sql = "";

    if (!empty($search)) {
        $search_sql = "WHERE name LIKE '%$search%' OR price LIKE '%$search%'";
    }

    $count_sql = "SELECT COUNT(*) AS total FROM products $search_sql";
    $result = mysqli_query($conn, $count_sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

// 3. Generate pagination HTML
function showPagination($totalRecords, $limit, $currentPage, $search = '') {
    $totalPages = ceil($totalRecords / $limit);
    $searchParam = !empty($search) ? '&search=' . urlencode($search) : '';

    echo '<ul class="pagination">';

    if ($currentPage > 1) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . $searchParam . '">Prev</a></li>';
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $currentPage) ? 'active' : '';
        echo '<li class="page-item ' . $active . '"><a class="page-link" href="?page=' . $i . $searchParam . '">' . $i . '</a></li>';
    }

    if ($currentPage < $totalPages) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . $searchParam . '">Next</a></li>';
    }

    echo '</ul>';
}
?>
