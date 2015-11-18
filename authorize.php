<?php
$user = new Memcached();


if (null !=$user->get('id')) {
echo "test";
}else{
    header("Location: login.html");
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