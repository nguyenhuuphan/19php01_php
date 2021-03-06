<?php 
	include 'config/connect.php';
	class Model extends ConnectDB {

	 	public function checkExist($field, $value, $table) {
			if(is_string($value)) {
				$sql = "SELECT * FROM $table WHERE $field = '$value' LIMIT 1";
			} else {
				$sql = "SELECT * FROM $table WHERE $field = $value LIMIT 1";
			}
			$check = mysqli_query($this->connect(), $sql);
			if($check->num_rows > 0) {
				return true;
			}
			return false;
		}
		public function delRow($id, $table) {
			$sql = "DELETE FROM $table WHERE id = $id";
			return mysqli_query($this->connect(), $sql);
		}
		public function getOneRow($id, $table) {
			$sql = "SELECT * FROM $table WHERE id = $id";
			$getOneUser = mysqli_query($this->connect(), $sql);
			return $getOneUser;
		}
		public function getOneSlug($slug, $table) {
			$sql = "SELECT * FROM $table WHERE slug LIKE '$slug'";
			$getOneUser = mysqli_query($this->connect(), $sql);
			return $getOneUser;
		}
		public function query($sql) {
			$var = mysqli_query($this->connect(), $sql);
			return $var;
		}

		public function getUsers() {
			$sql = "SELECT * FROM users";
			$listUsers = mysqli_query($this->connect(), $sql);
			return $listUsers;
		}
		public function editUser($id, $name, $email, $phone, $gender, $city, $date, $avatar_name) {
			$sql = "UPDATE users SET name = '$name', email = '$email', phone = '$phone', gender = '$gender', city = '$city', birthday = '$date', avatar = '$avatar_name' WHERE id = $id";
			return mysqli_query($this->connect(), $sql);
		}
		public function addUser($name, $email, $phone, $gender, $city, $date, $avatar_name) {
			$sql = "INSERT INTO users(name, email, phone, gender, city, birthday, avatar) VALUES ('$name', '$email', $phone, '$gender', '$city', '$birthday', '$avatar_name')";
			return mysqli_query($this->connect(), $sql);
		}

		public function getProducts() {
        	$sql = "SELECT P.id, P.name, P.price, P.quantity, P.image_name, P.description, C.name as cat_name, slug FROM products as P LEFT JOIN product_categories as C ON P.cat_id = C.id";
        	$listproducts = mysqli_query($this->connect(), $sql);
        	return $listproducts;
		}
		public function addProduct($name, $price, $qtt, $cat, $image_name, $des, $slug) {
			$sql = "INSERT INTO products (name, price, quantity, cat_id, image_name, description, slug) VALUES ('$name', '$price', $qtt, $cat, '$image_name', '$des', '$slug')";
			return mysqli_query($this->connect(), $sql);
		}
		public function editProduct($id, $name, $price, $qtt, $cat, $image_name, $des, $slug) {
			$sql = "UPDATE products SET name = '$name', price = $price, quantity = $qtt, cat_id = $cat, image_name = '$image_name', description = '$des', slug = '$slug' WHERE id = $id";
			return mysqli_query($this->connect(), $sql);
		}

		public function getCategories($table) {
			$sql = "SELECT * FROM $table";
        	$listcat = mysqli_query($this->connect(), $sql);
        	return $listcat;
		}
		public function editCat($id, $name, $table) {
			$sql = "UPDATE $table SET name = '$name' WHERE id = $id";
			return mysqli_query($this->connect(), $sql);
		}
		public function addCat($name, $table) {
			$sql = "INSERT INTO $table (name) VALUES ('$name')";
			return mysqli_query($this->connect(), $sql);
		}

		public function getNews() {
        	$sql = "SELECT P.id, P.title, P.image, P.content, C.name as cat_name, slug FROM news as P LEFT JOIN news_categories as C ON P.cat_id = C.id";
        	$listNews = mysqli_query($this->connect(), $sql);
			return $listNews;
		}
		public function addNews($name, $cat, $image_name, $des, $slug) {
			$sql = "INSERT INTO news (title, cat_id, image, content, slug) VALUES ('$name', $cat, '$image_name', '$des', '$slug')";
			return mysqli_query($this->connect(), $sql);
		}
		public function editNews($id, $name, $cat, $image_name, $des, $slug) {
			$sql = "UPDATE news SET title = '$name', cat_id = $cat, image = '$image_name', content = '$des', slug = '$slug' WHERE id = $id";
			return mysqli_query($this->connect(), $sql);
		}


		public function loginAdmin($email) {
			$sql = "SELECT id FROM users WHERE email = '$email'";
			$check = mysqli_query($this->connect(), $sql);
			return $check;
		}
	}
?>