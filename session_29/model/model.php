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
        	$sql = "SELECT P.id, P.name, P.price, P.quantity, P.image_name, P.description, C.name as cat_name FROM products as P LEFT JOIN product_categories as C ON P.cat_id = C.id";
        	$listproducts = mysqli_query($this->connect(), $sql);
        	return $listproducts;
		}
		public function addProduct($name, $price, $qtt, $cat, $image_name, $des) {
			$sql = "INSERT INTO products (name, price, quantity, cat_id, image_name, description) VALUES ('$name', '$price', $qtt, $cat, '$image_name', '$des')";
			return mysqli_query($this->connect(), $sql);
		}
		public function editProduct($id, $name, $price, $qtt, $cat, $image_name, $des) {
			$sql = "UPDATE products SET name = '$name', price = $price, quantity = $qtt, cat_id = $cat, image_name = '$image_name', description = '$des' WHERE id = $id";
			return mysqli_query($this->connect(), $sql);
		}

		public function getCategories() {
			$sql = "SELECT * FROM product_categories";
        	$listcat = mysqli_query($this->connect(), $sql);
        	return $listcat;
		}
		public function editCat($id, $name) {
			$sql = "UPDATE product_categories SET name = '$name' WHERE id = $id";
			return mysqli_query($this->connect(), $sql);
		}
		public function addCat($name) {
			$sql = "INSERT INTO product_categories (name) VALUES ('$name')";
			return mysqli_query($this->connect(), $sql);
		}

		public function getNews() {
			$news = 'Test news abc';
			return $news;
		}
		public function getNewsRelated() {
			$newsRelated = "Tin lien quan";
			return $newsRelated;
		}
		public function getProductPage() {
			$sql = "SELECT * FROM products";
			$productList = mysqli_query($this->connect(), $sql);
			return $productList;
		}
		public function getProductDetail($id) {
			$productDetail = 'Chi tiet san pham '.$id;
			return $productDetail;
		}
		public function deleteProduct($id) {
			$sql = "DELETE FROM products WHERE id = $id";
			return mysqli_query($this->connect(), $sql);
		}
	}
?>