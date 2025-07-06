<?php include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model_name = $_POST['model_name'];
    $model_no = $_POST['model_no'];
    $price = $_POST['price'];



    if (!empty($_FILES['model_image']['name'])) {
        $targetDir = "images/";
         $model_image = time() . '_' . str_replace(" ","_",basename($_FILES["model_image"]["name"]));
        move_uploaded_file($_FILES["model_image"]["tmp_name"], $targetDir . $model_image);
    }

    $stmt = $pdo->prepare("INSERT INTO smartphones (model_name, model_no, price, model_image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$model_name, $model_no, $price, $model_image]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Smartphone</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2>Add New Smartphone</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Model Name</label>
      <input name="model_name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Model No.</label>
      <input name="model_no" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Price (₹)</label>
      <input type="number" step="0.01" name="price" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Image</label>
      <input type="file" name="model_image" class="form-control" accept="image/*" required>
    </div>
    <button class="btn btn-success">Add Item</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
</html>