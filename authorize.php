<?php
$user = new Memcached();
$type=$user->get('type');


if (null != $type) {

}else{
    header("Location: login.html");
}

//if $type = pageuser

switch ($type) {
  case 'student':
    header('Location: /student');
    break;
switch ($type) {
  case 'faculty':
    header('Location: /faculty');
    break;

switch ($type) {
  case 'admin':
    header('Location: /admin');
    break;

switch ($type) {
  case 'researcher':
    # code...
    break;

  default:
    header('Location: /index');
    break;
}
//endif

?>