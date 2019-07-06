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
                  <th>Email</th>
                  <th>Phone</th>
                  <th style="width: 50px">Avatar</th>
                  <th>City</th>
                  <th>Gender</th>
                  <th>Birthday</th>
                  <td>Action</td>
                </tr>
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
                	if($listusers->num_rows > 0) {
                		$i = 1;
                		while($row = $listusers->fetch_assoc()) {
                ?>
			                <tr>
			                  <td><?php echo $i; ?></td>
			                  <td><?php echo $row['name']; ?></td>
			                  <td><?php echo $row['email']; ?></td>
			                  <td><?php echo $row['phone']; ?></td>
			                  <td>
			                  	<?php
			                  		if($row['avatar'] != '') {
			                  	?>
				                  	<img src="uploads/<?php echo $row['avatar']; ?>" width="100%">
				                <?php } ?>
			                  </td>
			                  <td><?php echo $arrCity[$row['city']]; ?></td>
			                  <td><?php echo $arrGender[$row['gender']]; ?></td>
			                  <td><?php echo $row['birthday']; ?></td>
			                  <td><span><a href="admin.php?controller=users&action=edit_user&id=<?= $row['id']; ?>">Edit</a></span>/<span><a href="admin.php?controller=users&action=del_user&id=<?= $row['id']; ?>">Delete</a></span></td>
			                </tr>
                <?php
                		$i++;
                		}
                	} else {
                		echo '<tr><td colspan="4">Khong co user nao</td></tr>';
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
