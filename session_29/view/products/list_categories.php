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
              <h3 class="box-title">Categories</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <td>Action</td>
                </tr>
                <?php
                  if($listcat->num_rows > 0) {
                    $i = 1;
                    while($row = $listcat->fetch_assoc()) {
                ?>
                      <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><span><a href="index.php?controller=products&action=edit_category&id=<?= $row['id']; ?>">Edit</a></span>/<span><a href="index.php?controller=products&action=del_category&id=<?= $row['id']; ?>">Delete</a></span></td>
                      </tr>
                <?php
                      $i++;
                    }
                  } else {
                    echo '<tr><td colspan="4">Khong co danh mục nao</td></tr>';
                  }
                ?>
              </table>
            </div>
          </div>
            <p><a href="index.php?controller=products&action=add_category" class="btn btn-app"><i class="fa fa-plus"></i>Add New Category</a></p>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php require_once 'common/footer.php'; ?>
