<?php 
	include 'model/model.php';
	include 'libs/function.php';
	class Controller {
		public function handleRequest() {
			$model = new Model();
			$functionCommon = new FunctionCommon();
			$controller = isset($_GET['controller'])?$_GET['controller']:'home';
			$action = isset($_GET['action'])?$_GET['action']:'home';
			switch ($controller) {
				case 'home':
					// goi view home
					include 'view/home/home.php';
					break;
				case 'users':
					$pathUpload = 'uploads/';
					switch ($action) {
						case 'list_users':
							$listusers = $model->getUsers();
							include 'view/users/list_users.php';
							break;
						case 'add_user':
							$errName = $errCity = $errEmail = $errDate = $errGender = $errPhone = $name = $email = $city = $date = $gender = $avatar_name = $phone = '';
							if(isset($_POST['register'])) {
								$name = $_POST['name'];
								$email = $_POST['email'];
								$city = $_POST['city'];
								$date = $_POST['date'];
								$gender = (isset($_POST['gender']))?$_POST['gender']:'';
								$phone = $_POST['phone'];
								$check = true;
								if($name == '') {
									$errName = 'Please Enter Your Name!';
									$check = false;
								}
								if($email == '') {
									$errEmail = 'Please Enter Your Email!';
									$check = false;
								}
								if($city == '') {
									$errCity = 'Please Choose A City!';
									$check = false;
								}
								if($date == '') {
									$errDate = 'Please Pick a Date!';
									$check = false;
								}
								if($gender == '') {
									$errGender = 'Please Choose Gender!';
									$check = false;
								}
								if($phone == '') {
									$errPhone = 'Please Enter Your Phone Number!';
									$check = false;
								} else {
									if(!is_numeric($phone)) {
										$errPhone = 'Phone Number Must Be Numberic!';
										$check = false;
									}
								}

								if($model->checkExist("email", $email, "users")) {
									$check = false;
									$errEmail = 'Email Exist!';
								}

								if($check) {

									// Upload Avatar

									if($_FILES['avatar']['error'] == 0) {
										$avatar_name = uniqid() . '_' . $_FILES['avatar']['name'];
										$pathUpload = 'uploads/';
										move_uploaded_file($_FILES['avatar']['tmp_name'], $pathUpload . $avatar_name);
									}
									if($model->addUser($name, $email, $phone, $gender, $city, $date, $avatar_name) === TRUE) {
										$functionCommon->redirectPage('index.php?controller=users&action=list_users');
									}

								}
							}
							include 'view/users/add_user.php';
							break;
						case 'edit_user':
							$id = $_GET['id'];
							$getOneUser = $model->getOneRow($id, 'users');
							$errName = $errCity = $errEmail = $errDate = $errGender = $errPhone = $name = $email = $city = $date = $gender = $avatar_name = $phone = '';
							if($getOneUser->num_rows > 0) {
								while ($getOneRow = $getOneUser->fetch_assoc()) {
									$name = $getOneRow['name'];
									$email = $getOneRow['email'];
									$city = $getOneRow['city'];
									$date = $getOneRow['birthday'];
									$gender = $getOneRow['gender'];
									$phone = $getOneRow['phone'];
									$avatar_name = $getOneRow['avatar'];
								}
							}
							if(isset($_POST['edit_user'])) {
								$name = $_POST['name'];
								$email = $_POST['email'];
								$city = $_POST['city'];
								$date = $_POST['date'];
								$gender = (isset($_POST['gender']))?$_POST['gender']:'';
								$phone = $_POST['phone'];
								$check = true;
								if($name == '') {
									$errName = 'Please Enter Your Name!';
									$check = false;
								}
								if($email == '') {
									$errEmail = 'Please Enter Your Email!';
									$check = false;
								}
								if($city == '') {
									$errCity = 'Please Choose A City!';
									$check = false;
								}
								if($date == '') {
									$errDate = 'Please Pick a Date!';
									$check = false;
								}
								if($gender == '') {
									$errGender = 'Please Choose Gender!';
									$check = false;
								}
								if($phone == '') {
									$errPhone = 'Please Enter Your Phone Number!';
									$check = false;
								} else {
									if(!is_numeric($phone)) {
										$errPhone = 'Phone Number Must Be Numberic!';
										$check = false;
									}
								}

								if($check) {

									// Upload Avatar

									if($_FILES['avatar']['error'] == 0) {
										unlink($pathUpload . $avatar_name);
										$avatar_name = uniqid() . '_' . $_FILES['avatar']['name'];
										move_uploaded_file($_FILES['avatar']['tmp_name'], $pathUpload . $avatar_name);
									}
									if($model->editUser($id, $name, $email, $phone, $gender, $city, $date, $avatar_name) === TRUE) {
										$functionCommon->redirectPage('index.php?controller=users&action=list_users');
									}

								}
							}
							include 'view/users/edit_user.php';
							break;
						case 'del_user':
							$id = $_GET['id'];
							$avatar = $model->getOneRow($id, 'users');
							$avatar = $avatar->fetch_assoc();
							$avatar_name = $avatar['avatar'];
							if($model->delRow($id, 'users') === TRUE) {
								unlink($pathUpload . $avatar_name);
								$functionCommon->redirectPage('index.php?controller=users&action=list_users');
							}
							break;
						default:
							# code...
							break;
					}
					break;
				case 'products':
					$arrCat = array();
					$cats = $model->getCategories();
					if($cats->num_rows > 0) {
						while ($row = $cats->fetch_assoc()) {
							$arrCat[$row['id']] = $row['name']; 
						}
					}
					$pathUpload = 'uploads/products/';
					switch ($action) {
						case 'list_products':
							$listproducts = $model->getProducts();
							include 'view/products/list_products.php';
							break;
						case 'add_product':
							$errName = $errCat = $errPrice = $errQtt = $errDes = $des = $name = $cat = $price = $qtt = $image_name = '';
							if(isset($_POST['add_product'])) {
								$name = $_POST['name'];
								$qtt = $_POST['quantity'];
								$cat = $_POST['category'];
								$price = $_POST['price'];
								$des = $_POST['description'];
								$check = true;
								if($name == '') {
									$errName = 'Please Enter Product Name!';
									$check = false;
								}

								if($model->checkExist("name", $name, "products")) {
									$check = false;
									$errName = 'Product Name Exist!';
								}
								if($cat == '') {
									$errCat = 'Please Choose A Category!';
									$check = false;
								}
								if($price == '') {
									$errPrice = 'Please Enter Product Price!';
									$check = false;
								} else {
									if(!is_numeric($price)) {
										$errPrice = 'Product Price Must Be Numberic!';
										$check = false;
									}
								}

								if($check) {

									// Upload Avatar

									if($_FILES['image']['error'] == 0) {
										$image_name = uniqid() . '_' . $_FILES['image']['name'];
										$pathUpload = 'uploads/products/';
										move_uploaded_file($_FILES['image']['tmp_name'], $pathUpload . $image_name);
									}


									if ($model->addProduct($name, $price, $qtt, $cat, $image_name, $des) === TRUE) {
									    $functionCommon->redirectPage('index.php?controller=products&action=list_products');
									}
								}
							}
							include 'view/products/add_product.php';
							break;
						case 'edit_product':
							$id = $_GET['id'];
							$errName = $errCat = $errPrice = $errQtt = $errDes = $des = $name = $cat = $price = $qtt = $image_name = '';
							$pathUpload = 'uploads/products/';
							$getOneProduct = $model->getOneRow($id, 'products');
							if($getOneProduct->num_rows > 0) {
								while ($getOneRow = $getOneProduct->fetch_assoc()) {
									$name = $getOneRow['name'];
									$cat = $getOneRow['cat_id'];
									$price = $getOneRow['price'];
									$qtt = $getOneRow['quantity'];
									$image_name = $getOneRow['image_name'];
									$des = $getOneRow['description'];
								}
							}
							if(isset($_POST['edit_product'])) {
								$name = $_POST['name'];
								$qtt = $_POST['quantity'];
								$cat = $_POST['category'];
								$price = $_POST['price'];
								$des = $_POST['description'];
								$check = true;
								if($name == '') {
									$errName = 'Please Enter Product Name!';
									$check = false;
								}
								if($cat == '') {
									$errCat = 'Please Choose A Category!';
									$check = false;
								}
								if($price == '') {
									$errPrice = 'Please Enter Product Price!';
									$check = false;
								} else {
									if(!is_numeric($price)) {
										$errPrice = 'Product Price Must Be Numberic!';
										$check = false;
									}
								}

								if($check) {

									// Upload Avatar

									if($_FILES['image']['error'] == 0) {
										unlink($pathUpload . $image_name);
										$image_name = uniqid() . '_' . $_FILES['image']['name'];
										move_uploaded_file($_FILES['image']['tmp_name'], $pathUpload . $image_name);
									}

										if ($model->editProduct($id, $name, $price, $qtt, $cat, $image_name, $des) === TRUE) {
										    $functionCommon->redirectPage('index.php?controller=products&action=list_products');
										}
								}
							}
							include 'view/products/edit_product.php';
							break;
						case 'del_product':
							$id = $_GET['id'];
							$pathUpload = 'uploads/products/';
							$avatar = $model->getOneRow($id, 'products');
							$avatar = $avatar->fetch_assoc();
							$avatar_name = $avatar['image_name'];
							if($model->delRow($id, 'products') === TRUE) {
								unlink($pathUpload . $avatar_name);
								$functionCommon->redirectPage('index.php?controller=products&action=list_products');
							}
							break;

						case 'list_categories':
							$listcat = $model->getCategories();
							include 'view/products/list_categories.php';
							break;
						case 'edit_category':
							$id = $_GET['id'];
							$errName = $name = '';
					        $getOneCat = $model->getOneRow($id, 'product_categories');
				        	if($getOneCat->num_rows > 0) {
				        		while ($getOneRow = $getOneCat->fetch_assoc()) {
				        			$oldname = $getOneRow['name'];
				        		}
				        	}
							if(isset($_POST['edit_cat'])) {
								$name = $_POST['name'];
								$check = true;
								if($name == '') {
									$errName = 'Please Enter Category Name!';
									$check = false;
								}
					            if($oldname != $name) {
					              if($model->checkExist("name", $name, "product_categories")) {
					                $check = false;
					                $errName = 'Category Exist!';
					              }
					            }

								if($check) {
											if ($model->editCat($id, $name) === TRUE) {
											    $functionCommon->redirectPage('index.php?controller=products&action=list_categories');
											}
								}
							}
							include 'view/products/edit_category.php';
						case 'del_category':
							$id = $_GET['id'];
							if ($model->delRow($id, 'product_categories') === TRUE) {
							    $functionCommon->redirectPage('index.php?controller=products&action=list_categories');
							}
							break;
						case 'add_category':
							$errName = $name = '';
							if(isset($_POST['add_cat'])) {
								$name = $_POST['name'];
								$check = true;
								if($name == '') {
									$errName = 'Please Enter Your Name!';
									$check = false;
								}

					            if($model->checkExist("name", $name, "product_categories")) {
					              $check = false;
					              $errName = 'Category Name Exist!';
					            }

								if($check) {
									if ($model->addCat($name) === TRUE) {
									    $functionCommon->redirectPage('index.php?controller=products&action=list_categories');
									}
								}
							}
							include 'view/products/add_category.php';
							break;

						default:
							# code...
							break;
					}
					break;
				case 'contact':
					// goi view contact
					include 'view/contact/contact.php';
					break;
				default:
					# code...
					break;
			}
		}
	}
?>