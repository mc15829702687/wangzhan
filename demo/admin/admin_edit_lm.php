<?php
	include_once '.\db.class.inc.php';
	$d = new db('localhost','root','123456','newscms');

	$lm = $_GET['updatename'];
	$id = $_GET['id'];
	$l = $_GET['grade'];

	$sql = "update cms set $l='$lm' where id=$id" ;

	$query = mysql_query($sql) or die(mysql_error());
	header('Location:edit_lm.php');

?>
