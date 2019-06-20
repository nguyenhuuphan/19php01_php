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
              <h3 class="box-title">List Users</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th style="width: 50px">Image</th>
                  <th>Category</th>
                  <th>Description</th>
                  <td>Action</td>
                </tr>
                <?php
        					require_once 'connect.php';
                  $arrCat = array();
                  $cats = $conn->query("SELECT * FROM product_categories");
                  if($cats->num_rows > 0) {
                    while ($row = $cats->fetch_assoc()) {
                      $arrCat[$row['id']] = $row['name']; 
                    }
                  }
                	$sql = "SELECT * FROM products";
                	$list = $conn->query($sql);
                	if($list->num_rows > 0) {
                    $i = 1;
                		while($row = $list->fetch_assoc()) {
                ?>
			                <tr>
			                  <td><?php echo $i ?></td>
			                  <td><?php echo $row['name']; ?></td>
			                  <td><?php echo $row['price']; ?></td>
			                  <td><?php echo $row['quantity']; ?></td>
			                  <td>
			                  	<?php
			                  		if($row['image_name'] != '') {
			                  	?>
				                  	<img src="assets/img/uploads/products/<?php echo $row['image_name']; ?>" width="100%">
				                <?php } ?>
			                  </td>
			                  <td><?php echo (array_key_exists($row['cat_id'], $arrCat))?$arrCat[$row['cat_id']]:''; ?></td>
                        <td><?php echo $row['description']; ?></td>
			                  <td><span><a href="edit_product.php?id=<?= $row['id']; ?>">Edit</a></span>/<span><a href="delete_product.php?id=<?= $row['id']; ?>">Delete</a></span></td>
			                </tr>
                <?php
                      $i++;
                		}
                	} else {
                		echo '<tr><td colspan="4">Khong co sản phẩm nao</td></tr>';
                	}
                ?>
              </table>
            </div>
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php require_once 'common/footer.php'; ?>
