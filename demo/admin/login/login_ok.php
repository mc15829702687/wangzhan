<?php 
	
	session_start();
	include_once 'db.class.inc.php';
	$d = new db('localhost','root','123456','newscms');
	//获取值
	$admin = addslashes($_POST['username']);
	$pwd = addslashes($_POST['password']);

	//防注入
	if(empty($admin)||empty($pwd))
	{
		echo "	<script>
					alert('不能跳级');
					window.history.go(-1);
				</script>";
		exit;
	}

	// 判断验证码是否输入正确
	if($_POST['code'] != $_SESSION['code'])
	{
		echo "	<script>
					alert('验证码输入错误');
					window.history.go(-1);
				</script>";
		exit;
	}
	$sql = "select * from admin where admin='$admin' and password='$pwd'";

	$query = mysql_query($sql);
	$arr = mysql_fetch_assoc($query);

	if(!empty($arr)){
		$_SESSION['admin'] = 'pass';
		echo "	<script>
					alert('用户登录密码正确');
					window.location.href='../admin.php';
				</script>";
		exit;
	}else{
		echo "	<script>
					alert('用户或密码错误请重新登录');
					window.history.go(-1);
				</script>";
	}


?>