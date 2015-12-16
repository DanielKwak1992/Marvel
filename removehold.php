<?php
require_once "connection.php";
require 'vendor/autoload.php';
require_once "aauthorize.php";

$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
session_start();
$id=$_SESSION['id'];
$type=$_SESSION['type'];
$Student_userID= $_POST['Student_userID'];
$TypeH=$_POST['TypeH'];
$found= false;

$sql=$db->prepare("SELECT * FROM Registration.holds;");
$sql->execute();
$hold=$sql->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['btn-submit'])){
		if ($TypeH == 'Academic')
		{
				$acad = $db->prepare("UPDATE Registration.holds SET Academic = '0' WHERE Student_userID = '".$Student_userID."';");
				$acad->execute();
				$found= true;
			}
			elseif($TypeH =='Financial')
			{
				$fin = $db->prepare("UPDATE Registration.holds SET Financial = '0' WHERE Student_userID = '".$Student_userID."';");
				$fin->execute();
				$found= true;
			}
			elseif($TypeH == 'Medical' )
			{
				$med = $db->prepare("UPDATE Registration.holds SET Medical = '0' WHERE Student_userID = '".$Student_userID."';");
				$med->execute();
				$found= true;
				}
}

echo $twig->render('removehold.html', array("id" =>$id, "Student_userID"=> $Student_userID, "type" => $type));

var_dump($TypeH=="Medical");
?>
