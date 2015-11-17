<?php
$user = new Memcached();


if (null !=$user->get('id')) {
echo "test";
}else{
    header("Location: Login.php");
}

if ("student"==$user->get('type')) {
	# code...
}elseif ("faculty"==$user->get('type')) {
	# code...
}elseif ("admin"==$user->get('type')) {
	# code...
}elseif ("researcher"==$user->get('type')) {
	# code...
}


?>