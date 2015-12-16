<?php
require_once "sauthorize.php";
require 'vendor/autoload.php';
require_once "connection.php";
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
session_start();
$id=$_SESSION['id'];
$email=$_SESSION['email'];
$fname=$_SESSION['fname'];
$lname=$_SESSION['lname'];
$type=$_SESSION['type'];

$sql=$db->prepare("SELECT * FROM Registration.Student_has_Faculty shf
join Registration.User u
on u.userID=shf.Adviser_Faculty_userID 
join Registration.Faculty f
on f.Faculty_userID=shf.Adviser_Faculty_userID
where shf.Student_userID = '".$id."' and u.userType='faculty';");
$sql->execute();
$advisor = $sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('sAdvisor.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											'advisor'=>$advisor));

?>