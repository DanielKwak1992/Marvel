<?php
require 'vendor/autoload.php';
require_once "connection.php";
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
session_start();
$id=$_SESSION['id'];

$email=$_SESSION['email'];
$fname=$_SESSION['fname'];
$lname=$_SESSION['lname'];
$type=$_SESSION['type'];

$sql=$db->prepare("SELECT * FROM Registration.Course c
join Registration.Department d
on c.deptID=d.deptID;");
$sql->execute();
$catalog = $sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('coursecatalog.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											'catalog'=>$catalog));

?>