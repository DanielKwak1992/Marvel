<?php
require_once "fauthorize.php";
require 'vendor/autoload.php';
include_once "connection.php";
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
session_start();
$id=$_SESSION['id'];
$email=$_SESSION['email'];
$fname=$_SESSION['fname'];
$lname=$_SESSION['lname'];
$type=$_SESSION['type'];
$Street=$_POST['street'];
$City=$_POST['city'];
$Zip=$_POST['zip'];
$State=$_POST['state'];
 
if(isset($_POST["submit"]))
{
    $sql=$db->prepare("UPDATE Registration.User 
					   SET Street='".$Street."', City='".$City."' ,State='".$State."', Zip='".$Zip."'
 					   WHERE userID = '".$id."'");
    $sql->execute();

    echo $twig->render('facultyinfo.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											 'y' => $y, 's'=> $s, 'check'=>$check, 'err' => $err));
 


 }else
 {
 	$sql=$db->prepare("SELECT * FROM Registration.User where userID='".$id."';");
	$sql->execute();
	$check=$sql->fetchAll(PDO::FETCH_ASSOC);
 
	echo $twig->render('finfo.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											 'y' => $y, 's'=> $s, 'check'=>$check, 'err' => $err));
 
 }
?>
