<?php 
  
  include_once '.\db.class.inc.php';

  session_start();
  if(empty($_SESSION['admin']))
  {
    echo "  <script>
          alert('不能跳级');
          window.history.go(-1);
        </script>";
    exit;
  }
  
  $d = new db('localhost','root','123456','newscms');
  $res = $d->getAllData('admin',MYSQL_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>栏目编辑</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    

    <!-- 内容 -->
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
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square"></div>
          <h1>Visual Admin</h1>
        </header>
        <div class="profile-photo-container">
          <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">  
          <div class="profile-photo-overlay"></div>
        </div>      
        <!-- Search box -->
       <form class="templatemo-search-form" role="search">
          <div class="input-group">
              <button type="submit" class="fa fa-search"></button>
              <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">           
          </div>
        </form>
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <nav class="templatemo-left-nav">          
           <ul>
            <li><a href="admin.php"><i class="fa fa-home fa-fw"></i>主页</a></li>
            <li><a href="edit_lm.php"><i class="fa fa-home fa-fw"></i>编辑栏目</a></li>
            <li><a href="add_news.php" class="active"><i class="fa fa-bar-chart fa-fw"></i>添加新闻</a></li>
            <li><a href="edit_news.php"><i class="fa fa-database fa-fw"></i>编辑新闻</a></li>
          </ul>  
        </nav>
      </div>
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
                <li><a href="./liuyan.php">管理留言</a></li>
                <li><a href=".\change_pwd.php?id=<?php echo $res[1]['id'];?>">修改密码</a></li>
                <li><a href="./backup.php">备份数据</a></li>
                <li><a href="javascript:window.parent.location.href='./login/login1.php'" >退出系统</a></li>
              </ul>  
            </nav> 
          </div>
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
                
              <form action="add_news_ok.php" method="POST" name="example">
                标题： <input type="text" name='title' value=""><br/>
                分类： <select name="fenlei" id="">
                    <?php 
                        $sql1 = "select id,lm1 from cms where lm1!=''";
                        $query1 = mysql_query($sql1) or die(mysql_error());
                        while($res1 = mysql_fetch_assoc($query1))
                        {
                    ?>
                        <option value="<?php echo $res1['id'].'|0'.'|0';?>"><?php echo $res1['lm1'];?></option>
                        
                        <!-- 二级栏目 -->
                        <?php   
                            $sql2 = 'select id,lm2 from cms where lmid='.$res1['id'];
                            $query2 = mysql_query($sql2) or die(mysql_error());
                            while($res2 = mysql_fetch_assoc($query2))
                            {
                         ?>
                        <option value="<?php echo $res1['id'].'|'.$res2['id'].'|'.'|0'; ?>">-----------|<?php echo $res2['lm2']; ?>
                        </option>
                        <!-- 三级栏目 -->
                          <?php 
                            $sql3 = 'select id,lm3 from cms where lmid='.$res2['id'];
                            $query3 = mysql_query($sql3) or die(mysql_error());
                            while($res3 = mysql_fetch_assoc($query3))
                            { ?>
                            <option value="<?php echo $res1['id'].'|'.$res2['id'].'|'.$res3['id']; ?>">=================|<?php echo $res3['lm3']; ?></option>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>
                    </select><br/>
              <!-- 作者 -->
              作者：<input type="text" name="adduser"><br/>
              内容： 
              <textarea name="content" style="width:700px;height:200px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea><br/>
              点击数：<input type="text" name='hit'><br/>
              <input type="submit" value="提交" >
              </form>

            </div>                          
          </div>   
        </div>       
  </body>
</html>
