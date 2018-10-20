<?php

	header('Content-Type:text/html;charset=utf-8');
	$lm2 = $_POST['id'];

	try {
		$pdo = new PDO('mysql:host=localhost;dbname=newscms','root','123456');
		$pdo->query('set names utf8');
		$sql = 'select content,title,id from news where lm2=? order by id desc limit 2';
		// $sql = 'select content,title,id from news where lm2=218 order by id desc limit 2';
		$result = $pdo->prepare($sql);
		$result->execute(array($lm2));

		while($res = $result->fetch(PDO::FETCH_ASSOC))
		{
			$res1 = explode('|', stripcslashes(htmlspecialchars_decode($res['content'])));
			$arr[] = $res1;
			$arr[] = $res['title'];
			
		}
		// echo '<pre>';
		// print_r($arr);
		// echo '</pre>';
		// exit;
		echo json_encode($arr);
	} catch (PDOException $e) {
		echo $e->getMessage().'<br/>';
	}

?>