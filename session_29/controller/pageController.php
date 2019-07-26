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
					if($slug == '') {
						$listproducts = $model->getProducts();
						include 'view/home/products/list_products.php';
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
	}
?>