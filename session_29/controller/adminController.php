<?php
	/**
	 * 
	 */
	include 'libs/function.php';
	include 'model/model.php';
	class adminController
	{
		
		public function adminRequest() {
			// echo $_SESSION['login'];
			$functionCommon = new FunctionCommon();
			$model = new Model();
			// $this->checkLogin();
			$errEmail = $email = $check = '';
				if(isset($_GET['login_admin'])){
					$email = $_GET['email'];
					$check = true;
					if($email == '') {
						$errEmail = 'Nhập email';
						$check = false;
					}
					if($model->checkExist('email', $email, 'users')) {
						$check = true;
					} else {
						$check = false;
						$errEmail = 'Sai Email';
					}
				}
				if($check == true) {
					$userId = $model->query("SELECT id FROM users WHERE email like '$email'");
					$userId = $userId->fetch_assoc();
					$userId = $userId['id'];
					$_SESSION['login'] = $userId;
					// header("Location: admin");
				}
				if($this->checkLogin() === TRUE) {
					include 'view/admin/admin.php';
				} else {

include 'view/admin/login.php';
				}

		}

		public function checkLogin() {
			if(isset($_SESSION['login'])) {
				return true;
			} else {
				return false;
			}
		}
	}
?>