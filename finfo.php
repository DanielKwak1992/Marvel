<?php
include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get('type');
$Street=$user->get('Street');
$City=$user->get('City');
$Zip=$user->get('Zip');
$State=$user->get('State');

 
if(isset($_POST["submit"]))
{
    $sql=$db->prepare("UPDATE Street, City, Zip, State FROM REGISTRATION.User WHERE id="+$id+"");
    $sql->execute();
    
}

 
$sql=$db->prepare("SELECT * FROM Registration.User WHERE id="+$id+"");
$sql->execute();
$check = $sql->fetchAll(PDO::FETCH_ASSOC);




echo $twig->render('finfo.html', array("id" =>$id, "type" => $type, "check" =>$check));

?>
