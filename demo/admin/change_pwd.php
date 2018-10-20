<?php 
  include_once 'db.class.inc.php';
  $d = new db('localhost','root','123456','newscms');
  $res = $d->getoneData($_GET['id'],'admin',MYSQL_ASSOC);

  session_start();
  if(empty($_SESSION['admin']))
  {
    echo "  <script>
              alert('不能跳级');
              window.history.go(-1);
            </script>";
            exit;
  }
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

    
    <style type="text/css">
              .login-page {
               width: 460px;
               padding: 8% 0 0;
               margin: auto;
              }
              .form {
               position: relative;
               z-index: 1;
               background: #FFFFFF;
               max-width: 460px;
               margin: 0 auto 100px;
               padding: 45px;
               text-align: center;
               box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
              }
              .form p{
                float:left;
                width:100%;
              }
              .form p label{
                width:25%;
                float:left;
                font-size:18px;
                line-height: 50px;
              }

              .form input {
               font-family: "Roboto", sans-serif;
               outline: 0;
               background: #f2f2f2;
               width: 70%;
               border: 0;
               margin: 0 0 15px;
               padding: 15px;
               box-sizing: border-box;
               font-size: 14px;
              }
              .form .submit {
               font-family: "Microsoft YaHei","Roboto", sans-serif;
               text-transform: uppercase;
               outline: 0;
               background: #4CAF50;
               width: 100%;
               border: 0;
               padding: 15px;
               color: #FFFFFF;
               font-size: 18px;
               -webkit-transition: all 0.3 ease;
               transition: all 0.3 ease;
               cursor: pointer;
              }
              .form button:hover,.form button:active,.form button:focus {
               background: #43A047;
              }
              .form .message {
               margin: 15px 0 0;
               color: #b3b3b3;
               font-size: 12px;
              }
              .form .message a {
               color: #4CAF50;
               text-decoration: none;
              }
              .form .register-form {
               display: none;
              }
              .container {
               position: relative;
               z-index: 1;
               max-width: 300px;
               margin: 0 auto;
              }
              .container:before, .container:after {
               content: "";
               display: block;
               clear: both;
              }
              .container .info {
               margin: 50px auto;
               text-align: center;
              }
              .container .info h1 {
               margin: 0 0 15px;
               padding: 0;
               font-size: 36px;
               font-weight: 300;
               color: #1a1a1a;
              }
              .container .info span {
               color: #4d4d4d;
               font-size: 12px;
              }
              .container .info span a {
               color: #000000;
               text-decoration: none;
              }
              .container .info span .fa {
               color: #EF3B3A;
              }
              body {
               font-family: "Roboto", sans-serif;
               -webkit-font-smoothing: antialiased;
               -moz-osx-font-smoothing: grayscale;      
              }
              .shake_effect{
              -webkit-animation-name: shake;
                animation-name: shake;
                -webkit-animation-duration: 1s;
                animation-duration: 1s;
              }
              @-webkit-keyframes shake {
               from, to {
                 -webkit-transform: translate3d(0, 0, 0);
                 transform: translate3d(0, 0, 0);
               }


               10%, 30%, 50%, 70%, 90% {
                 -webkit-transform: translate3d(-10px, 0, 0);
                 transform: translate3d(-10px, 0, 0);
               }


               20%, 40%, 60%, 80% {
                 -webkit-transform: translate3d(10px, 0, 0);
                 transform: translate3d(10px, 0, 0);
               }
              }


              @keyframes shake {
               from, to {
                 -webkit-transform: translate3d(0, 0, 0);
                 transform: translate3d(0, 0, 0);
               }


               10%, 30%, 50%, 70%, 90% {
                 -webkit-transform: translate3d(-10px, 0, 0);
                 transform: translate3d(-10px, 0, 0);
               }


               20%, 40%, 60%, 80% {
                 -webkit-transform: translate3d(10px, 0, 0);
                 transform: translate3d(10px, 0, 0);
               }
              }
              p.center{
              color: #fff;font-family: "Microsoft YaHei";
              }
</style>
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
            <li><a href="admin.php"><i class="fa fa-home fa-fw"></i>主页</a></li>
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
                <li><a href=".\change_pwd.php?id=<?php echo $res[1]['id'];?>" class="active">修改密码</a></li>
                <li><a href="./backup.php">备份数据</a></li>
                <li><a href="javascript:window.parent.location.href='./login/login1.php'" >退出系统</a></li>
              </ul>  
            </nav> 
          </div>
        </div>
        <div class="templatemo-flex-row flex-content-row templatemo-overflow-hidden"> <!-- overflow hidden for iPad mini landscape view-->
            <div class="col-1 templatemo-overflow-hidden">
              <div class="templatemo-content-widget white-bg templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <div class="templatemo-flex-row flex-content-row">
                  
                  <div class="col-1 col-lg-6 col-md-12">
                       <div id="wrapper" class="login-page">
                        <div id="login_form" class="form">
                        <form class="login-form" action="pwd_update.php?id=<?php echo $_GET['id'];?>" method='post'>
                        <!-- Array ( [id] => 1 [admin] => mc [password] => ma15829702687 )  -->
                         <p>
                         <label for="">用户名：</label><input type="text" id="user_name" name='username' value="<?php echo $res['admin'];?>"/></p>
                         <p>
                         <label for="">原密码：</label><input type="text" id="password" name='password' value="<?php echo $res['password'];?>"/></p>
                         <p><label for="">新密码：</label><input type="password"  id="password" name='password_new1'/></p>
                         <p><label for="">确认密码：</label><input type="password" id="password" name='password_new2'/></p>
                         <input type='submit' name='submit' id="login" value='修 改' class='submit'>
                     </form>
                   </div>
                  </div>

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