<?php
include_once "aauthorize.php";
include_once "connection.php";
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
session_start();
$id=$_SESSION['id'];
$type=$_SESSION['type'];


echo $twig->render('Admin.html', array("id" =>$id, "type" => $type));




?>