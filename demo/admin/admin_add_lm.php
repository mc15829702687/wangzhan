<?php 
	include_once '.\db.class.inc.php';
	$d = new db('localhost','root','123456','newscms');
	// unset($_GET['submit']);
	// $d->insert('newscms',$_GET,'admin_news_lm.php');
	$lm1 = $_GET['lm1'];
	$sql = "insert into cms(lm1) values('$lm1')";
	$query = mysql_query($sql) or die(mysql_error());
	header('Location:edit_lm.php');

?>