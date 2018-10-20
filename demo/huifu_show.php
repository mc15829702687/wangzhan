<?php 
	include_once 'db.class.inc.php';
	$d = new db('localhost','root','123456','houtailiuyan');
	if($_POST['huifu']=="回复")
	{
	

	// 设置时间
	date_default_timezone_set("Asia/Shanghai");
	$_POST['time'] = date("Y-m-d H:i:s");

	unset($_POST['huifu']);

	$d->insert('user_replay',$_POST,'message.php');
	}

?>