<?php
require 'vendor/autoload.php';
include_once "connection.php";
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader, array('debug' => true));
$twig->addExtension(new Twig_Extension_debug());
$user = new Memcached();
//memcache only stores this data any other data you need will need to be queried
//previously you had other variables that wherent in memcache
$id=$user->get('id');
$email=$user->get('email');
$fname=$user->get('fname');
$lname=$user->get('lname');
$type=$user->get('type');
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
 
	echo $twig->render('finfo.html', array("id" =>$id, "type" => $type, "check" =>$check));
 }
?>
