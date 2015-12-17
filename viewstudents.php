<?php
require_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
session_start();
$id=$_SESSION['id'];
$email=$_SESSION['email'];
$fname=$_SESSION['fname'];
$lname=$_SESSION['lname'];
$type=$_SESSION['type'];

$sql=$db->prepare("SELECT userID,email,fName,lName,birthdate,Street,City,State,Zip,round(avg(sgh.Grade),2)as gpa FROM Registration.User u
JOIN  Registration.Student_Grade_History sgh
on sgh.Student_userID=u.userID
 where u.userType = 'student'
 group by u.userID;");
$sql->execute();
$students = $sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('viewstudents.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type, 'students'=>$students));

?>