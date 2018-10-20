<?php 
	
	include_once '../db.class.inc.php';
	$d = new db('localhost','root','123456','newscms');

	$res = $d->getoneData($_POST['id'],'user_message',MYSQL_ASSOC);
	echo json_encode($res);

?>