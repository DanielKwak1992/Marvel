<?php
$user = new Memcached();


if (null !=$user->get('id')) {
echo "test";
}else{
    header("Location: index.html#works");
}

function logout(){
	$user->flush(10);
	header("Location: index.html#works");
}

?>