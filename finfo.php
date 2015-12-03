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
 
if(isset($_POST["submit"]))
{
    $sql=$db->prepare("UPDATE Street, City, Zip, State FROM REGISTRATION.User WHERE id=".$id."");
    $sql->execute();
    
}
// i changed the + to . i dont know why but its the only way that works.
$sql=$db->prepare("SELECT * FROM Registration.User where userID='".$id."';");
$sql->execute();
$check=$sql->fetchAll(PDO::FETCH_ASSOC);
 



echo $twig->render('finfo.html', array("id" =>$id, "type" => $type, "check" =>$check));
?>
