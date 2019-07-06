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
              <h3 class="box-title">Edit Post</h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form role="form" name="editProduct" action="#" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group <?php echo ($errName != '')?'has-error':''; ?>">
                  <label for="inputName">Post Title</label>
                  <input type="text" class="form-control" id="inputName" placeholder="Enter Post Title" name="name" value="<?= $name; ?>">
                  <span class="error-block help-block"><?php echo $errName ?></span>
                </div>
                <div class="form-group">
                  <label for="inputFile">Image</label>
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
                <div class="form-group <?php echo ($errDes != '')?'has-error':''; ?>">
                  <label>Content</label>
                  <textarea class="form-control" rows="3" name="description" placeholder="Enter Content"><?php echo $des; ?></textarea>
                  <span class="error-block help-block"><?php echo $errDes ?></span>
                </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="edit_post">Edit</button>
              </div>
            </form>
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php require_once 'common/footer.php'; ?>
