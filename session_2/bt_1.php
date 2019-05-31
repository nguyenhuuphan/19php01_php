<!DOCTYPE html>
<html>
<head>
	<title>BT 1</title>
</head>
<body>

	<?php
		$result = 0;
			$err_a = $err_b = '';
		if(isset($_GET['cal'])) {
			if($_GET['a'] == '') {
				$err_a = 'Nhập vào!';
			} elseif(!is_numeric($_GET['a'])) {
				$err_a = 'Nhập số!';
			} else {
				$err_a = '';
				$result += $_GET['a'];
			}
			if($_GET['b'] == '') {
				$err_b = 'Nhập vào!';
			} elseif(!is_numeric($_GET['b'])) {
				$err_b = 'Nhập số!';
			} else {
				$err_b = '';
				$result += $_GET['b'];
			}

		}
	?>

	<form action="#" name="Tong" method="get">
		<p>
			a: <input type="text" name="a" value="<?php echo (isset($_GET['a']))?$_GET['a']:''; ?>">
			<span><?php echo $err_a; ?></span>
		</p>
		<p>
			b: <input type="text" name="b" value="<?php echo (isset($_GET['b']))?$_GET['b']:''; ?>">
			<span><?php echo $err_b; ?></span>
		</p>
		<p>
			<input type="submit" name="cal" value="Calc">
		</p>
	</form>

	<p>a+b = <?php echo ($result!=0)?$result:''; ?></p>

</body>
</html>