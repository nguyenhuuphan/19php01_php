<ul>
	<?php
		if($listnews->num_rows > 0) {
            while($row = $listnews->fetch_assoc()) {
            	echo "<li><a href='/news/" . $row['slug'] . "'>" . $row['title'] . "</a></li>";
            }
		} else {
			echo "<div class='error-noti'><span>Không có bài viết để hiển thị.</span></div>";
		}
	?>
</ul>