<?php
	include_once '.\db.class.inc.php';
	$d = new db('localhost','root','123456','newscms');

	$lm = $_GET['updatename'];
	$id = $_GET['id'];
	$l = $_GET['grade'];
	
	if($l=='lm1')
	{
		$sql1 = "delete from cms where id=$id";
		mysql_query($sql1);

		$sql = "select * from cms where lmid=$id";
		$query = mysql_query($sql) or die(mysql_error());

		while($res = mysql_fetch_assoc($query))
		{
			$sql3 = "delete from cms where id='$_GET[id]' or lmid='$_GET[id]' or lmid='$res[id]'";
			$query1 = mysql_query($sql3);
		}		
	}else if($l=='lm2')
	{
		$sql = "delete from cms where id=$id or lmid=$id";
		mysql_query($sql);
	}else{
		$sql = "delete from cms where id=$id";
		$query = mysql_query($sql) or die(mysql_error());
	}
	header('Location:edit_lm.php');

?>
