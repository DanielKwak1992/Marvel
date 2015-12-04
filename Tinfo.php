<?php
//include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get("type");


echo $twig->render('Vfaculty.html', array("id" =>$id, "type" => $type));

if(isset($_POST['btn-submit'])){
    $userid = $_POST['userid'];

  if ($userid!=null)  {
        
        $faculty = $db->prepare ("SELECT * from Registration.User WHERE userid = ".$userid."");
        $faculty->execute();
}

?>