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
              <h3 class="box-title">List News</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Title</th>
                  <th>Content</th>
                  <th style="width: 50px">Image</th>
                  <th>Category</th>
                  <th>Action</th>
                </tr>
                <?php
                	if($listnews->num_rows > 0) {
                    $i = 1;
                		while($row = $listnews->fetch_assoc()) {
                ?>
			                <tr>
			                  <td><?php echo $i ?></td>
			                  <td><a href="admin.php?controller=news&action=view_detail&id=<?= $row['id']; ?>"><?php echo $row['title']; ?></a></td>
                        <td><?php echo $row['content']; ?></td>
			                  <td>
			                  	<?php
			                  		if($row['image'] != '') {
			                  	?>
				                  	<img src="uploads/posts/<?php echo $row['image']; ?>" width="100%">
				                <?php } ?>
			                  </td>
			                  <td><?php echo ($row['cat_name'])?$row['cat_name']:'No Category'; ?></td>
                        <td><span><a href="admin.php?controller=news&action=edit_news&id=<?= $row['id']; ?>">Edit</a></span>/<span><a href="admin.php?controller=news&action=del_news&id=<?= $row['id']; ?>">Delete</a></span></td>
			                </tr>
                <?php
                      $i++;
                		}
                	} else {
                		echo '<tr><td colspan="4">Khong co bai viet nao</td></tr>';
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
