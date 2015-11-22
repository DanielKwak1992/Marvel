<?php
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get('type');

echo $twig->render('test.html',array('id'=>$id, 'type' => "admin" ));




?>