<?php include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM smartphones WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model_name = $_POST['model_name'];
    $model_no = $_POST['model_no'];
   $price = $row['price'];
   $model_image = $row['model_image'];

    if (!empty($_FILES['model_image']['name'])) {
        // Delete old image if exists
        if ($model_image && file_exists("images/$model_image")) {
            unlink("images/$model_image");
        }
        // Rename and move new image
        $model_image = time() . '_' . str_replace(" ","_",basename($_FILES["model_image"]["name"]));
        move_uploaded_file($_FILES["model_image"]["tmp_name"], "images/" . $model_image);
    }

    $stmt = $pdo->prepare("UPDATE smartphones SET model_name = ?, model_no = ?, price = ?, model_image = ? WHERE id = ?");
    $stmt->execute([$model_name, $model_no, $price, $model_image, $id]);

    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Smartphone</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2>Edit Smartphone</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Model Name</label>
      <input name="model_name" class="form-control" value="<?php echo $row['model_name'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Model No.</label>
      <input name="model_no" class="form-control" value="<?php echo $row['model_no'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Price (₹)</label>
      <input type="number" step="0.01" name="price" class="form-control"
             value="<?php echo $row['price'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Current Image</label><br>
      <?php if ($row['model_image']): ?>
        <img src="images/<?php echo $row['model_image']; ?>" height="200px"><br>
    <?php endif; ?>
    </div>
    <div class="mb-3">
      <label class="form-label">Replace Image</label>
      <input type="file" name="model_image" class="form-control" accept="image/*">
    </div>
    <button class="btn btn-primary">Save Changes</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
</html>