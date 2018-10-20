<?php
	header('Content-Type:text/html;charset=utf-8');
	
	$pagesize = $_GET['pagesize'];
	$cur = $_GET['cur'];
	
	
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=newscms','root','123456');
		$pdo->query('set names utf8');
		
		$offset = ($cur-1)*$pagesize;
		$sql = 'select content,id from news where lm1=232 order by id desc limit '.$offset.','.$pagesize;
		
		$result = $pdo->prepare($sql);
		$result->execute();
		while($res = $result->fetch(PDO::FETCH_ASSOC)){
			$data[] = $res['id'];
			$data[] = explode('|',$res['content']);
		}
			
		echo json_encode($data);

	} catch (PDOException $e) {
		echo $e->getMessage().'<br/>';
	}
 ?>