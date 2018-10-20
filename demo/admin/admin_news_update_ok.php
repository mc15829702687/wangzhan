<?php 
	
	include_once '.\db.class.inc.php';
	$d = new db('localhost','root','123456','newscms');

	$str = htmlspecialchars($_POST['fenlei']);
	$_POST['content'] = addslashes(htmlspecialchars($_POST['content']));
	$res = explode('|', $str);
	unset($_POST['fenlei']);
	$_POST['lm1'] = $res[0]; 
	$_POST['lm2'] = $res[1];
	$_POST['lm3'] = $res[2];

	$d->update('news',$_POST,'edit_news.php');
?>