<?php
session_start();
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);


require_once "connection.php";
$err=false;
$id=$_SESSION['id'];
$type=$_SESSION['type'];

if ($id!=null) {
    switch ($type) {
  case 'student':
    header("Location: /student");
    break;
  case 'admin':
    header("Location: /admin");
    break;
  case 'faculty':
    header("Location: /faculty");
    break;
  case 'researcher':
    header("Location: /researcher");
    break;
  }
}

if(isset($_POST['btn-login'])){
    $email=$_POST['inputEmail'];
    $password=$_POST['inputPassword'];  


 try {
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
       $_SESSION['id']=$row['userID'];
       $_SESSION['email']=$row['email'];
       $_SESSION['password']=$row['password'];
       $_SESSION['fname']=$row['fName'];
       $_SESSION['lname']=$row['lName'];
       $_SESSION['type']=$row['userType'];
       $type=$_SESSION['type'];

          switch ($type) {
            case 'student':
              header('Location: /student');
              break;

            case 'faculty':
              header('Location: /faculty');
              break;

            case 'admin':
              header('Location: /admin');
              break;

            case 'researcher':
              header('Location: /researcher');
              break;

            default:
              header('Location: /index');
              break;
          };
      }else{
        $err=true;
        echo $twig->render('login.html',array('error' => $err ));
      } 
  }



}else{
echo $twig->render('login.html');

}

?>