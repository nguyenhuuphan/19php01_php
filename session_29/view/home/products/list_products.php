<ul>
	<?php
		if($listproducts->num_rows > 0) {
            while($row = $listproducts->fetch_assoc()) {
            	echo "<li><a href='/products/" . $row['slug'] . "'>" . $row['name'] . "</a></li>";
            }
		} else {
			echo "<div class='error-noti'><span>Không có sản phẩm để hiển thị.</span></div>";
		}
	?>
</ul>