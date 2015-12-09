<?php
require 'vendor/autoload.php';
require_once "connection.php";
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');

$email=$user->get('email');
$fname=$user->get('fname');
$lname=$user->get('lname');
$type=$user->get('type');

$sql=$db->prepare("SELECT * FROM Registration.Course c
join Registration.Department d
on c.deptID=d.deptID;");
$sql->execute();
$catalog = $sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('coursecatalog.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											'catalog'=>$catalog));

?>