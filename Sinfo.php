<?php
require_once "connection.php";
require 'vendor/autoload.php';
require_once "aauthorize.php";

$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
session_start();
$id=$_SESSION['id'];
$type=$_SESSION['type'];
$userid = $_POST['userid'];


$sql=$db->prepare("SELECT * FROM Registration.user;");
$sql->execute();
$view=$sql->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['btn-submit'])){
    

  if ($userid!=null)  {
        
        $student = $db->prepare ("SELECT * from Registration.User WHERE userid = ".$userid."");
        $student->execute();
        $result = $student -> fetchAll(PDO :: FETCH_ASSOC);
        
        
        }
        else { echo $userid , "is not correct";
				}
	}
echo $twig->render('View.html', array("id" =>$id,"userid"=>$userid, "result"=>$result, "type" => $type));
?>