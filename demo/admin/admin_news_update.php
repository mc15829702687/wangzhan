<?php 

	include_once '.\db.class.inc.php';
	$d = new db('localhost','root','123456','newscms');


	$sql = 'select * from news where id='.$_GET['id'];
	$query = mysql_query($sql) or die(mysql_error());
	$res = mysql_fetch_assoc($query);

	// echo $_GET['zhi'];
	// exit;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新闻</title>
	<!-- 表单样式 -->
	<link href="css/style.css" rel='stylesheet' type='text/css' media="all" />

	<link rel="stylesheet" href="./kingeditor/themes/default/default.css" />
	<link rel="stylesheet" href="./kingeditor/plugins/code/prettify.css" />
	<script charset="utf-8" src="./kingeditor/kindeditor.js"></script>
	<script charset="utf-8" src="./kingeditor/lang/zh_CN.js"></script>
	<script charset="utf-8" src="./kingeditor/plugins/code/prettify.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
				cssPath : './kingeditor/plugins/code/prettify.css',
				uploadJson : './kingeditor/php/upload_json.php',
				fileManagerJson : './kingeditor/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>
</head>
<body>

	<div class="w3-banner-main">
		<div class="center-container">
			<h1 class="header-w3ls">Update news</h1>
			
			<div class="content-top">
				<div class="content-w3ls">
					
						<form action="admin_news_update_ok.php" method="POST" name="example">
						<div class="form-w3ls">
							<div class="content-wthree1">
								<div class="grid-agileits1">
									<div class="form-control">
										<input type="hidden" name="id" value="<?php echo $res['id'];?>">

										<label class="header">标题 <span>*</span></label>
										<input type="text" id="name" name="title" placeholder="标题"  value='<?php echo $res['title'];?>'>
									</div>
									
									<div class="form-control">	
										<label class="header">作者 <span>*</span></label>
										<input type="text" id="name" name="adduser" value="<?php echo $res['adduser'];?>">
									</div>
									
									<div class="form-control">
										<label class="header">分类 <span>*</span></label>		
										<select class="form-control" name='fenlei'>
											<?php	
							$sql1 = "select id,lm1 from cms where lm1!=''";
							$query1 = mysql_query($sql1) or die(mysql_error());
							while($res1 = mysql_fetch_assoc($query1))
							{
							
								//传递过来的栏目名称和一级栏目做比较
								if($_GET['zhi']==$res1['lm1']){
					?>
							<option value="<?php echo $res1['id'].'|0'.'|0';?>" selected="selected"><?php echo $res1['lm1'];?></option>
							<?php } else{ ?>
							<option value="<?php echo $res1['id'].'|0'.'|0';?>"><?php echo $res1['lm1'];?></option>
							<?php } ?>


							<!-- 二级栏目 -->
							<?php 	
									$sql2 = 'select id,lm2 from cms where lmid='.$res1['id'];
									$query2 = mysql_query($sql2) or die(mysql_error());
									while($res2 = mysql_fetch_assoc($query2))
									{
										if($_GET['zhi']==$res2['lm2'])
										{
							 ?>
							<option value="<?php echo $res1['id'].'|'.$res2['id'].'|'.'|0'; ?>" selected="selected">-----------|<?php echo $res2['lm2']; ?>
							</option>

							<?php }else{ ?>
							<option value="<?php echo $res1['id'].'|'.$res2['id'].'|'.'|0'; ?>">-----------|<?php echo $res2['lm2']; ?>
							</option>
							<?php } ?>
							<!-- 三级栏目 -->
								<?php 
									$sql3 = 'select id,lm3 from cms where lmid='.$res2['id'];
									$query3 = mysql_query($sql3) or die(mysql_error());
									while($res3 = mysql_fetch_assoc($query3))
									{ 
										if($_GET['zhi']==$res3['lm3'])
										{
								?>
									<option value="<?php echo $res1['id'].'|'.$res2['id'].'|'.$res3['id']; ?>" selected="selected">==========|<?php echo $res3['lm3']; ?></option>
									<?php }else{ ?>
									<option value="<?php echo $res1['id'].'|'.$res2['id'].'|'.$res3['id']; ?>">===========|<?php echo $res3['lm3']; ?></option>
									<?php } ?>

									<?php } ?>
								<?php } ?>
							<?php } ?>
										</select>
									</div>
								</div>
								
							</div>

							<div class="form-control">	
								<label class="header">点击 <span>*</span></label>
										<input  id="email" name='hit' value="<?php echo $res['hit']; ?>">
							</div>

							<div class="form-control">	
								<label class="header">内容 <span>*</span></label>
								<textarea  name="content" ><?php echo htmlspecialchars($htmlData);?>
										<?php echo stripcslashes(htmlspecialchars_decode($res['content'])); ?>
								</textarea>
							</div>
							<input type="submit" value="提交"></form>
							
					</div>

					<div class="clear"></div>
				</div>
				
			</div>	
				
		</div>

</body>
</html>
