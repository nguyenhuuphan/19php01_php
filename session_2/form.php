<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
</head>
<body>

	<?php
		if(isset($_POST['register_submit'])){
			if($_POST['name'] == '') {
				$errName = 'Nhập vào!';
			} else {
				$errName = '';
			}
			if($_POST['password'] == '')  {
				$errPass = 'Nhập vào!';
			} else {
				$errPass = '';
			}
			echo $_POST['name'];
			echo "<br>";
			echo $_POST['password'];
		}
	?>
	
	<form action="#" method="POST" name="register">
		<p>
			Name: <input type="text" name="name" value="<?php echo $_POST['name'] ?>">
			<span><?php echo $errName; ?></span>
		</p>
		<p>
			Pass: <input type="password" name="password">
			<span><?php echo $errPass; ?></span>
		</p>
		<p>
			<input type="submit" name="register_submit" value="Submit">
		</p>
	</form>

</body>
</html>