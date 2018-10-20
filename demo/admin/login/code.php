<?php 
	//1、设置图片输出格式
	header('Content-Type:image/png');

	//14、开启session
	session_start();
	//2、赋值一个空串
	$str = '';

	//3、选择你验证码出现的字符都有哪些
	$have = 'abcdefghijklmnopqrstuvwxyz1234567890';

	//4、测定上一步字符串的长度
	$l = strlen($have);

	//5、确定你验证码出现的字符串个数还有随机字符
	for($i=0;$i<4;$i++)
	{
		$num=rand(0,$l-1);	//随机取字符串中的字符
		$str.=$have[$num];			//和空串链接起来
	}

	//15、给session赋值
	$_SESSION['code'] = $str;
	
	//6、创建验证码的背景和宽50,高20
	$img = imagecreate(50, 20);

	//7、设置3种主要颜色 黑:RGB为（0，0，0），白:RGB为（255，255，255），灰色（200,200,200）
	$black= imagecolorallocate($img, 0, 0, 0);
	$white = imagecolorallocate($img, 255, 255, 255);
	$gray = imagecolorallocate($img, 200, 200, 200);

	//8、给创建的画布，填充黑色
	imagefill($img,200,400,$black);

	//9、给画布中添加干扰线，增加查看难度RGB颜色是：220，170，180
	$li = imagecolorallocate($img, 220, 170, 180);
	for($i=0;$i<3;$i++)
	{
		imageline($img,rand(0,20) , rand(0,27), rand(0,21), rand(0,30), $li);//随机位置
	}
	//10、将验证码白色放进画布中,左上角（8，2）
	imagestring($img, 5, 8, 2, $str, $white);

	//11、添加灰色像素
	for($i=0;$i<290;$i++)
	{
		imagesetpixel($img, rand()%70, rand()%30, $gray);
	}

	//12、按png格式输出
	imagepng($img);

	//13、销毁
	imagedestroy($img);
 ?>