<?php
include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
if(isset($_POST['button'])){}
$user = new Memcached();
$id=$user->get('id');
$type=$user->get('type');

$sql=$db->prepare("SELECT * FROM Registration.Semester;");
$sql->execute();

$result=$sql->fetchAll(PDO::FETCH_ASSOC);


//echo $twig->render('fgrade.html', array('id'=>$id, 'type' => $type, 'data'=> $result ));






?>