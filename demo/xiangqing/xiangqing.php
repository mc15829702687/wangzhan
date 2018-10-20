<?php 
	/**
	  *	1、利用PDO链接数据库，设置编码格式
	  *	2、构建sql语句
	  *	3、PDO::prepare — 准备要执行的SQL语句并返回一个 PDOStatement 对象(		PHP 5 >= 5.1.0, PECL pdo >= 0.1.0) 
	  *	4、PDOStatement::execute — 执行一条预处理语句(PHP 5 >= 5.1.0, PECL 		pdo >= 0.1.0) 
	  *	5、查找所匹配的数据，放进二维数组中
	  */
	header('Content-Type:text/html;charset=utf-8');
	$id = $_GET['id'];
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=newscms','root','123456');
		$pdo->query('set names utf8');
		$sql = 'select content from news where lm2=?';
		// $sql = 'select content from news where lm2=257';

		$query = $pdo->prepare($sql);
		$query->execute(array($id));
		while($res = $query->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = stripcslashes(htmlspecialchars_decode($res['content']));
		}

		$sql1 = "select lm2 from cms where id=$id";
		$query1 = $pdo->prepare($sql1);
		$query1->execute();
		while($res1 = $query1->fetch(PDO::FETCH_ASSOC))
		{
			$data1[] = $res1['lm2'];
		}
		// print_r($data1);
		// exit;

		
	} catch (PDOException $e) {
		echo $e->getMessage().'<br/>';
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>详情页</title>
	<!-- 轮播 -->
	<link rel="stylesheet" type="text/css" href="xiangqing/css/lunbo.css" />

	<style>
		#tu img{
			 width:300px;height:200px;float:left;padding:20px;
		}
	</style>
	
	
	<!-- 头部与尾部 -->
	<link href="../second/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- <link rel="stylesheet" href="../second/css/second.css"> -->
	<link rel="stylesheet" href="xiangqing/css/second.css">
	<link rel="stylesheet" href="../comman/comman.css">

	<link rel="stylesheet" href="../second/css/style.css" type="text/css" media="all" />
	<script src='../second/js/jquery.min.js'></script>

	<link href="../second/css/animate.css" rel="stylesheet" type="text/css" media="all">
		<script src="../second/js/wow.min.js"></script>
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
					<li><a class="book popup-with-zoom-anim button-isi zoomIn animated" data-wow-delay=".5s" href="../admin/login/login1.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Sign In</a></li>
					<li><a class="book popup-with-zoom-anim button-isi zoomIn animated" data-wow-delay=".5s" href="#small-dialog2"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Sign Up</a></li>
				</ul>
			</div>
			
			<div class="clearfix"> </div>
			
		</div>
	</div>
	<div class="logo-navigation-w3layouts">
		<div class="container">
		<div class="logo-w3">
			<a href="#"><h1><img src="../second/images/logo.png" alt=" " /><span>Inspire</span></h1></a>
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
						<li class="agileits w3layouts"><a href="../index.html" class="active">首页</a></li>
						<li class="agileits w3layouts"><a href="../second.php" class="scroll">网站课程</a></li>
						<li class="agileits w3layouts"><a class="scroll" href="../third.html">网站前景</a></li>
						<li class="agileits w3layouts"><a class="scroll" href="../forth.html">招聘信息</a></li>
						<li class="agileits w3layouts"><a class="scroll" href="../fifth.html">佳作分享</a></li>
						<li class="agileits w3layouts"><a class="scroll" href="">留言板</a></li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="clearfix"></div>
		</div>
	</div>

<div class='main'>
	<!-- **********************课程简介************************* -->

