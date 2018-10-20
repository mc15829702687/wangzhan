<?php  
	/**
	  *	1、利用PDO链接数据库，设置编码格式
	  *	2、构建sql语句
	  *	3、PDO::prepare — 准备要执行的SQL语句并返回一个 PDOStatement 对象(		PHP 5 >= 5.1.0, PECL pdo >= 0.1.0) 
	  *	4、PDOStatement::execute — 执行一条预处理语句(PHP 5 >= 5.1.0, PECL 		pdo >= 0.1.0) 
	  *	5、查找所匹配的数据，放进二维数组中
	  */
	header('Content-Type:text/html;charset=utf-8');
	$id = $_POST['id'];
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=newscms','root','123456');
		$pdo->query('set names utf8');
		$sql = 'select content,title from news where lm2=?';
		// $sql = 'select content,title from news where lm2=251';
		$query = $pdo->prepare($sql);
		$query->execute(array($id));
		while($res = $query->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $res['title'];
			$data[] = explode('|',$res['content']);
			
		}
		
		// echo "<pre>";
		// print_r($data);
		// echo '</pre>';
		// exit;
		echo json_encode($data);
	} catch (PDOException $e) {
		echo $e->getMessage().'<br/>';
	}
?>