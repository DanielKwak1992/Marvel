<?php
//include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get("type");
$changed= null;




if(isset($_POST['btn-submit'])){
    $email = $_POST['email'];

  if ($email!=null)  {
        
        $Pass = $db->prepare ("UPDATE Registration.User SET password = birthdate WHERE email = ".$email."");
        if ($pass->execute()) {
        $changed= true;
        }
            else{
            $changed= false;
            }
    }
}
echo $twig->render('resetpassword.html', array("id" =>$id,"changed"=> $changed, "type" => $type));
var_dump($email);
?>
