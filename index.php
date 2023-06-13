<?php 
$index_page = true;
include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
  <title>Professional Article with Pagination</title>
</head>
<body style="background-color:lightgray;">
  <div class="mx-3 mt-3">
    <h2 class="mb-3">Home</h2>
    <?php
      // Get the total number of posts
      $totalPostsQuery = $conn->query("SELECT COUNT(*) as total FROM blog_posting");
      $totalPosts = $totalPostsQuery->fetch(PDO::FETCH_ASSOC)['total'];

      // Calculate the total number of pages
      $postsPerPage = 2;
      $totalPages = ceil($totalPosts / $postsPerPage);

      // Get the current page number
      $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

      // Calculate the starting index for the current page
      $startIndex = ($currentPage - 1) * $postsPerPage;

      // Fetch posts for the current page
      $sql = "SELECT * FROM blog_posting LIMIT $startIndex, $postsPerPage";
      $query = $conn->query($sql);

      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $sql2 = "SELECT * FROM users";
        $query2 = $conn->prepare($sql2);
        $query2->execute();
        $row2 = $query2->fetch(PDO::FETCH_ASSOC);


    ?>
    <article class="card mb-3">
      <div class="card-body">
        <h4 class="card-title"><?php echo $row['post_title']; ?></h4>
        <p class="card-text"><?php echo $row['post_content']; ?></p>
        <small class="text-muted">Date Posted: <?php echo date('Y-m-d', strtotime($row['created_at'])); ?></small>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <small class="text-muted">Author: <?php echo $row2['first_name'].' '.$row2['last_name']  ?></small>
      </div>
    </article>




    <?php 
      }
    ?>

    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li class="page-item <?php echo $currentPage == 1 ? 'disabled' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" tabindex="-1" aria-disabled="true">Previous</a>
        </li>

        <?php
          for ($i = 1; $i <= $totalPages; $i++) {
        ?>
        <li class="page-item <?php echo $currentPage == $i ? 'active' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
        <?php 
          }
        ?>

        <li class="page-item <?php echo $currentPage == $totalPages ? 'disabled' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="visually-hidden">Next</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</body>

</html>



    </div>
</body>
</html>