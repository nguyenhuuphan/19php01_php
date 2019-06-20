<?php
	require_once 'connect.php';
	$id = $_GET['id'];
	$sql = "DELETE FROM product_categories WHERE id = $id";
	if ($conn->query($sql) === TRUE) {
	    header("Location: list_categories.php");
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>