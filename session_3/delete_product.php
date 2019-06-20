<?php
	require_once 'connect.php';
	$id = $_GET['id'];
	$sql = "DELETE FROM products WHERE id = $id";
	$pathUpload = 'assets/img/uploads/products/';
		$avatar = $conn->query("SELECT image_name FROM products WHERE id = $id");
		$avatar = $avatar->fetch_assoc();
		$avatar_name = $avatar['image_name'];
	if ($conn->query($sql) === TRUE) {
		unlink($pathUpload . $avatar_name);
	    header("Location: list_products.php");
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>