<!-- +++++++++++++++++++	左侧栏	++++++++++++++++++++++++++++ -->
	<article class="left">
		<div class='article-header-box'>
			<div class='article-header'>
			<!-- 标题 -->
				<div class='article-titlie-box'>
					
					<h1 class="title-article"><?php echo $data1[0]; ?></h1>
				</div>
			<!-- 阅读量 -->
			<div class='article-info-box'>
				<span class='time_1'>2018-10-1</span>
				<span class='name'>mc</span>
				<span class='read-count'>阅读数：<label>20</label></span>
			</div>
			
			</div>
		</div>
		
		<div style='padding-top:16px;'>
			<section>
				<p style='font-size:20px;color:red;'></p>
				<div id='dai_ma' style="height:auto;">
					<p style='color: rgb(62, 62, 62);font-size: 15px;font-weight: 400;'><?php echo $data[0]; ?></p>
					<p><?php echo $data[1]; ?></p>
					<p><?php echo $data[2]; ?></p>
				</div>

			</section>
			<section>
				<p style='font-size:20px;color:red;'></p>
				<div id='tu'>
					<?php echo $data[3]; ?>
				</div>
				
			</section>
		</div>
	</article>

	<!-- ********************右侧栏**************************** -->
	<aside class='right'>
		<section class="aside-box">
			
				<h4><span></span>最新文章</h4>
			<div class='aside-content'>
				<ul>
				<!-- Web前端 -->
					<li><a href="./xiangqing.php?id=282">程序员才能看懂的段子<span class='time'>2018-7</span></a></li>
				<!-- HTML -->
					<li><a href="./xiangqing.php?id=283">当程序员老去的一天<span class='time'>2018-8</span></a></li>	
				</ul>
			</div>
		</section>

		

		<section class="aside-box">
		
				<h4><span></span>面试题</h4>
			<div class='aside-content'>
			<ul>
				<li><a href="./xiangqing.php?id=280">JS遍历二叉树和创建链表</a></li>
				<li><a href="./xiangqing.php?id=278">常见前端JS面试题集合</a></li>
				<li><a href="./xiangqing.php?id=281">JS常见面试题集合</a></li>
			</ul>
			</div>
		</section>
		
		<!-- 轮播 -->
		<section class="aside-box">
		<div id="playimages" class="play">
			<ul class="big_pic">
				<div class="prev"></div>
			    <div class="next"></div>
			    
			  
			    <div class="length"></div>
			    
			    <a class="mark_left" href="javascript:;"></a>
			    <a class="mark_right" href="javascript:;"></a>
			    <div class="bg"></div>
			    
			    <li style="z-index:1;"><img src="images/tu1.jpg" /></li>
			    <li><img src="images/tu2.jpg" /></li>
			    <li><img src="images/tu3.jpg" /></li>
			    <li><img src="images/tu4.jpg" /></li>
			    <li><img src="images/tu5.jpg" /></li>
			    <li><img src="images/tu6.jpg" /></li>
			    </ul>
			    <div id="small_pic" class="small_pic">
			    	<ul style="width:300px;">
			        	<li style=" filter: alpha(opacity:100); opacity:1;"><img src="images/tu1.jpg" /></li>
			            <li><img src="images/tu2.jpg" /></li>
			            <li><img src="images/tu3.jpg" /></li>
			            <li><img src="images/tu4.jpg" /></li>
			            <li><img src="images/tu5.jpg" /></li>
			            <li><img src="images/tu6.jpg" /></li>
			        </ul>       
			    </div>
		</div>
		</section>

		<section class="aside-box">
		
				<h4><span></span>手记文章</h4>
			<div class='aside-content'>
				<ul>
					<li>
						<a href="./xiangqing.php?id=293">PHP正则</a>
						<p class='read'>阅读量：<span>1</span></p>
					</li>
					<li>
						<a href="./xiangqing.php?id=273">PHP会员登录系统的制作</a>
						<p class='read'>阅读量：<span>2</span></p>
					</li>
					<li>
						<a href="./xiangqing.php?id=284">JS原生态如何实现大图轮播效果的？</a>
						<p class='read'>阅读量：<span>3</span></p>
					</li>
					<li>
						<a href="./xiangqing.php?id=257"> JS原生态如何实现简单型购物车页面？</a>
						<p class='read'>阅读量：<span>4</span></p>
					</li>
				</ul>
			</div>
		</section>
	</aside>

	<script>
			$(window).scroll(function() {
				var windowHeight = $(window).scrollTop() + $(window).height();
				var sideHeight = $('.right').height();
				var leftHeight = $('.left').height();
				var footer =  $('.footer').height();
				if (windowHeight > sideHeight&&windowHeight<=leftHeight+footer) {
					$('.right').css({
						'position' : 'fixed',
						right : '70px',
						top : -(sideHeight - $(window).height())
					});
				} else {
					$('.right').css({
						'position' : 'static'
					});
				}
			});
		</script>

</div>

<!-- 底部 -->
	<div class="footer" style='margin-top:20px;clear:both;'>
	<div class="container">
		<div class="footer-main">
			<div class="col-md-4 ftr-grid wow zoomIn" data-wow-delay="0.3s">
				<h3>Coaching</h3>
				<span class="ftr-line" style='margin: 1.5em 8em;'> </span>
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
				 <span class="ftr-line flr" style='margin: 1.5em 12em;'> </span>
				 <div style="float: right;margin-right:10em; ">
					 <p>工行二楼</p>
					 <p> 宝文理向西50米处</p>
				 </div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	</div>

	<div class="copy-right">
	<div class="container">
		<div class="copy-rights-main wow zoomIn" data-wow-delay="0.3s">
    	    <p>© 2018 Coaching. All Rights Reserved | Made by  <a href='../index.html' target="_self">MC</a> </p>
    	 </div>
    </div>
		<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

	</div>

	

    <div class="anniu" id='return'>
            <img src="../images/top_mover.png" alt="">
    </div>

	<script src="xiangqing/js/move.js"></script>					<!-- 轮播 -->	
    <script src="xiangqing/js/return.js"></script>      <!--返回顶部-->
    
</body>
</html>