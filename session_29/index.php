<?php
					session_start();
	$request = $_SERVER['REQUEST_URI'];


include('controller/routes.php');

if( strpos( $request, 'admin' ) !== false ){
	include 'controller/adminController.php';
} else {
    include 'controller/pageController.php';
}

// Base Route
Route::add('/',function(){
	$controller = new pageController();
	$controller->pageRequest('home');
});


// Admin Route
Route::add('/admin',function(){
	$controller = new adminController();
	$controller->adminRequest();
});

// Page
Route::add('/news',function(){
	$controller = new pageController();
	$controller->pageRequest('news');
});
Route::add('/contact',function(){
	$controller = new pageController();
	$controller->pageRequest('contact');
});
Route::add('/products',function(){
	$controller = new pageController();
	$controller->pageRequest('products');
});


// Single
Route::add('/([a-zA-Z0-9-]*)/([a-zA-Z0-9-]*)',function($type, $slug){
	$controller = new pageController();
	$controller->pageRequest($type, $slug);
});

Route::run('/');
?>