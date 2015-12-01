<?php
include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get('type');
$CourseID=$user->get('CourseID');
$Grade=$user->get('Grade');
$Student_userID=$user->get('Student_userID');



if(isset($_POST["button"]))
 {
    $sql=$db->prepare("UPDATE Grade FROM REGISTRATION.User WHERE Student_userID="+$Student_userID+"");
    $sql->execute();
    
 }

	$sql=$db->prepare("SELECT Student_userID FROM Registration.Student_Grade_History WHERE CourseID="+$CourseID+"");
	$sql->execute();
	$result=$sql->fetchAll(PDO::FETCH_ASSOC);


echo $twig->render('fgrade.html', array('id'=>$id, 'type' => $type, 'result'=> $result ));






?>