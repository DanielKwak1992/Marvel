<?php
require_once "sauthorize.php";
require 'vendor/autoload.php';
require_once "connection.php";
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
session_start();
$id=$_SESSION['id'];
$type=$_SESSION['type'];
$email=$_SESSION['email'];
$fname=$_SESSION['fname'];
$lname=$_SESSION['lname'];


$sql=$db->prepare("SELECT * FROM Registration.Student_Grade_History sgh
					inner join Registration.Section s
					on s.CourseID=sgh.CourseID and s.sectionID=sgh.sectionID
					inner join Registration.Course c
					on c.CourseID=s.CourseID
					where Student_userID='".$id."';");
$sql->execute();
$transcript=$sql->fetchAll(PDO::FETCH_ASSOC);


echo $twig->render('Transcript.html', array('id'=>$id, 'type' => $type,'fname'=>$fname,'lname'=>$lname, 'transcript'=> $transcript ));
?>