<?php
include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get("type");
//$courseID=$user->('courseID');
//$courseName=$user->get('courseName');
//$credits=$user->get('credits');
//$deptID=$user->get('deptID');


$sql=$db->prepare("SELECT * FROM Registration.Course;");
$sql->execute();
$result=$sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('coursecatalog.html', array("courseID" =>$courseID, "courseName" => $courseName, "credits" =>$courseName, "deptID" =>$deptID, "result" =>$result));
var_dump($sql);
//if($result->num_rows > 0 {
//	while($row = $result->fetch_assoc()){
//		echo "<br> major"
//	}
//})

?>