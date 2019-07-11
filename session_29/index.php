<?php
	$request = $_SERVER['REQUEST_URI'];

// Include router class
include('libs/routes/routes.php');

if( strpos( $request, 'admin' ) !== false ){
	include 'controller/controller.php';
} else {
    include 'controller/homeController.php';
}

// Add base route (startpage)
Route::add('/',function(){
	$controller = new homeController();
	$controller->pageRequest('home');
});
Route::add('/contact',function(){
	$controller = new homeController();
	$controller->pageRequest('contact');
});

Route::add('/admin',function(){
	$controller = new Controller();
	$controller->adminHandleRequest();
});

// Simple test route that simulates static html file
Route::add('/news',function(){
	$controller = new homeController();
	$controller->pageRequest('news');
});


// Accept only numbers as parameter. Other characters will result in a 404 error
Route::add('/news/([a-zA-Z0-9-]*)',function($para){
	$controller = new homeController();
	$controller->newsRequest($para);
});

Route::run('/');
?>