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
              <h3 class="box-title">Post</h3>
            </div>
            <div class="box-body">
              <?php
                if($getOneProduct->num_rows > 0) {
                  while ($getOneRow = $getOneProduct->fetch_assoc()) {
              ?>

              <h3><?= $getOneRow['title']; ?></h3>
              <p><small><?= $getOneRow['created_date']; ?></small></p>
              <p><small><?= $getOneRow['cat_id']; ?></small></p>
              <div class="thumbnail">
                <img src="uploads/posts/<?= $getOneRow['image']; ?>" style="width: 100%">
              </div>
              <div class="post-content">
                <p><?= $getOneRow['content']; ?></p>
              </div>
              <?php
                  }
                }
              ?>
            </div>
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php require_once 'common/footer.php'; ?>
