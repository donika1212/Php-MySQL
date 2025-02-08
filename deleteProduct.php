<?php 

include_once("config.php");

$id = $_GET['id'];

$sql = "DELETE FROM products WHERE id=:id";

$deleteProduct = $conn->prepare($sql);
$deleteProduct->bindParam(':id', $id);
$deleteProduct->execute();

header('Location:productDashboard.php');
exit;

?>
