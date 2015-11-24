<?php
include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
//$id=$user->get('id');
//$type=$user->get("type");
$major=$user->get("major");
$department=$user->get("department");



echo $twig->render('coursecatalog.html', array("major" =>$major, "department" => $department));




?>