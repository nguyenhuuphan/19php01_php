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
              <h3 class="box-title">Edit Category</h3>
            </div>
            <!-- /.box-header -->

				<?php

					require_once 'connect.php';
					$errName = $name = '';
          $id = $_GET['id'];
          $getOne = $conn->query("SELECT * FROM product_categories WHERE id = $id");
          if($getOne->num_rows > 0) {
            while ($getOneRow = $getOne->fetch_assoc()) {
              $name = $getOneRow['name'];
            }
          }
					if(isset($_POST['edit_cat'])) {
						$name = $_POST['name'];
						$check = true;
						if($name == '') {
							$errName = 'Please Enter Your Name!';
							$check = false;
						}

						if($check) {

								$sql = "UPDATE product_categories SET name = '$name' WHERE id = $id";
								if ($conn->query($sql) === TRUE) {
								    header("Location: list_categories.php");
								} else {
								    echo "Error: " . $sql . "<br>" . $conn->error;
								}

						}
					}
				?>

            <!-- form start -->
            <form role="form" name="editCategory" action="#" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group <?php echo ($errName != '')?'has-error':''; ?>">
                  <label for="inputName">Name</label>
                  <input type="text" class="form-control" id="inputName" placeholder="Enter Name" name="name" value="<?= $name; ?>">
                  <span class="error-block help-block"><?php echo $errName ?></span>
                </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="edit_cat">Edit Category</button>
              </div>
            </form>
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php require_once 'common/footer.php'; ?>
