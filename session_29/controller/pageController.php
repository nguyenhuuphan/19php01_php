<?php 
	include 'model/model.php';
	include 'libs/function.php';
	class pageController {

		public function pageRequest($type, $slug = '') {
			$model = new Model();
			$functionCommon = new FunctionCommon();
			switch ($type) {
				case 'home':
					include 'view/home/page/home.php';
					break;
				case 'contact':
					include 'view/home/page/contact.php';
					break;
				case 'news':
					if($slug == '') {
						$listnews = $model->getNews();
						include 'view/home/news/list_news.php';
					} else {
						$getOneNews = $model->getOneSlug($slug, 'news');
						include 'view/home/news/detail.php';
					}
					break;
				case 'products':
					$action = isset($_GET['action'])?$_GET['action']:'';
					if($slug == '') {
						$listproducts = $model->getProducts();
						include 'view/home/products/list_products.php';
					} elseif($action == 'add_to_cart') {
							$cart = (isset($_SESSION['cart']))?$_SESSION['cart']:array();
							$product_slug = $slug;
							$getOne = $model->getOneSlug($slug, 'products');
							$getOne = $getOne->fetch_assoc();
							$this->checkCartExist($getOne['id']);
							if($this->checkCartExist($getOne['id']) !== true) {
							array_push($cart, array('product_id' => $getOne['id'], 'quantity' => 1));
							$_SESSION['cart'] = $cart; 
							}
							print_r($_SESSION['cart']);
							echo 'Đã thêm sản phẩm ' . $product_slug . ' vào giỏ'; exit;
					} else {
						$getOne = $model->getOneSlug($slug, 'products');
						include 'view/home/products/detail.php';
					}
					break;
				
				default:
					# code...
					break;
			}
		}

		public function checkCartExist($product_id) {
			$cart = $_SESSION['cart'];
			foreach ($cart as $key => $value) {
				if(in_array($product_id, $value)){
					$value['quantity']++;
					return true;
					break;
				}

			}
		}
	}
?>