<?php
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);


$user = new Memcached();
require_once "connection.php";
$err=false;
$id=$user->get('id');


if(isset($_POST['btn-Submit'])){
    $email = $_POST['email'];

  if ($email!=null)  {
        if ($email == $row['email']) {
        $db->$query = "UPDATE Registration.User SET password= birthdate WHERE email = ".$email."";
        echo "Password successfully reset";
        }
            else{
            echo "Invalid email address";
            }
    }
}
?>
