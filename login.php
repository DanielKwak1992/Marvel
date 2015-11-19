<?php
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);


$user = new Memcached();
require_once "connection.php";
$err=false;
$id=$user->get('id');

if ($id!=null) {
    header('Location: /test');
    header("Refresh:0");
}

if(isset($_POST['btn-login'])){
    $email=$_POST['inputEmail'];
    $password=$_POST['inputPassword'];  


 try {
    // Show existing guestbook entries.
    foreach($db->query("SELECT * FROM Registration.User where email= '".$email."'  ") as $row) {
            $e=$row['email'];
            $p=$row['password'];
           
     }
  } catch (PDOException $ex) {
    echo "An error occurred in reading or writing to Registration.";
  }
  $db = null;

  if ($password!=null) {
      if ($password==$row['password']) {
       $user->setMulti(['id' => $row['userID'], 'email' => $row['email'], 'password' => $row['password'], 'fname' => $row['fName'], 'lname'=>$row['lName'], 'type'=>$row['userType']], 3000);
       $result = $user->getMulti(array('id', 'fname', 'type'));
       header('Location: /test');
      }else{

        $err=true;
        echo $twig->render('login.html',array('error' => $err ));
      } 
  }



}else{
echo $twig->render('login.html');

}

?>