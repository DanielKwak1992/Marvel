<?php
require_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
session_start();
$id=$_SESSION['id'];
$type=$_SESSION['type'];
$userid = $_POST['userid'];
$CourseID = $_POST['CourseID'];


		$sql=$db->prepare("SELECT * FROM Registration.Course;");
			$sql->execute();
			$edit=$sql->fetchAll(PDO::FETCH_ASSOC);


echo $twig->render('editcourse.html', array("id" =>$id, "courseID"=> $CourseID, "type" => $type));




?>