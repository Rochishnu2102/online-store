<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Online Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="container-fluid bg-info text-white py-3">
  <div class="container d-flex justify-content-between align-items-center">
    <h1>Smartphone Store</h1>
    <a href="add.php" class="btn btn-light">+ Add a New Item</a>
  </div>
</section>

<section class="container my-5">
  <div class="row">
    <?php include 'db.php'; // Include database connection
    

      // DB connection
      $stmt = $pdo->query("SELECT id, model_name, model_no, price, model_image FROM smartphones");
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

      
        foreach ($rows as $row):


    ?>
      <div class="col-md-3 mb-4 p-2">
        <div class="card h-100">
          <?php if ($row['model_image']): ?>
            <img src="images/<?php echo $row['model_image'] ;?>" height="200px">
        <?php endif; ?>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?php echo $row['model_name']?></h5>
            <p class="mb-1">Model No: <?php echo $row['model_no'] ?></p>
            <p class="mb-3">Price: ₹<?php echo $row['price'] ?></p>
            <div class="mt-auto">
              <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
              <a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-danger"
                 onclick="return confirm('Delete this item?')">Delete</a>
            </div>
          </div>
        </div>
      </div>
    <?php
        endforeach;
      if (empty($rows)):
      echo "<div class='col-12'>
        <div class='alert alert-warning text-center'>No smartphones found.</div>
      </div>";
    ?>
      
      
    <?php endif; ?>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>