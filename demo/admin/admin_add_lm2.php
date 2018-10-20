<?php 
	
	include_once '.\db.class.inc.php';
	$d = new db('localhost','root','123456','newscms');
	// unset($_GET['submit']);
	// $d->insert('newscms',$_GET,'admin_news_lm.php');
	$lm = $_GET['lm2'];
	$id = $_GET['id'];

	// Array ( [id] => 1 [grade] => lm1 [lm2] => 阿大 ) 
	if($_GET['grade']=='lm2')
	{
		$sql = "insert into cms(lm2,lmid) values('$lm','$id')" ;
		
	}else{
		$sql = "insert into cms(lm3,lmid) values('$lm','$id')" ;
	}
	$query = mysql_query($sql) or die(mysql_error());
	header('Location:edit_lm.php');

?>