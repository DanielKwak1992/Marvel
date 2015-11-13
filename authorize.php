<?php
$user = new Memcached();


if (null !=$user->get('id')) {
echo "test";
}else{
    header("Location: index.html");
}

?>