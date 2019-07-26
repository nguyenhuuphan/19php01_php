<?php
require_once 'controller/routes.php';
Routes::set('contact-us', function(){
  echo 'contact';
});
Routes::set('about-us', function(){
  echo $_GET['url'];
});
Routes::set('news', function(){
  echo $_GET['url'];
});
Routes::set('news/([a-zA-Z0-9-_]*)', function(){
  echo $_GET['url'];
});
?>