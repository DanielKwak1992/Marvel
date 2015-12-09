<?php
require_once "sauthorize.php";
require 'vendor/autoload.php';
require_once "connection.php";
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get('type');
$email=$user->get('email');
$fname=$user->get('fname');
$lname=$user->get('lname');


$sql=$db->prepare("SELECT * FROM Registration.Student_Grade_History sgh
					inner join Registration.Section s
					on s.CourseID=sgh.CourseID and s.sectionID=sgh.sectionID
					inner join Registration.Course c
					on c.CourseID=s.CourseID
					where Student_userID='".$id."';");
$sql->execute();
$transcript=$sql->fetchAll(PDO::FETCH_ASSOC);


echo $twig->render('transcript.html', array('id'=>$id, 'type' => $type,'fname'=>$fname,'lname'=>$lname, 'transcript'=> $transcript ));
?>