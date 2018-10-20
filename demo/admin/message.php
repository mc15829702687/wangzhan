<?php 
	include_once 'db.class.inc.php';
	include_once 'page.class.inc.php';
	session_start();


	$d = new db('localhost','root','123456','newscms');
	$question = $d->common('user_message',7);
	// echo '<pre>';
	// print_r($question);
	// echo '</pre>';
	// exit;
	$data = $d->getAllData('user_message',MYSQL_ASSOC);


	// -----------------------搜索信息-----------------------------
		//  搜索表单传递的值
		// 翻页传递的值	
	
	$value=$_GET['search'];
	if(!empty($value))
	{
		$page = new Page('user_message',2,'message.php');
		$page->get_cur();
		$sql1 = "select * from user_message where ask_type like '%$value%' or name like '%$value%' or qq like '%$value%' or time like '%$value%' or content like '%$value%'";

		$count=count($d->getSqlData($sql1,MYSQL_ASSOC));

		$page1 = ceil($count/$page->pagesize);
		$offset=($page->cur-1)*$page->pagesize;
		$sql = "select * from user_message where ask_type like '%$value%' or name like '%$value%' or qq like '%$value%' or time like '%$value%' or content like '%$value%' limit $offset,$page->pagesize";
		$res=$d->getSqlData($sql,MYSQL_ASSOC);
		
	}else{

		$page = new Page('user_message',2,'message.php');
		$page->get_cur();
		$num = count($page->getAllData('user_message'));
		$res = $page->get_page_data();

		$count = $num;
		$offset = $page->offset;
	}


	// ask_type 	name 	qq 	time 	up 	zan 	secret 	content
	//	--------------------插入信息---------------------------
	if($_POST['submit']=="发布")
	{
	
		if(empty($_POST['ask_type']) ||empty($_POST['name']) ||empty($_POST['qq'])||empty($_POST['secret'])||empty($_POST['content']))
		{
			$d->goback('信息不完整');
		}

	// 判断是什么类型问题
	if($_POST['ask_type']=='技术问题')
	{
		$_POST['ask_type'] = 0;
	}else if($_POST['ask_type']=='咨询问题'){
		$_POST['ask_type'] = 1;
	}else{
		$_POST['ask_type'] = 2;
	}

	// 设置时间
	date_default_timezone_set("Asia/Shanghai");
	$_POST['time'] = date("Y-m-d H:i:s");


	$url = $d->uploadimg($_FILES['up'],'images');
	if(!empty($url))
	{
		$_POST['photo'] = $url;
	}else if(empty($_POST['qq']))
	{
		$_POST['photo'] = "sixth/images/2.jpg";
	}else{
		$_POST['photo'] = "http://q1.qlogo.cn/g?b=qq&nk=$_POST[qq]&s=100";
	}
	unset($_POST['submit']);

	$d->insert('user_message',$_POST,'message.php');
	}

	// $sql = 'select * from user_message order by id desc limit 1';
	// $query = mysql_query($sql);
	// $s = mysql_fetch_assoc($query);
	// $_SESSION['id'] = $s['id'];
	
	// ---------------    获取qq表情     -------------------
	function replace_em($str){
			$str = preg_replace('/\</','&lt;',$str);
			$str = preg_replace('/\>/','&gt;',$str);
			$str = preg_replace('/\n/','<br/>',$str);
			$str = preg_replace('/\[em_([0-9]*)\]/','<img src="sixth/arclist/$1.gif" border="0" />',$str);
			return $str;

	
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>疑难解惑</title>
	<link rel="stylesheet" href="sixth/message.css">

	<!-- $$$$$$$$$$$$$$$$$ QQ表情 $$$$$$$$$$$$$$$$$$$$$$ -->

	<link rel="stylesheet" href="sixth/css/qq.css">
	<script src="sixth/js/jquery.min.js"></script>
	

    <!-- ***************** 由qq号来获取头像 ************************ -->
    <script src="sixth/js/qq.js"></script>
</head>

<body>
	<!-- **************************头部 **********************-->
	<header>
		<!-- <img src="sixth/images/attack.png" alt=""> -->
		<img src="sixth/images/head.jpg" alt="">
	</header>

	<!-- *************************文本栏 *********************-->

	<nav>
		<li id="address">
			所处位置：
			疑难问题/<a href="../index.html">网站首页</a>
		</li>

		<li id="talk">
			<form action="">
			站长说	<marquee behavior="" direction="">敢做就能赢！！！</marquee>
			</form>
		</li>

		<li id="search">
			<form action="">
				<input type="search" placeholder="点击搜索" name="search">
				<input type="submit" value="搜索">
			</form>
		</li>
	</nav>

	<!-- **************************左侧栏********************** -->
	<article class="middle_m">
	<aside>
		<form action="message.php" method="post" enctype="multipart/form-data">
		<!-- 选择问题 -->
			<section class="question">
				<input type="radio" name="ask_type" value="技术问题" checked="checked"><span>技术问题</span>
				<input type="radio" name="ask_type" value="咨询问题" ><span>咨询问题</span>
				<input type="radio" name="ask_type" value="生活问题" ><span>生活问题</span>
			</section>

		<!-- 昵称 -->
			<section class="username">
				<p>昵称</p>
				<input nametype="text" placeholder="输入昵称"  name="name">
			</section>

		<!-- qq号码 -->
			<section class="qq_number">
				<p>qq号</p>
				<input type="text" placeholder="输入qq号来获取头像" name="qq" id="qq">
			</section>

		<!-- 选择头像 -->
			<section class="select">
				<span>选择头像</span>
				<select>
		  			<option value="头像1">头像1</option>
		  			<option value="头像2">头像2</option>
		  			<option value="头像3">头像3</option>
		  			<option value="头像4">头像4</option>
		  			<option value="头像5">头像5</option>
				</select>
			</section>

		<!-- 选择头像 -->
			<section class="up">
				<p>上传头像</p>
				<input type="file" name="up" accept="" value=""/>
				<p class="ff">注：上传头像方法只能三选一</p>
			</section>

		<!-- 验证码 -->
			<section class="code">
				<input type="text" placeholder="输入验证码">
				<img src="sixth/code.php" alt="" onclick="this.src=this.src+'?'+Math.random()">
			</section>
		
		<!-- 图片展示框 -->
		<section class="img"  name="photo">
			<img src="sixth/images/2.jpg" alt="">
		</section>

		<!-- 匿名或公开 -->
			<section class="niming">
				<select name="secret">
		  			<option value="公开">公开</option>
		  			<option value="匿名">匿名</option>
				</select>
			</section>
	
		<p class="share">有什么问题可以分享</p>
		
		<!-- 文本域 -->
			<section class="com_form">
			<p class="zishu">请输入你的<span>问题</span></p>
			<!-- <textarea name="liuyan" id="" cols="30" rows="10" placeholder="输入你的问题！！！"></textarea>
			<div class="biaoqing">☺</div> -->
			<textarea class="input" id="saytext" name="content" placeholder="输入你的问题！！！"></textarea>
        	
        	<p class="com_form_bottom">
        	<span class="emotion">☺</span>
				<!-- <section class="add_img">
					<div id="col"></div>
					<div id="row"></div>
				</section> -->
			<input type="submit" class="sub_btn" value="发布" name="submit">
			</p>
		</section>
		</form>	
	</aside>

	<!-- ******************留言内容显示********************* -->
	<article class="message_show">
		<!-- 留言人消息 -->
		<div style="float:left;">
			<section class="show" id="show">
				<p class="ask">“问题”消息</p>
				<div id="show1">
					<section class="ask1" id="ask1">
					<?php for($j=0;$j<count($question);$j+=3){ ?>
						<li style='margin-top:10px;'>
							<label for="" style='color:#a7e9e7;'><?php echo $question[$j];?></label>
							<label for="" >提出了</label>
							<span><?php echo $question[$j+1];?></span>
						</li>
					<?php } ?>		
					</section>
					<section class="ask2" id="ask2"></section>
				</div>
			</section>

			<section class="show">
				<p class="ask">“问题”达人</p>
				<div id="show2">
				
				<section class="ask1" id="ask3">
					<?php for($j=0,$k=1;$j<count($question);$j+=3,$k++){ ?>
					<li>	
						<lable><?php echo $question[$j].'的问题赞为：'; ?></lable>
						<label style='color:#942522;text-align: center;'><!-- <img src="sixth/images/zan.gif" alt=""> --><?php echo $question[$j+2]; ?></label>	
					</li>
					<?php } ?>
					
				</section>
				<section class="ask2" id="ask4"></section>
			</div>
			</section>
		</div>


	<?php 
	  	// $n=$page->records;

		for($i=0;$i<count($res);$i++)
		{
	 ?>
		<section class="message_text" id="message_text<?php echo $i;?>">
			<div class="left">
			<?php 
			if(empty($res[$i]['qq'])){
			 ?>
					<p><img src="sixth/images/2.jpg" alt=""></p>
			 <?php 
				}else{
			  ?>
			  <p>
			  	<img src="http://q1.qlogo.cn/g?b=qq&nk=<?php echo $res[$i]['qq'];?>&s=100">

			  </p>
			  <?php 
			  }
			   ?>
				<!-- <p><img src="sixth/images/2.jpg" alt=""></p> -->
				<p id="h<?php echo $i;?>">
					<?php if(empty($value)) 
							echo $res[$i]['name'];
						else echo str_ireplace($value,"<font style='color:red;font-weight:bolid;'>".$value."</font>",$res[$i]['name']) ; ?>
				</p>
			</div>
			<div class="right">
				<p class="top">
					<span class="louceng" id="s<?php echo $i;?>"><?php echo $count-$offset;?>楼</span>
					
					<span class="span1" id="h2<?php echo $i;?>"><?php 
					if(empty($value)) echo $res[$i]['time']; else echo str_ireplace($value,"<font style='color:red;font-weight:bolid;'>".$value."</font>",$res[$i]['time']) ;?></span> 
				<!-- 点赞 -->
				<section class="zan_show" id="zan_show<?php echo $i;?>">
					<span class="span2" onclick=zan(<?php echo $res[$i]['id'];?>)><img src="sixth/images/aixin.png" alt=""></span>
					<span class="zan" id="<?php echo $res[$i]['id']; ?>"><label id="label<?php echo $i;?>"><?php echo $res[$i]['zan']; ?></label></span>
				</section>

				</p>
				<!-- 下划线 -->
				<div class="hr"></div>

				<p class="middle">
				
				<span id="ask_type<?php echo $i;?>">
				<?php 
					if($res[$i]['ask_type']==0)
					{
						echo "<strong style='color:red;'>技术问题：</strong>";
					}else if($data[$i]['ask_type']==1){
						echo "<strong style='color:blue;'>咨询问题：</strong>";
					}else{
						echo "<strong style='color:yellow;'>生活问题：</strong>";
					}
				 ?>
				 </span>
				 <!-- 显示内容 -->
				 <section class="look" id="look<?php echo $i;?>">
				 <?php $res[$i]['content']=replace_em($res[$i]['content']); ?>
				 <?php if(empty($value)) echo $res[$i]['content']; else echo str_ireplace($value,"<font style='color:red;font-weight:bolid;'>".$value."</font>",$res[$i]['content']) ; ?></p>
				 </section>
				<!-- 下划线 -->
				<div class="hr"></div>
				
				<?php 
				// 获取留言主键和回复外键相等的信息
					$mysql = 'select * from user_replay where user_replay_id='.$res[$i]['id'];
					$replay = $d->getSqlData($mysql,MYSQL_ASSOC);

				?>
				<section class="replay">
					<p class="replay_name">回复人：小马
					<?php  if(empty($value)) echo $replay[0]['time']; else echo str_ireplace($value,"<font style='color:red;font-weight:bolid;'>".$value."</font>",$replay[0]['time']) ;?></p>
					<section>
						<?php 
						//判断管理员是否回复成功 
						if(!empty($replay))
						{
							echo $replay[0]['replay_content'];
						}else{
							echo "谢谢留言，稍等回复！！！";
						}
						
						?>
					</section>
				</section>

				<!-- 撤销和回复 -->
				<p class="bottom">
				<?php if(!empty($_SESSION['admin'])){ ?> 
					<span class="huifu" onclick='huifu(<?php echo $res[$i]['id']?>)'>回复</span>
				<?php 
					}
				 ?>
				<p class="talk_bottom">
				
		<!-- <span 
		onclick=
		"cancel(<?php //echo $res[$i][id];?>,'<?php //echo $res[$i][time];?>')">

		撤销</span>
 -->					
				</p>
			</div>
		</section>
	<?php 
	    $count--;
		}
	 ?>
	 <!-- 888888888888888888888888888搜索情况888888888888888888888888888 -->

		<section class="text_bottom">
			<li>共有信息:<?php echo $num; ?>条</li>　 
			<li>每页显示 <?php echo $page->pagesize; ?> 条</li>
			<?php if(empty($value)) {?>　 
			<li>第<?php echo $page->cur;?> 页/共 <?php echo $page->pagecount;?> 页</li>
			<?php }else{	?>
			<li>第<?php echo $page->cur;?> 页/共 <?php echo $page1;?> 页</li>
			<?php } ?>
			<li>
			<?php
				if(empty($value))
			 		echo $page->show_fenye();
			 	else{
			 		// 23
			 		echo $page->search_fenye($page1,$value);
			 		// echo $page->show_fenye();
			 	}

			 ?></li>
			
	　  </section>
	</article>
	</article>
	<!-- ***************    回复     ******************* -->
	<script>
			function fun(){
				$('.huifu_show').hide();
			}
	</script>

	<section class="huifu_show">
		<form action="sixth/huifu_show.php" method="post">
			<section class="user_message">
				<input type="hidden" id="user_replay_id" name="user_replay_id" value="">
				<p class="huifu_top">
					<span class="huifu_name"></span>
					提出了
					<span class="huifu_question"></span>
				</p>
				<p class="huifu_content"></p>
			</section>
			<section class="huifu_text">
				<textarea name="replay_content" id="" cols="30" rows="10" class="huifu_text1" placeholder="回复消息。。。。。"></textarea>
			</section>
			
			<input type="submit" value="回复" name="huifu" class="huifu_button">
		</form>
		<div class="quxiao" onclick="fun()" style="background:gray;text-align:center;">取消</div>
	</section>

	<!-- qq的JS -->
	<script type="text/javascript" src="sixth/js/jquery-browser.js"></script>
	<script type="text/javascript" src="sixth/js/jquery.qqFace.js"></script>
	<script type="text/javascript">
	$(function(){
		$('.emotion').qqFace({
			id : 'facebox', 
			assign:'saytext', 
			path:'sixth/arclist/'	//表情存放的路径
		});
		$(".sub_btn").click(function(){
			var str = $("#saytext").val();
			$(".look").html(replace_em(str));
		});
	});
//查看结果
function replace_em(str){
			str = str.replace(/\</g,'&lt;');
			str = str.replace(/\>/g,'&gt;');
			str = str.replace(/\n/g,'<br/>');
			str = str.replace(/\[em_([0-9]*)\]/g,'<img src="sixth/arclist/$1.gif" border="0" />');

			return str;

}
</script>
	<script src="sixth/js/huifu.js"></script>		<!--回复的JS代码-->
	<script src="sixth/js/cancel.js"></script>		<!--撤销的JS代码-->
	<!-- <script src="sixth/js/comment.js"></script> -->		<!--评论的JS代码-->
	<script src="sixth/js/zan.js"></script>			<!--点赞的JS代码-->
	<script src="sixth/js/move.js"></script>		<!--信息向上走动-->
	<script src="sixth/js/change_img.js"></script>	<!--改变图片-->
</body>
</html>