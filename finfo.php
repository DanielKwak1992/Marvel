<?php
//include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get("type");


echo $twig->render('finfo.html', array("id" =>$id, "type" => $type));
);


$id= $user->get("id");
$db = "SELECT * FROM Registration.User WHERE" +$id +"" ;
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<br> First name: " $row["fname"] ".""<br>"; 
    }
    else {
        echo "0 results";
    }
}
?>
