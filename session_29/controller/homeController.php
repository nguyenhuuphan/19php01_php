<?php 
	include 'model/model.php';
	include 'libs/function.php';
	class homeController {

		public function pageRequest($para) {
			$model = new Model();
			switch ($para) {
				case 'home':
					include 'view/home/page/home.php';
					break;
				case 'contact':
					include 'view/home/page/contact.php';
					break;
				case 'news':
					$listnews = $model->getNews();
					include 'view/home/news/list_news.php';
					break;
				
				default:
					# code...
					break;
			}
		}

		public function newsRequest($para) {
			$model = new Model();
			$functionCommon = new FunctionCommon();
			$getOneNews = $model->getOneSlug($para, 'news');
			include 'view/home/news/detail.php';
		}
	}
?>