<?php 
	include_once 'db.class.inc.php';
	$d = new db('localhost','root','123456','newscms');

	
	$str =$_POST['fenlei'];
	$res = explode('|', $str);
	unset($_POST['fenlei']);
	date_default_timezone_set('Asia/Shanghai'); 
	$_POST['time'] = date('Y-m-d H:i:s');
	// unset($_POST[]);
	$_POST['lm1'] = $res[0]; 
	$_POST['lm2'] = $res[1];
	$_POST['lm3'] = $res[2];
	$_POST['content'] = addslashes(htmlspecialchars($_POST['content']));

	$d->insert('news',$_POST,'edit_news.php');
?>