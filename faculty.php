<?php
//require_once "fauthorize.php";
//include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
session_start();
$id=$_SESSION['id'];
$email=$_SESSION['email'];
$fname=$_SESSION['fname'];
$lname=$_SESSION['lname'];
$type=$_SESSION['type'];


echo $twig->render('faculty.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type));




?>