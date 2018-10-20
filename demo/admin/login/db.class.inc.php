<?php 
/*注意：1、header()和session_start()，前面不能向浏览器输出，（空格最常见）
		2、子类继承父类，如果子类中没有构造函数用的是父类的，子类中有的话就用自己的
*/
		
/**【步骤】
  *一、【链接数据库】
  *1、创建4个私有变量（主机，用户，密码，库名）并给值，一个公共变量
  *2、链接数据库（链接数据库的3条语句，用this来指向link函数）
  *3、传值，形参给值付赋有变量,判断是否为空，非空给传过来的值，空的话用上面的值
  *二、【查找】
  *1、写公共函数getAllData()给传形参值，$type默认值为MYSQL_NUM
  *2、构建SQL语句，将得到的值放进一个数组中，即得到一个二位数组
  *3、返回数组
  *三、【删除】
  *1、传表名，id以及跳转路径
  *2、判断id值是否为空
  *3、构建sql语句判断有没有删除
  *四、【sql】语句
  *1、传sql语句的值返回资源型结果集
  *五、【添加】
  *1、传过来数组变为字符串，里面用逗号隔开
  *2、截取最后一个逗号
  *3、写进sql语句中
  *4、跳转到其他页面
  *六、【更改】
  *1、传过来数组变为字符串，每个"键=值"用逗号隔开
  *2、截取最后一个逗号
  *3、写进sql语句中
  *4、判断跳转到相对应的页面
  *七、【图片上传】
  *1、判断是否通过post传送过来,临时文件有没有存在
  *2、赋值 
  *3、判断传过来的文件格式 
  *4、判断是否传输正确 
  *5、将临时文件移到目标文件夹，返回$url或者false
 **/
	header('Content-Type:text/html;charset=utf-8');
	class db{
		private $host = 'localhost';	//数据库主机
		private $user = 'root';	//数据库用户
		private $pwd  = '123456'; 	//数据库密码
		private $dbname = 'web_class_info';//数据库名
		public $conn;
		/**
		  *1、【功能】自执行，完成对数据库链接参数的初始化操作属性
		  *	   para：$host   string   主机
		  *			 $user   string   用户
		  *          $pwd    string   密码
		  *			 $dbname string   数据库名
		  *	 return：void
		  *    date：2018.7.23
		  */
		function __construct($host='',$user='',$pwd='',$dbname=''){
		if(!empty($host) && !empty($user) && !empty($pwd) && !empty($dbname))
		{
			$this->host = $host;
			$this->user = $user;
			$this->pwd = $pwd;
			$this->dbname = $dbname;
		}
		$this->link();
		}
		/**
		  *2、【功能】完成数据库的链接操作
		  *	   para：void
		  *	 return：void
		  *    date：2018.7.23
		  */
		private function link(){
			$this->conn = mysql_connect($this->host,$this->user,$this->pwd,$this->dbname) or die (mysql_errno());
			mysql_select_db($this->dbname) or die(mysql_error());
			mysql_query('set names utf8');
		}
		/**
		  *3、【功能】数据的全选,获取表中所有数据
		  *	   para：$table   string    表名 
		  *          $type    const   数组的类型【MYSQL_NUM,													MYSQL_ASSOC】 
		  *	 return：$arr      数组
		  *    date：2018.7.23
		  */
		public function getAllData($table,$type=MYSQL_NUM){
			$arr = array();//定义一个数组
			$i=0;//二维数组行下标
			$sql = "select * from $table order by id desc";
			$query = $this->query($sql);
			while($res=mysql_fetch_array($query,$type))
			{
				$arr[$i] = $res;//将一维数组放进数组中
				$i++;//行变量自增
			}
			return $arr;
		}
		/**
		  *4、【功能】根据SQL获取表中数据
		  *	   para：$table   string    表名 
		  *          $type    const   数组的类型【MYSQL_NUM,													MYSQL_ASSOC】 
		  *	 return：$arr      数组
		  *    date：2018.7.23
		  */
		public function getSqlData($sql,$type=MYSQL_NUM){
			$arr = array();//定义一个数组
			$i=0;//二维数组行下标
			$query = mysql_query($sql);
			while($res=mysql_fetch_array($query,$type))
			{
				$arr[$i] = $res;//将一维数组放进数组中
				$i++;//行变量自增
			}
			return $arr;
		}

		/**
		  *5、【功能】根据主键id获取表中一条数据
		  *	   para：$table   string    表名 
		  *          $type    const   数组的类型【MYSQL_NUM,													MYSQL_ASSOC】 
		  *			 $id      int       主键
		  *	 return：$arr      数组
		  *    date：2018.7.23
		  */
		public function getoneData($id,$table,$type=MYSQL_NUM){
			$arr = array();//定义一个数组
			$sql = "select * from $table where id=$id limit 1";
			$query = $this->query($sql);
			$arr=mysql_fetch_array($query,$type);
			return $arr;
		}
		/**
		  *6、【功能】删除信息
		  *	   para：$table   string    表名  
		  *			 $id      int       主键
		  *	 return：void
		  *    date：2018.7.23
		  */
		public function delete($id,$table,$page='show_stu.php'){
			if(empty($id))
			{
				$this->goback('请正常登录！');
			}

			$sql = "delete from $table where id=$id limit 1";
			$query = $this->query($sql);
			if(mysql_affected_rows()>0)
			{
				$this->jump('删除成功',$page);
			}else{
				$this->goback('删除失败');
			}
		}
		/**
		  *7、【功能】SQL语句传给服务器变成资源型结果集
		  *	   para：$sql 	 string    sql语句
		  *	 return：void
		  *    date：2018.7.23
		  */
		private function query($sql){
			$query = mysql_query($sql) or die(mysql_error());
			if ($query) {
				return $query;
			}else{
				return false;
			}
		}
		/**
		  *8、【功能】跳转到别的页面
		  *	   para：$info 		string      弹出警告框里面的话
		  *			 $page      string      跳转页面
		  *	 return：void
		  *    date：2018.7.23
		  */
		public function jump($info,$page){
			echo "	<script>
					alert('$info');
					window.location.href='$page';
				</script>";
				exit;
		}
		/**
		  *9、【功能】返回到上一页面
		  *	   para：$info 		string      弹出警告框里面的话
		  *	 return：void
		  *    date：2018.7.23
		  */
		public function goback($info){
			echo "	<script>
					alert('$info');
					window.history.go(-1);
				</script>";
				exit;
		}
		/**
		  *10、【功能】插入数据
		  *	   para：$table		string      表名
		  *          $data      array       数组值
		  *	 return：void
		  *    date：2018.7.23
		  */
		public function insert($table,$data,$page='login.php'){
			$k='';
			$v='';
			if(!is_array($data))
			{
				$this->goback('数组中的类型不对');
			}
			if(empty($data))
			{
				$this->goback('数组中的值为空');
			}

			foreach ($data as $key => $value) {
				$k.=$key.',';
				$v.="'".$value."'".',';
			}

			$k = substr($k,0,-1);
			$v = substr($v,0,-1);
			
//7、-------------------------插入信息表------------------------
		$sql = "insert into $table($k) values($v)";
//8、-----------------------写入服务器-------------------------
		$query = $this->query($sql);

	
//9、--------------------------判断有没有写入-------------------
		if(mysql_insert_id()>0)
		{
			 $this->jump('提交成功',$page);
		}else{
			$this->goback('没有写进服务器！！！');
		}

	}
		/**
		  *11、【功能】更改数据
		  *	   para：
		  *			 $table		string      表名
		  *          $data      array       数组值
		  *          $page      string      跳转的页面
		  *	 return：void
		  *    date：2018.7.24
		  */

		public 	function update($table,$data,$page='show_stu.php'){

			$k='';
			$id = $data['id']; 
			if(!is_array($data))
			{
				$this->goback('数组中的类型不对');
			}
			if(empty($data))
			{
				$this->goback('数组中的值为空');
			}
			unset($data['id']);
			foreach ($data as $key => $value) {
				$k.=$key.'='."'".$value."'".',';
				// $v.="'".$value."'".',';
			}

			$k = substr($k,0,-1);
			// $v = substr($v,0,-1);
			
	
//7、-------------------------更改信息------------------------
		$sql = "update $table set $k where id=$id";
		// echo $sql;
		// exit;
		
//8、-----------------------写入服务器-------------------------
		$query = $this->query($sql);
	
	
//9、--------------------------判断有没有改变-------------------
		if(mysql_affected_rows()>0)
		{
			$this->jump('更新数据成功',$page);
		}else{
			$this->goback('没有更新成功！');
		}
	}

/////////////////////////图片更新//////////////////////////////////
		/**
		  *12、【功能】图片上传
		  *	   para：$FILES   array     数组
		  *			 $upload  string    图片路径文件夹
		  *	 return：void
		  *    date：2018.7.24
		  */
		public function uploadimg($file,$upload){


			// echo "<pre>";
			// 	print_r($file);
			// echo "</pre>";
			// exit;
		// print_r($file);
	
	//1、判断是否通过post传送过来,临时文件有没有存在
	 if(is_uploaded_file($file['tmp_name'])){
	//2、赋值
	
	 	$name = $file['name'];
	 	$type = $file['type'];
	 	$tmp_name = $file['tmp_name'];
	 	$error = $file['error'];
	 	$size = $file['size'];
	
	 	
	//3、判断传过来的文件格式  image/jpeg
	 switch($type){
	 	case 'image/jpeg':$ok = 1;break;
	 	case 'image/jpg':$ok = 1;break;
	 	case 'image/gif':$ok = 1;break;
	 	case 'image/png':$ok = 1;break;
	 	default:$ok = 0;
	 }
	 
	 //4、判断是否传输正确
	if($ok && $error=='0')
	 {
	 //5、将临时文件移到目标文件夹
	 	move_uploaded_file($tmp_name,$upload.'/'.time().$name);
	 	$url = $upload.'/'.time().$name;
	 	return $url;
	 }else{
	 	return false;
	 }
	

	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";
		}
	}
	/**
		  *11、【功能】后台的防跳墙功能
		  *	   para：
		  *			 $table		string      表名
		  *          $data      array       数组值
		  *          $page      string      跳转的页面
		  *	 return：void
		  *    date：2018.7.24
		  */
	public function stophit($pass,$page)
	{
		session_start();
		if(empty($_SESSION[$pass])){
			$this->jump('请不要非法登录',$page);
		}
	}
}

 ?>