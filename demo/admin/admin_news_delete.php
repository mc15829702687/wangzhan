<?php 
	
	include_once '.\db.class.inc.php';
	$d = new db('localhost','root','123456','newscms');

	$d->delete($_GET['id'],'news','edit_news.php');
	
?>