<?php 
	include_once '../db.class.inc.php';
	$d = new db('localhost','root','123456','newscms');
	if($_POST['huifu']=="回复")
	{
	// 设置时间
	date_default_timezone_set("Asia/Shanghai");
	$_POST['time'] = date("Y-m-d H:i:s");
	// $_POST['user_replay_id'] = $_GET['id'];
	unset($_POST['huifu']);

	$d->insert('user_replay',$_POST,'../message.php');
	}


	// $id=$_POST['id'];

	// $sql = 'select user_replay_id from user_replay';
	// $arr = $d->getSqlData($sql,MYSQL_ASSOC);
	// $tag = 0;	//设置开关，查看是否回复已有

	// for($i=0;$i<count($arr,0);$i++)
	// {
	// 	if($id == $arr[$i]['user_replay_id'])
	// 	{
	// 		$tag = 1;
	// 	}
	// }

	// if($_POST['huifu']=='回复'){
	// 	if($tag == 0){
	// 	$sql="insert into admin_replay(replay_content,user_replay_id,time) values('$_POST[replay_content]','$id','$time')";
	 
	// 	mysql_query($sql) or die(mysql_error());
	// 	if(mysql_insert_id()>0){
	// 	 		echo "<script>
	// 			window.location.href='../message_houtai.php';
	// 			</script>";
	// 			exit;
	// 					}
	// 	}else{
	// 		echo "<script>
	// 			alert('已经回复过了');
	// 			window.location.href='../message_houtai.php';
	// 			</script>";
	// 			exit;
	// 	}

	// }

?>