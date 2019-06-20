<?php
	require_once 'connect.php';
	$id = $_GET['id'];
	$sql = "DELETE FROM users WHERE id = $id";
	$pathUpload = 'assets/img/uploads/';
		$avatar = $conn->query("SELECT avatar FROM users WHERE id = $id");
		$avatar = $avatar->fetch_assoc();
		$avatar_name = $avatar['avatar'];
	if ($conn->query($sql) === TRUE) {
		unlink($pathUpload . $avatar_name);
	    header("Location: list_users.php");
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>