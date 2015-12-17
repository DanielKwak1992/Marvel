<?php
require_once "connection.php";
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
session_start();
$id=$_SESSION['id'];
$type=$_SESSION['type'];
$changed= null;
$email= $_SESSION['email'];


$sql=$db->prepare("SELECT * FROM Registration.user;");
$sql->execute();
$pw=$sql->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['btn-submit'])){

  if ($email!=null)  {
        
        $pass = $db->prepare("UPDATE Registration.User SET password = birthdate WHERE email = '".$email."';");
        $pass->execute();
        if ($pass->execute()) {
        $changed= true;
        }
            else{
            $changed= false;
            }
    }
}
echo $twig->render('ResetPassword.html', array("id" =>$id,"changed"=> $changed,"email"=> $email, "type" => $type));
?>
