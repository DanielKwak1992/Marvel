<?php
//include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get('type');
$result=$user->get('result');
$course=$user->('course');
$CourseID=$user->get('CourseID');
$Grade=$user->get('Grade');
$Student_userID=$user->get('Student_userID');
$sectionID=$user->get('sectionID');




if(isset($_POST["button"]))
 {
 	//Update grades based on the students id#, whom are taking the same course
    $sql=$db->prepare("UPDATE Grade FROM REGISTRATION.User WHERE Student_userID="+$Student_userID+"");
    $sql->execute();
    
 }
 	//Select all the students who are in the same course
	$coursesql=$db->prepare("SELECT Student_userID FROM Registration.Student_Grade_History WHERE CourseID="+$CourseID+"");
	$sql->execute();
	$result=$sql->fetchAll(PDO::FETCH_ASSOC);


echo $twig->render('fgrade.html', array('id'=>$id, 'type' => $type, 'courseID' => $courseID, 'Grade' => $Grade, 'Student_userID' => $Student_userID, 'sectionID' => $sectionID 'result'=> $result ));






?>