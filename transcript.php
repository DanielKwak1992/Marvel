<?php
require 'vendor/autoload.php';
require_once "connection.php";
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get('type');

if(isset($_POST['btn-login'])){
	$sql=$db->prepare("SELECT * FROM Registration.test;");
	$sql->execute();

	$result=$sql->fetchAll(PDO::FETCH_ASSOC);
}

echo $twig->render('transcript.html', array('id'=>$id, 'type' => $type, 'data'=> $result ));

?>