<?php require_once 'common/header.php'; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit User</h3>
            </div>
            <!-- /.box-header -->

				<?php


					$arrGender = array(
						'male' => 'Nam',
						'female' => 'Nữ',
					);
					$arrCity = array(
						'dn' => 'Đà Nẵng',
						'hn' => 'Hà Nội',
						'hcm' => 'Hồ Chí Minh',
					);

					$id = $_GET['id'];
					$pathUpload = 'assets/img/uploads/';
					$errName = $errCity = $errEmail = $errDate = $errGender = $errPhone = $name = $email = $city = $date = $gender = $avatar_name = $phone = '';
					$getOne = $conn->query("SELECT * FROM users WHERE id = $id");
					if($getOne->num_rows > 0) {
						while ($getOneRow = $getOne->fetch_assoc()) {
							$name = $getOneRow['name'];
							$email = $getOneRow['email'];
							$city = $getOneRow['city'];
							$date = $getOneRow['birthday'];
							$gender = $getOneRow['gender'];
							$phone = $getOneRow['phone'];
							$avatar_name = $getOneRow['avatar'];
						}
					}
					if(isset($_POST['edit_user'])) {
						$name = $_POST['name'];
						$email = $_POST['email'];
						$city = $_POST['city'];
						$date = $_POST['date'];
						$gender = (isset($_POST['gender']))?$_POST['gender']:'';
						$phone = $_POST['phone'];
						$check = true;
						if($name == '') {
							$errName = 'Please Enter Your Name!';
							$check = false;
						}
						if($email == '') {
							$errEmail = 'Please Enter Your Email!';
							$check = false;
						}
						if($city == '') {
							$errCity = 'Please Choose A City!';
							$check = false;
						}
						if($date == '') {
							$errDate = 'Please Pick a Date!';
							$check = false;
						}
						if($gender == '') {
							$errGender = 'Please Choose Gender!';
							$check = false;
						}
						if($phone == '') {
							$errPhone = 'Please Enter Your Phone Number!';
							$check = false;
						} else {
							if(!is_numeric($phone)) {
								$errPhone = 'Phone Number Must Be Numberic!';
								$check = false;
							}
						}

						if($check) {

							// Upload Avatar

							if($_FILES['avatar']['error'] == 0) {
								unlink($pathUpload . $avatar_name);
								$avatar_name = uniqid() . '_' . $_FILES['avatar']['name'];
								move_uploaded_file($_FILES['avatar']['tmp_name'], $pathUpload . $avatar_name);
							}

							$sql = "UPDATE users SET name = '$name', email = '$email', phone = '$phone', gender = '$gender', city = '$city', birthday = '$date', avatar = '$avatar_name' WHERE id = $id";
							if ($conn->query($sql) === TRUE) {
							    header("Location: list_users.php");
							} else {
							    echo "Error: " . $sql . "<br>" . $conn->error;
							}

						}
					}
				?>

            <!-- form start -->
            <form role="form" name="editForm" action="#" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group <?php echo ($errName != '')?'has-error':''; ?>">
                  <label for="inputName">Name</label>
                  <input type="text" class="form-control" id="inputName" placeholder="Enter Name" name="name" value="<?= $name; ?>">
                  <span class="error-block help-block"><?php echo $errName ?></span>
                </div>
                <div class="form-group <?php echo ($errEmail != '')?'has-error':''; ?>">
                  <label for="inputEmail">Email address</label>
                  <input type="email" class="form-control" id="inputEmail" placeholder="Enter email" name="email" value="<?= $email; ?>">
                  <span class="error-block help-block"><?php echo $errEmail ?></span>
                </div>
                <div class="form-group <?php echo ($errPhone != '')?'has-error':''; ?>">
                  <label for="inputPhone">Phone</label>
                  <input type="text" class="form-control" id="inputPhone" placeholder="Enter Phone" name="phone" value="<?= $phone; ?>">
                  <span class="error-block help-block"><?php echo $errPhone ?></span>
                </div>
                <div class="form-group">
                  <label for="inputFile">Avatar</label>
                  <input type="file" id="inputFile" name="avatar">
                </div>
                <?php 
                	if($avatar_name != ''){
                		echo "<div class='form-group'><img src='". $pathUpload . $avatar_name ."'></div>";
                	}
                ?>
				<div class="form-group <?php echo ($errCity != '')?'has-error':''; ?>">
					<label>City</label>
					<select class="form-control select2" style="width: 100%;" name="city">
					  <option value="">Choose a City</option>
					  <option value="dn" <?php echo ($city == 'dn')?'selected':''; ?>>Đà Nẵng</option>
					  <option value="hcm" <?php echo ($city == 'hcm')?'selected':''; ?>>Hồ Chí Minh</option>
					  <option value="hn" <?php echo ($city == 'hn')?'selected':''; ?>>Hà Nội</option>
					</select>
                	<span class="error-block help-block"><?php echo $errCity ?></span>
				</div>
				<div class="form-group <?php echo ($errGender != '')?'has-error':''; ?>">
					<label style="display: block;">
					  Gender
					</label>
					<label>
					  <input type="radio" name="gender" class="minimal" value="male" <?php echo ($gender == 'male')?'checked':''; ?>>
					  Male
					</label>
					<label>
					  <input type="radio" name="gender" class="minimal" value="female" <?php echo ($gender == 'female')?'checked':''; ?>>
					  Female
					</label>
                 	<span class="error-block help-block"><?php echo $errGender ?></span>
				</div>
				<div class="form-group <?php echo ($errDate != '')?'has-error':''; ?>">
	                <label>Birthday</label>

	                <div class="input-group date">
	                  <div class="input-group-addon">
	                    <i class="fa fa-calendar"></i>
	                  </div>
	                  <input type="text" class="form-control pull-right" id="datepicker" name="date" value="<?= $date; ?>">
	                </div>
                 	<span class="error-block help-block"><?php echo $errDate ?></span>
	            </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="edit_user">Edit</button>
              </div>
            </form>
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php require_once 'common/footer.php'; ?>
