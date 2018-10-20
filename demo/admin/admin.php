<?php
// 1、获取原密码的id
  include_once 'db.class.inc.php';

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
    <meta name="description" content="">
    <meta name="author" content="templatemo">
   
    
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">


    <!-- 字体向下移动 -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>

    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
      new WOW().init();
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
          <img src="images/demo.jpg" alt="Profile Photo" class="img-responsive">  
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
            <li><a href="admin.php" class="active"><i class="fa fa-home fa-fw"></i>主页</a></li>
            <li><a href="edit_lm.php"><i class="fa fa-home fa-fw"></i>编辑栏目</a></li>
            <li><a href="add_news.php"><i class="fa fa-bar-chart fa-fw"></i>添加新闻</a></li>
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
                <li><a href="../index.html" >返回首页</a></li>
              </ul>  
            </nav> 
          </div>
        </div>
        <div class="templatemo-flex-row flex-content-row templatemo-overflow-hidden"> <!-- overflow hidden for iPad mini landscape view-->
            <div class="col-1 templatemo-overflow-hidden">
              <div class="templatemo-content-widget white-bg templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <div class="templatemo-flex-row flex-content-row">
                  <div class="banner" id="home">
                  <div class="col-1 col-lg-6 col-md-12">

<!--banner start here-->
                  
                    <div class="container">
                      <div class="banner-main wow bounceInDown" data-wow-delay="0.3s">
                            
                             <span class="bann-line"> </span>
                             <h1>Welcome to my admin</h1>
                             
                      </div>
                    </div>
                  </div>
<!--banner end here-->

                  </div>
                  
                </div>                
              </div>
            </div>
          </div>
         
        </div> 
      </div>
    </div>
    
  </body>
</html>