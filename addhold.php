<?php
require_once "connection.php";
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get("type");
$userID= $_POST['userID'];
$TypeH= $_POST['TypeH'];
$err= false;

$sql=$db->prepare("SELECT * FROM Registration.holds;");
$sql->execute();
$hold=$sql->fetchAll(PDO::FETCH_ASSOC);

	if (isset($_POST['btn-submit'])){
		if ($userID != null){
			switch ($TypeH){
			case 'Academic':
			break;
		}
	}	else { 
		$err= true; 
		echo $twig->render('addhold.html',array('error' => $err ));
			}
}

echo $twig->render('addhold.html', array("id" =>$id, "userID"=> $userID, "type" => $type));


?>
