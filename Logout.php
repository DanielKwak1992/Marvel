<?php
$user = new Memcached();
	$user->flush(0);
	header("Location: index.html#works");
?>