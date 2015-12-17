<?php
require_once "rauthorize.php";
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

$sql=$db->prepare("SELECT * FROM Registration.User where userType='faculty';");
$sql->execute();
$faculty = $sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('viewfaculty.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type, 'faculty'=>$faculty));
?>