<?php
	// echo 2; 
	// exit;
	header('Content-Type:text/html;charset=utf-8');
	
	$lm = $_POST['lm'];
	$val= $_POST['lm1'];
	
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=newscms','root','123456');
		$pdo->query('set names utf8');
		if($lm=='lm2')
		{
			$sql = "select title,content,id from news where $lm='$val'";
		}else if($lm=='lm1'){
			$sql = "select title,content,id from news where $lm='$val' order by id desc";
		}
		
		// $sql = "select title,content,id from news where lm2='234'";
		$result = $pdo->prepare($sql);
		$result->execute();
		while($res = $result->fetch(PDO::FETCH_ASSOC))
		{
			$data[]= $res['title'];
			$data[] = explode('|', $res['content']);
			$data[] = $res['id'];
		}
		
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// exit;
		echo json_encode($data);

	} catch (PDOException $e) {
		echo $e->getMessage().'<br/>';
	}
?>