<?php
require 'vendor/autoload.php';
require_once "connection.php";

$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get("type");
$changed= null;
$email= $_POST['email'];


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
echo $twig->render('resetpassword.html', array("id" =>$id,"changed"=> $changed,"email"=> $email, "type" => $type));
var_dump($email);
?>
