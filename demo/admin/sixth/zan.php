<?php
	header('Content-Type:text/html;charset=utf-8');

	// 1、链接数据库
	mysql_connect('localhost','root','123456') or die(mysql_error());
	mysql_select_db('newscms');
	mysql_query('set names utf8');
	if($_COOKIE['id'.$_POST['id']]==$_POST['id'])
	{
		echo "000";
			exit;
	}else{
		// 2、构建sql语句
		$sql = "update user_message set zan=zan+1 where id=$_POST[id]";	
		mysql_query($sql);
		$sql = "select zan from user_message where id=$_POST[id] limit 1";
		$query = mysql_query($sql);
		$res = mysql_fetch_assoc($query);
		setcookie("id".$_POST['id'],$_POST['id']);
		
		echo $res['zan'];
	}
?>