<?php 

	include_once 'db.class.inc.php';
	$d =new db('localhost','root','123456','newscms');


	// 获取当前时间
	date_default_timezone_set("Asia/Shanghai");
	$time = strtotime(date("Y-m-d H:i:s"));
	$timeoffset = $time-strtotime($_POST['time']);


	// if($_SESSION['id']==$_POST['id'])
	// {
	if($timeoffset<13600)
	{

	
		$sql = 'delete from user_message where id='.$_POST['id'];
		$query = mysql_query($sql);
		if(mysql_affected_rows()>0)
		{
		$sql = 'select * from user_message order by id desc limit 2';
		$query = mysql_query($sql);
		
		while($res = mysql_fetch_assoc($query)){
				$array[]=$res;
			}
		}
		echo json_encode($array);
	}else{
		echo "1111";
	}

?>