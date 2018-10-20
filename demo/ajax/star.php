<?php

	header('Content-Type:text/html;charset=utf-8');
	$lm2 = $_POST['id'];

	try {
		$pdo = new PDO('mysql:host=localhost;dbname=newscms','root','123456');
		$pdo->query('set names utf8');
		$sql = 'select content,title from news where lm1=? order by id desc limit 5';
		$result = $pdo->prepare($sql);
		$result->execute(array($lm2));

		while($res = $result->fetch(PDO::FETCH_ASSOC))
		{
			$res1 = explode('|', $res['content']);
			$arr[] = $res1;
			$arr[] = $res['title'];
		}
		echo json_encode($arr);
	} catch (PDOException $e) {
		echo $e->getMessage().'<br/>';
	}

?>