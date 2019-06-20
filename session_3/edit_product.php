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
              <h3 class="box-title">Edit Product</h3>
            </div>
            <!-- /.box-header -->

				<?php

					require_once 'connect.php';

					$arrCat = array();
					$cats = $conn->query("SELECT * FROM product_categories");
					if($cats->num_rows > 0) {
						while ($row = $cats->fetch_assoc()) {
							$arrCat[$row['id']] = $row['name']; 
						}
					}
					$errName = $errCat = $errPrice = $errQtt = $errDes = $des = $name = $cat = $price = $qtt = $image_name = '';
					$id = $_GET['id'];
					$pathUpload = 'assets/img/uploads/products/';
					$errName = $errCity = $errEmail = $errDate = $errGender = $errPhone = $name = $email = $city = $date = $gender = $avatar_name = $phone = '';
					$getOne = $conn->query("SELECT * FROM products WHERE id = $id");
					if($getOne->num_rows > 0) {
						while ($getOneRow = $getOne->fetch_assoc()) {
							$name = $getOneRow['name'];
							$cat = $getOneRow['cat_id'];
							$price = $getOneRow['price'];
							$qtt = $getOneRow['quantity'];
							$image_name = $getOneRow['image_name'];
							$des = $getOneRow['description'];
						}
					}
					if(isset($_POST['edit_product'])) {
						$name = $_POST['name'];
						$qtt = $_POST['quantity'];
						$cat = $_POST['category'];
						$price = $_POST['price'];
						$des = $_POST['description'];
						$check = true;
						if($name == '') {
							$errName = 'Please Enter Product Name!';
							$check = false;
						}
						if($cat == '') {
							$errCat = 'Please Choose A Category!';
							$check = false;
						}
						if($price == '') {
							$errPrice = 'Please Enter Product Price!';
							$check = false;
						} else {
							if(!is_numeric($price)) {
								$errPrice = 'Product Price Must Be Numberic!';
								$check = false;
							}
						}

						if($check) {

							// Upload Avatar

							if($_FILES['image']['error'] == 0) {
								unlink($pathUpload . $image_name);
								$image_name = uniqid() . '_' . $_FILES['image']['name'];
								move_uploaded_file($_FILES['image']['tmp_name'], $pathUpload . $image_name);
							}

								$sql = "UPDATE products SET name = '$name', price = $price, quantity = $qtt, cat_id = $cat, image_name = '$image_name', description = '$des' WHERE id = $id";
								if ($conn->query($sql) === TRUE) {
								    header("Location: list_products.php");
								} else {
								    echo "Error: " . $sql . "<br>" . $conn->error;
								}
						}
					}
				?>

            <!-- form start -->
            <form role="form" name="editProduct" action="#" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group <?php echo ($errName != '')?'has-error':''; ?>">
                  <label for="inputName">Product Name</label>
                  <input type="text" class="form-control" id="inputName" placeholder="Enter Product Name" name="name" value="<?= $name; ?>">
                  <span class="error-block help-block"><?php echo $errName ?></span>
                </div>
                <div class="form-group <?php echo ($errPrice != '')?'has-error':''; ?>">
                  <label for="inputEmail">Price</label>
                  <input type="text" class="form-control" id="inputPrice" placeholder="Enter Price" name="price" value="<?= $price; ?>">
                  <span class="error-block help-block"><?php echo $errPrice ?></span>
                </div>
                <div class="form-group">
                  <label for="inputFile">Product Image</label>
                  <input type="file" id="inputFile" name="image">
                </div>
                <?php 
                	if($image_name != ''){
                		echo "<div class='form-group'><img src='". $pathUpload . $image_name ."'></div>";
                	}
                ?>
				<div class="form-group <?php echo ($errCat != '')?'has-error':''; ?>">
					<label>Category</label>
					<select class="form-control select2" style="width: 100%;" name="category">
					  <option value="">Choose a Category</option>
					  <?php
					  	foreach ($arrCat as $key => $value) {
					  		$selected = ($cat == $key)?'selected':'';
							echo '<option value="'. $key .'"' . $selected . '>' . $value . '</option>';
					  	}
					  ?>
					</select>
                	<span class="error-block help-block"><?php echo $errCat ?></span>
				</div>
                <div class="form-group <?php echo ($errQtt != '')?'has-error':''; ?>">
                  <label for="inputEmail">Quantity</label>
                  <input type="number" min="1" class="form-control" id="inputQuantity" name="quantity" value="<?php echo ($qtt != '')?$qtt:'1'; ?>">
                  <span class="error-block help-block"><?php echo $errQtt ?></span>
                </div>
                <div class="form-group <?php echo ($errDes != '')?'has-error':''; ?>">
                  <label>Description</label>
                  <textarea class="form-control" rows="3" name="description" placeholder="Enter Description"><?php echo $des; ?></textarea>
                  <span class="error-block help-block"><?php echo $errDes ?></span>
                </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="edit_product">Edit</button>
              </div>
            </form>
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php require_once 'common/footer.php'; ?>
