<?php 
	header('Content-Type:text/html;charset=utf-8');
	$id = $_POST['lm1'];
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=newscms','root','123456');
		$pdo->query('set names utf8');
		$sql = 'select content from news where lm1=? order by id desc';
		$result = $sql->prepare($sql);
		$res = $result->execute(array($id));

	} catch (PDOException $e) {
		echo $e->getMessage().'<br/>';
	}
?>