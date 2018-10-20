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
            <li><a href="edit_lm.php" class="active"><i class="fa fa-home fa-fw"></i>编辑栏目</a></li>
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
              </ul>  
            </nav> 
          </div>
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">

    <!--+++++++++++++++++++++ 添加，修改，删除信息 ++++++++++++++++++++-->
              <form action="admin_add_lm.php" method="get">
                <input type="text" name="lm1" value="">
                <input type="submit" value="Add">  
              </form>
              <?php if(!empty($_GET['lm'])) {?>
              <form action="admin_add_lm2.php" method="get">
                父栏目名字：<?php echo $_GET['lm'];?>

              <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
              <input type="hidden" name="grade" value="<?php echo $_GET['grade'];?>">
                <input type="text" name="lm2" value="">
                <input type="submit" value="Add">
                <a href="edit_lm.php">cancel</a>  
              </form>
              <?php } ?>

              <?php if(!empty($_GET['update'])) {?>
              <!-- ****************   修改  **************************** -->
              <form action="admin_edit_lm.php" method="get" style='margin:0 auto;width:200px;'>
                    修改的名字：<?php echo $_GET['update'];?>

                  <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                  <input type="hidden" name="grade" value="<?php echo $_GET['grade'];?>">

                    <input type="text" name="updatename" value="">
                    <input type="submit" value="update">
                    <a href="edit_lm.php">cancel</a>  
                  </form>
                
              </form>
          <?php } ?>
          
          <?php if(!empty($_GET['delete'])) {?>
          <!-- ****************   删除  **************************** -->
          <form action="admin_delete_lm.php" method="get" style='margin:0 auto;width:200px;'>
                删除的名字：<?php echo $_GET['delete'];?>
              <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
              <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
              <input type="hidden" name="grade" value="<?php echo $_GET['grade'];?>">
              <br/>
              <input type="submit" value="Dlete">
              <a href="edit_lm.php">cancel</a>  
              </form>
            
          </form>
        <?php } ?>

        <!-- +++++++++++++++++  信息显示  +++++++++++++++++++++ -->
              <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                  <tr>
                    <td><a href="" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">First Name <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Second Name <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Third Name <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">add <span class="caret"></span></a></td>
                    <td>Edit</td>
                    <td>Delete</td>
                  </tr>
                </thead>
                <tbody>

                <?php 
    // 1、显示一级栏目
              $sql1 = "select id,lm1 from cms where lm1 !=''";
              $query1 = mysql_query($sql1);
              $i=1;
              while($res1 = mysql_fetch_assoc($query1))
              {
                echo '<tr><td>'.$i++.'</td><td>'.$res1['lm1']."</td><td></td><td></td>
                  <td>
                    <a href='edit_lm.php?grade=lm2&lm=$res1[lm1]&id=$res1[id]'>【增加二级】($res1[id]|lm1)</a>
                  </td>
                  <td>
                    <a href='edit_lm.php?grade=lm1&update=$res1[lm1]&id=$res1[id]' class='templatemo-edit-btn'>Edit</a>
                  </td>

                  <td>
                    <a href='edit_lm.php?grade=lm1&delete=$res1[lm1]&id=$res1[id]' class='templatemo-link'>Delete</a>
                  </td></tr>";

                // 2、显示2级栏目
                $sql2 = 'select id,lm2 from cms where lmid='.$res1['id'];
                $query2 = mysql_query($sql2);
                while($res2 = mysql_fetch_assoc($query2))
                {
                  echo '<tr><td></td><td></td><td>'.$res2['lm2']."</td><td></td>
                    <td>
                      <a href='edit_lm.php?grade=lm3&lm=$res2[lm2]&id=$res2[id]'>【增加三级】($res2[id]|lm2)</a>
                    </td>

                    <td>
                      <a href='edit_lm.php?grade=lm2&update=$res2[lm2]&id=$res2[id]' class='templatemo-edit-btn'>Edit</a>
                    </td>

                    <td>
                      <a href='edit_lm.php?grade=lm2&delete=$res2[lm2]&id=$res2[id]' class='templatemo-link'>Delete</a>
                    </td></tr>";
                  
                  $sql3 = 'select id,lm3 from cms where lmid='.$res2['id'];
                  $query3 = mysql_query($sql3);
                  while($res3 = mysql_fetch_assoc($query3))
                  {
                    echo '<tr><td></td><td></td><td></td><td>'.$res3['lm3']."</td>
                      <td>($res3[id]|lm3)</td>
                      <td>
                        <a href='edit_lm.php?grade=lm3&update=$res3[lm3]&id=$res3[id]' class='templatemo-edit-btn'>Edit</a>
                      </td>
                      <td>
                      <a href='edit_lm.php?grade=lm3&delete=$res3[lm3]&id=$res3[id]' class='templatemo-link'>Delete</a>
                      </td></tr>";
                  }
                }

              }
              ?>              
    
                </tbody>
              </table>    
            </div>                          
          </div>   
        </div>       
  </body>
</html>