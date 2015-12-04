<?php
//include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get("type");




if(isset($_POST['btn-submit'])){
    $userid = $_POST['userid'];

  if ($userid!=null)  {
        
        $student = $db->prepare ("SELECT * from Registration.User WHERE userid = ".$userid."");
        $student->execute();
        $result = $student -> fetchAll(PDO :: FETCH_ASSOC);
        
}
echo $twig->render('Vstudent.html', array("id" =>$id, "result"=>$result, "type" => $type));
?>