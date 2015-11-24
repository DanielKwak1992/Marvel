<?php
require 'vendor/autoload.php';
//require_once "connection.php";
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get('type');
/*
 try {
    // Show existing guestbook entries.
    foreach($db->query("SELECT * FROM Registration.User;") as $row) {
           
     }
  } catch (PDOException $ex) {
    echo "An error occurred in reading or writing to guestbook.";
  }
*/

//$sql=$db->prepare("SELECT * FROM Registration.test;");
//$sql->execute();

//$result=$sql->fetchAll(PDO::FETCH_ASSOC);


//echo $twig->render('transcript.html', array('id'=>$id, 'type' => $type, 'data'=> $result ));

?>