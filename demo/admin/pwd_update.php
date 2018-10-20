<?php 
	// 修改密码
	include_once 'db.class.inc.php';
	session_start();
  	$d = new db('localhost','root','123456','newscms');
  	
    if(empty($_SESSION['admin']))
    {
        echo "  <script>
                    alert('不能跳级');
                    window.history.go(-1);
                </script>";
        exit;
    }

    if(empty($_POST['submit']))
    {
    	echo "  <script>
                    alert('没有修改密码，不可以提交哦！！！');
                    window.history.go(-1);
                </script>";
        exit;
    }

  //   	 Array
		// (
		//     [username] => mc
		//     [password] => ma15829702687
		//     [password_new1] => ma15829702687
		//     [password_new2] => ma15829702687
		//     [submit] => 修 改
		// )
    if($_POST['password_new1']!=$_POST['password_new2'])
    {
    	echo "  <script>
                    alert('请重新输入确认密码！！！');
                    window.history.go(-1);
                </script>";
        exit;
    }else{
	    unset($_POST['submit']);
	    $sql = "update admin set password='$_POST[password_new1]' where id=$_GET[id]";
	    // echo $sql;
	    // exit;
	    $query = mysql_query($sql) or die(mysql_error());
	    if(mysql_affected_rows()>0)
		{
			echo "  <script>
                    alert('数据更新成功！！！');
                    window.history.go(-1);
                </script>";
        exit;
		}else{
			$d->goback('没有更新成功！');
		}
	}
?>