<?php 
	header('Content-Type:text/html;charset=utf-8');
	$id = $_POST['lm1'];
	try {
		$pdo = new PDO('mysql:host=123.59.232.203;dbname=a1014001759','a1014001759','c869c73d');
		$pdo->query('set names utf8');
		$sql = 'select content from news where lm1=? order by id desc';
		$result = $sql->prepare($sql);
		$res = $result->execute(array($id));

	} catch (PDOException $e) {
		echo $e->getMessage().'<br/>';
	}
?>