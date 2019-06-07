<!DOCTYPE html>
<html>
<head>
	<title>BT 2</title>
	<style type="text/css">
		span {
			color: red;
		}
	</style>
</head>
<body>

	<?php

		$arrGender = array(
			'nam' => 'Nam',
			'nu' => 'Nữ',
		);
		$arrCity = array(
			'dn' => 'Đà Nẵng',
			'hn' => 'Hà Nội',
			'hcm' => 'Hồ Chí Minh',
		);

		$name = $email = $sdt = $gender = $city = $date = $avatar_name = $errName = $errEmail = $errSdt = $errGender = $errCity = $errDate = '';
		if(isset($_POST['register_submit'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$sdt = $_POST['sdt'];
			$gender = (isset($_POST['gender']))?$_POST['gender']:'';
			$city = $_POST['city'];
			$date = (isset($_POST['birthday']))?$_POST['birthday']:'';
			if($name == '') {
				$errName = 'Nhap vao!';
				$check = false;
			} else {
				$errName = '';
				$check = true;
			}
			if($email == '') {
				$errEmail = 'Nhap vao!';
				$check = false;
			} else {
				$errEmail = '';
				$check = true;
			}
			if($sdt == '') {
				$errSdt = 'Nhap vao!';
				$check = false;
			} else {
				$errSdt = '';
				$check = true;
			}
			if($date == '') {
				$errDate = 'Nhap vao!';
				$check = false;
			} else {
				$errDate = '';
				$check = true;
			}
			if($city == '') {
				$errCity = 'Chọn thành phố!';
				$check = false;
			} else {
				$errCity = '';
				$check = true;
			}
			if($gender == '') {
				$errGender = 'Chọn giới tính!';
				$check = false;
			} else {
				$errGender = '';
				$check = true;
			}
			if($date == '') {
				$errDate = 'Chọn ngày sinh!';
				$check = false;
			} else {
				$errDate = '';
				$check = true;
			}

			if($check) {
				echo "Name: $name <br> Email: $email <br> Phone: $sdt <br> Gender: " . $arrGender["$gender"] . "<br> City: " . $arrCity["$city"] . "<br>" . "Birthday: $date";

				// Upload Avatar

				if($_FILES['avatar']['error'] == 0) {
					$avatar_name = uniqid() . '_' . $_FILES['avatar']['name'];
					$pathUpload = 'uploads/';
					move_uploaded_file($_FILES['avatar']['tmp_name'], $pathUpload . $avatar_name);
				}
			}
		}
	?>

	<form action="#" name="register" method="post" enctype="multipart/form-data">
		<p>
			Tên: <input type="text" name="name" value="<?php echo $name; ?>">
			<span><?php echo $errName; ?></span>
		</p>
		<p>
			Avatar: <input type="file" name="avatar">
			<?php
				if($avatar_name != '') echo "<img src=$pathUpload/$avatar_name width='150'>";
			?>
		</p>
		<p>
			Email: <input type="email" name="email" value="<?php echo $email; ?>">
			<span><?php echo $errEmail; ?></span>
		</p>
		<p>
			Sđt: <input type="text" name="sdt" value="<?php echo $sdt; ?>">
			<span><?php echo $errSdt; ?></span>
		</p>
		<p>
			Giới tính:
			<input type="radio" name="gender" value="nam" <?php echo ($gender == 'nam')?'checked':''; ?>> Nam
			<input type="radio" name="gender" value="nu" <?php echo ($gender == 'nu')?'checked':''; ?>> Nữ
			<span><?php echo $errGender; ?></span>
		</p>
		<p>
			Quê quán:
			<select name="city">
				<option value="">Chọn thành phố</option>
				<option value="dn" <?php echo ($city == 'dn')?'selected':''; ?>>ĐN</option>
				<option value="hn" <?php echo ($city == 'hn')?'selected':''; ?>>HN</option>
				<option value="hcm" <?php echo ($city == 'hcm')?'selected':''; ?>>HCM</option>
			</select>
			<span><?php echo $errCity; ?></span>
		</p>
		<p>
			Ngày sinh: <input type="date" name="birthday" value="<?php echo $date; ?>">
			<span><?php echo $errDate; ?></span>
		</p>
		<p>
			<input type="submit" name="register_submit" value="Submit">
		</p>
	</form>

</body>
</html>