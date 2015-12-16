<?php
session_start();
$type=$_SESSION['type'];


if (null != $type) {

}else{
    header("Location: /login");
}

//if $type = pageuser

switch ($type) {
  case 'student':
    header("Location: /student");
    break;
  case 'admin':
    //header("Location: /admin");
    break;
  case 'faculty':
    header("Location: /faculty");
    break;
  case 'researcher':
    header("Location: /researcher");
    break;
  default:
    header("Location: /login");
    break;
}
?>