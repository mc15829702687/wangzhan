<?php 
	
	header('Content-Type:text/html;charset=utf-8');
	mysql_connect('localhost','root','123456') or die(mysql_error());
	mysql_select_db('newscms') or die(mysql_error());
	mysql_query('set names utf8');

	$sql = "select title,content,hit,tuijian from news where lm2='$_POST[id]' order by id desc limit 3";
	// $sql = "select title,content,hit,tuijian from news where lm2='219' order by id desc limit 3";
	$query = mysql_query($sql);
	while($res=mysql_fetch_assoc($query))
	{
		$res['content'] = stripcslashes(htmlspecialchars_decode($res['content']));
		$arr[] = $res;
	}
		// echo '<pre>';
		// print_r($arr);
		// echo '</pre>';
		// exit;
	echo json_encode($arr);
?>