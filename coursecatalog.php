<?php
//include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
//$id=$user->get('id');
//$type=$user->get("type");
$courseID=$user->('courseID');
$courseName=$user->get('courseName');
$credits=$user->get('credits');
$deptID=$user->get('deptID');



echo $twig->render('coursecatalog.html', array("courseID" =>$courseID, "courseName" => $courseName, "credits" =>$courseName, "deptID" =>$deptID));

$sql=$db->prepare("SELECT * FROM Registration.Course;");
$sql->execute();

$result=$sql->fetchAll(PDO::FETCH_ASSOC);

if($result->num_rows > 0 {
	while($row = 4result->fetch_assoc()){
		echo "<br> major"
	}
})

?>