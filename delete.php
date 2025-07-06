<?php include 'db.php';

$id = $_GET['id'];
$sql = "SELECT model_image FROM smartphones WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$model_image = $stmt->fetchColumn();

if ($model_image) unlink("images/$model_image");

$stmt = $pdo->prepare("DELETE FROM smartphones WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
?>