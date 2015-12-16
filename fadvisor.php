<?php
require_once "fauthorize.php";
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
JOIN Registration.User u
ON u.userID=shf.Student_userID
LEFT JOIN Registration.Major_Declaration md
ON shf.Student_userID=md.Student_userID
LEFT JOIN Registration.Minor_Declaration ms
ON shf.Student_userID=ms.Student_userID
WHERE shf.Adviser_faculty_userID = '".$id."';");
$sql->execute();
$fadvisor=$sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('fadvisor.html', array('id'=>$id, 'type'=>$type, 'fname'=>$fname, 'lname'=>$lname, 'fadvisor'=>$fadvisor));
?>