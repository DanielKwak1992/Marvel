<?php
include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
//memcache only stores this data any other data you need will need to be queried
//previously you had other variables that wherent in memcache
$id=$user->get('id');
$email=$user->get('email');
$fname=$user->get('fname');
$lname=$user->get('lname');
$type=$user->get('type');

 // i changed the + to . i dont know why but its the only way that works.

if(isset($_POST["button"]))
 {
 	//Update grades based on the students id#, whom are taking the same course
    $sql=$db->prepare("UPDATE Grade FROM REGISTRATION.User WHERE Student_userID=".$Student_userID."");
    $sql->execute();
    
 }
 	//Select all the students who are in the same course
 /*sql statement doesnt make sense. you need to find the courses that this prof teaches during semester/year(i think i need to talk to you in person about the semester year part):
"SELECT * FROM Registration.Section s
join Registration.Enrollment e
on s.CourseID=e.CourseID and s.sectionID=e.sectionID 
where Facutly_userID = '".$id."';"

this statement joins Enrollment(e) and section (s) to get you all the courses this teacher teaches and students registered to the class
	
*/
	$sql=$db->prepare("SELECT Student_userID FROM Registration.Student_Grade_History WHERE CourseID=".$CourseID."");
	$sql->execute();
	$result=$sql->fetchAll(PDO::FETCH_ASSOC);
 

//missing comma
echo $twig->render('fgrade.html', array('id'=>$id, 'type' => $type, 'courseID' => $courseID, 'Grade' => $Grade, 'Student_userID' => $Student_userID, 'sectionID' => $sectionID, 'result'=> $result ));






?>