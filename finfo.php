<?php
//include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get("type");
$email=$user->get("email");
$pnumber=$user->get("pnumber")


echo $twig->render('finfo.html', array("id" =>$id, "type" => $type));



$id= $user->get("id");
$db = "UPDATE Registration.User SET email= $email, pnumber= $pnumber WHERE" +$id +"id" ;
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<br> First name: " +$row["fname"]+ ".<br>"; 
        echo "<br> Last name:" +$row["lname"] + ".<br>";
        echo "<br> Email address:" +$row["email"] + ".<br>";
        echo "<br> Phone Number:" +$row["pnumber"] + ".<br>";
    }
   }
    else {
        echo "0 results";
    }

?>
