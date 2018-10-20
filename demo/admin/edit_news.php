<?php 
  include_once 'db.class.inc.php';
  include_once 'page.class.inc.php';

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
  $res1 = $d->getAllData('admin',MYSQL_ASSOC);
  $page = new Page('news',8,'edit_news.php');

  $page->get_cur();
  $res = $page->get_page_data();


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
            <li><a href="add_news.php"><i class="fa fa-bar-chart fa-fw"></i>添加新闻</a></li>
            <li><a href="edit_news.php" class="active"><i class="fa fa-database fa-fw"></i>编辑新闻</a></li>
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
                <li><a href=".\change_pwd.php?id=<?php echo $res1[1]['id'];?>">修改密码</a></li>
                <li><a href="./backup.php">备份数据</a></li>
                <li><a href="javascript:window.parent.location.href='./login/login1.php'" >退出系统</a></li>
              </ul>  
            </nav> 
          </div>
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">

        <!-- +++++++++++++++++  信息显示  +++++++++++++++++++++ -->
              <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                  <tr>
                    <td><a href="" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">标题<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">栏目 <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">操作1 <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">操作2 <span class="caret"></span></a></td>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                    for($i=0;$i<count($res);$i++)
                    {
                  ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $res[$i]['title']; ?></td>
                    <?php 
                      
                      if(!empty($res[$i]['lm1'])&&empty($res[$i]['lm2'])&&empty($res[$i]['lm3']))
                      {
                        $sql1 = 'select lm1 from cms where id='.$res[$i]['lm1'];
                        $query1 = mysql_query($sql1);
                        $res1 = mysql_fetch_assoc($query1);
                        $zhi = $res1['lm1'];
                        echo "<td>$res1[lm1]</td>";
                      }else if(!empty($res[$i]['lm1'])&&!empty($res[$i]['lm2'])&&empty($res[$i]['lm3']))
                      {
                        $sql2 = 'select lm2 from cms where id='.$res[$i]['lm2'];
                        $query2 = mysql_query($sql2);
                        $res2 = mysql_fetch_assoc($query2);
                        $zhi = $res2['lm2'];
                        echo "<td>$res2[lm2]</td>";
                      }else{
                        $sql3 = 'select lm3 from cms where id='.$res[$i]['lm3'];
                        $query3 = mysql_query($sql3);
                        $res3 = mysql_fetch_assoc($query3);
                        $zhi =$res3['lm3'];
                        echo "<td>$res3[lm3]</td>";
                      }
                     ?>
                    
                    
                    <td><a href="admin_news_update.php?id=<?php echo $res[$i][id];?>&zhi=<?php echo $zhi;?>">【修改】</a></td>
                    <td><a href="admin_news_delete.php?id=<?php echo $res[$i][id];?>">【删除】</a></td>
                  </tr>

                  
                  <?php } ?>
                  <tr style='text-align: center;font-size: 15px;'>
                    <?php  $page->show_fenye();?>
                  </tr>

                </tbody>
              </table>    
            </div>                          
          </div>   
        </div>       
  </body>
</html>