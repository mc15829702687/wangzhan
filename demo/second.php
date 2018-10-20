<?php
	include_once 'admin/db.class.inc.php';
	include_once 'admin/page_ok.class.inc.php';
	$db = new db('localhost','root','123456','newscms');
	$page = new Page('news',8,'second.php');
	$page->get_cur();
	$res = $page->get_page_data_ok();

	// echo '<pre>';
	// print_r($res);
	// echo '</pre>';
	// exit;
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>网站课程</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link href="second/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="second/css/second.css">
	<link rel="stylesheet" href="comman/comman.css">

	<link rel="stylesheet" href="second/css/style.css" type="text/css" media="all" />
	<script src='second/js/jquery.min.js'></script>

	<link href="second/css/animate.css" rel="stylesheet" type="text/css" media="all">
		<script src="second/js/wow.min.js"></script>
		<script>
		 new WOW().init();
		</script>
</head>

<body>

	<!-- ********************头部************************* -->
	
	<div class="header">
		<div class="container">
			<div class="w3l_header_left"> 
				<ul>
					<li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>15829702687</li>
					<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="#">1164882878@qq.com</a></li>
				</ul>
			</div>
			
			<div class="w3l_header_right">
				<ul>
					<li><a class="book popup-with-zoom-anim button-isi zoomIn animated" data-wow-delay=".5s" href="./admin/login/login1.php" target='_blank'><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Sign In</a></li>
					<li><a class="book popup-with-zoom-anim button-isi zoomIn animated" data-wow-delay=".5s" href="#small-dialog2"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Sign Up</a></li>
				</ul>
			</div>
			
			<div class="clearfix"> </div>
			
		</div>
	</div>
	<div class="logo-navigation-w3layouts">
		<div class="container">
		<div class="logo-w3">
			<a href="#"><h1><img src="./second/images/logo.png" alt=" " /><span>Inspire</span></h1></a>
		</div>
		<div class="navigation agileits w3layouts">
			<nav class="navbar agileits w3layouts navbar-default">
				<div class="navbar-header agileits w3layouts">
					<button type="button" class="navbar-toggle agileits w3layouts collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
						<span class="sr-only agileits w3layouts">Toggle navigation</span>
						<span class="icon-bar agileits w3layouts"></span>
						<span class="icon-bar agileits w3layouts"></span>
						<span class="icon-bar agileits w3layouts"></span>
					</button>
				</div>
				<div class="navbar-collapse agileits w3layouts collapse hover-effect" id="navbar">
					<ul class="agileits w3layouts">
						<li class="agileits w3layouts"><a href="index.html" class="scroll">首页</a></li>
						<li class="agileits w3layouts"><a href="second.php" class="active">网站课程</a></li>
						<li class="agileits w3layouts"><a class="scroll" href="third.html">网站前景</a></li>
						<li class="agileits w3layouts"><a class="scroll" href="forth.html">招聘信息</a></li>
						<li class="agileits w3layouts"><a class="scroll" href="fifth.html">佳作分享</a></li>
						<li class="agileits w3layouts"><a class="scroll" href="admin/message.php">解疑答惑</a></li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="clearfix"></div>
		</div>
	</div>

	<!-- ********************	目录栏	******************************* -->
	<article class='container_ok'>
		<div id='top'>
			<ul class='show'>
				<span>方向:</span>
				<li class='all'><a href="second.php">全部</a></li>
				<li>前端技术</li>
				<li>后端技术</li>
			</ul>

			<ul class='show'>
				<span>分类:</span>
				<li class='all'>全部</li>
				<li>HTML/CSS</li>
				<li>JS</li>
				<li>Vue</li>
				<li>Angular</li>
				<li> jQuery</li>
				<li>Bootstrap</li>
				<li>PHP</li>
				<li>TinkPhp</li>
				
			</ul>

		</div>

		<div class='text'>

		<?php 

			for($i=0;$i<count($res);$i+=2)
			{		
		?>
			<div class='xinxi'>
				<a href="xiangqing/second_xq.php?id=<?php echo $res[$i+1];?>">
					<p class='img'><?php echo $res[$i][0];?></p>
					<p class='title'><?php echo $res[$i][1];?></p>
					<p class='nei_rong'><?php echo $res[$i][2];?></p>
				</a>
			</div>
			
			<?php } ?>
		

			<div class='fenye'>
				<li><?php $page->show_fenye();?></li>
			</div>
		</div>
	</article>


	<div class="footer">
	<div class="container">
		<div class="footer-main">
			<div class="col-md-4 ftr-grid wow zoomIn" data-wow-delay="0.3s">
				<h3>Coaching</h3>
				<span class="ftr-line"> </span>
				<div style='float:left;margin-left:10em;'>
					<p>聚是一团火</p>
					<p>散是满天星 </p>
				</div>
			</div>
			<div class="col-md-4 ftr-grid ftr-mid wow zoomIn" data-wow-delay="0.3s">
				 <h3>Social Media</h3>
				 <span class="ftr-line flm"> </span>
				 <ul >
				 	<li><a href="./mobile/mobile1.html"><span class="gmail" style='margin-left:20px;width:auto;'> 移动端1</span></a></li>
				 	<li><a href="./mobile/mobile2.html"><span class="gmail" style='margin-left:20px;width:auto;'> 移动端2</span></a></li>
				 	<li><a href="./mobile/mobile3.html"><span class="gmail" style='margin-left:20px;width:auto;'> 移动端3</span></a></li> </ul>
				 	<ul>
				 	<li><a href="./bootstrap1/bootstrap1.html"><span class="gmail" style='margin-left:20px;width:auto;'> 响应式1</span></a></li>
				 	<li><a href="./bootstrap2/bootstrap2.html"><span class="gmail" style='margin-left:20px;width:auto;'> 响应式2</span></a></li>
				</ul>
			</div>
			<div class="col-md-4 ftr-grid ftr-rit wow zoomIn" data-wow-delay="0.3s">
				 <h3>Address</h3>
				 <span class="ftr-line flr"> </span>
				 <div style="float: right;margin-right:10em; ">
					 <p>工行二楼</p>
					 <p> 宝文理向西50米处</p>
				 </div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	</div>

	
	<!-- 右边工具 -->
    <div id="weixin_show">
        <input id="text" type="text" value="请扫二维码" style="width:80%;font-family:隶书;color:#F69;font-size:12px;"/>
        <section class="weixin_hr"></section>
        <section id="weixin_show1">
            <div id="qrcode" style="width:100px; height:100px; margin-top:15px;"><img src="images/weixin.png" alt=""></div>
        </section>
    </div>


    <div class="copy-right">
	<div class="container">
		<div class="copy-rights-main wow zoomIn" data-wow-delay="0.3s">
    	    <p>© 2018 Coaching. All Rights Reserved | Made by  <a href='../index.html' target="_self">MC</a> </p>
    	 </div>
    </div>
		<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

	</div>
	

    <div class="anniu">
        <section class="work">
            <img src="fifth/images/message.jpg" alt="">
            <span id="message">意见反馈</span>
            <div class="work_hr"> </div>
        </section>
            <section class="work">
            <img src="fifth/images/trouble.jpg" alt="">
            <span id="trouble">常见问题</span>
            <div class="work_hr"> </div>
        </section>
        <section id="weixin" class="work">
            <img src="fifth/images/weixin2.jpg" alt="">
            <div class="work_hr"> </div>
        </section>
        <section id="return" class="work">
            返回顶部
            <div class="work_hr"> </div>
        </section>
    </div>

	<script src='second/js/second.js'></script>		<!--目录栏下标变颜色-->
    <script src="second/js/return.js"></script>      <!--返回顶部-->
    <script src="./js/work.js"></script>        <!--右边工具栏 -->
	
</body>
</html>