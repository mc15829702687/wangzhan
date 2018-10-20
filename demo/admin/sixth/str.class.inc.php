<?php 
class Str{
	/**
	*功能：在内容区块之间加入分格线，
	*参数：string $type线形状- = # ~
	*return:void
*/
	function bye($type='',$news=''){
		echo "<div style='font-size:18px;color:red;font-weight:bold;'>";
		if($news=="")
		{
			echo "<br/>----------------------------------<br>";
		}else if($type=='-')
		{
			echo "<br/>--------------$news--------------------<br>";
		}else if($type=="="){

			echo "<br/>================$news==================<br>";
		}else if($type=="#"){
				
			echo "<br/>##############$news###############<br>";
		}else{
			
			echo "<br/>~~~~~~~~~~~~~~~$news~~~~~~~~~~~~<br>";
		}
		echo "</div>";
		}

	//计算长度
		/**
		  *功能：获取中英文字符串的长度，strlen中中文算3个长度，想算1个长度
		  *参数：string $s
		  *return:interger $k
		*/
		function my_length($s){
		$k=0;
		$j=strlen($s);
		for($i=0;$i<$j;$i++)
		if(ord($s[$i])>127)
		{
			$k++;
			$i+=2;
		}else{
			$k++;
		}
		return $k;
		}

	//截取字符串
	/**
		  *功能：截取中英文字符串,因为substr只能截取英文字符
		  *参数：string $s
		  *return:interger $s
	*/
	function my_jiequ($s,$start,$end){
	$k=0;
	$res="";
	switch($start%3)
	{
			case 1:$start+=2;break;
			case 2:$start+=1;
	}
	for($i=$start;$k<$end;$i++)
	{
		
		if(ord($s[$i])>127)
		{
			$res.=substr($s,$i,3);
			$k++;
			$i+=2;
		}else
		{
			$res.=substr($s,$i,1);
			$k++;
		}
	}
	return $res;
	}

}
 ?>