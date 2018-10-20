<?php 
  include_once 'db.class.inc.php';
  include_once 'page.class.inc.php';

  session_start();
  // if(empty($_SESSION['admin']))
  // {
  //  echo "  <script>
  //        alert('不能跳级');
  //        window.history.go(-1);
  //      </script>";
  //  exit;
  // }
  
  $d = new db('localhost','root','123456','houtailiuyan');
  $data = $d->getAllData('user_message',MYSQL_ASSOC);

  $d1 = new db('localhost','root','123456','newscms');
  $res1 = $d->getAllData('admin',MYSQL_ASSOC);


  // -----------------------搜索信息-----------------------------
    //  搜索表单传递的值
    // 翻页传递的值 
  
  $value=$_GET['search'];
  if(!empty($value))
  {
    $page = new Page('user_message',2,'liuyan.php');
    $page->get_cur();
    $sql1 = "select * from user_message where ask_type like '%$value%' or name like '%$value%' or qq like '%$value%' or time like '%$value%' or content like '%$value%'";

    $count=count($d->getSqlData($sql1,MYSQL_ASSOC));

    $page1 = ceil($count/$page->pagesize);
    $offset=($page->cur-1)*$page->pagesize;
    $sql = "select * from user_message where ask_type like '%$value%' or name like '%$value%' or qq like '%$value%' or time like '%$value%' or content like '%$value%' limit $offset,$page->pagesize";
    $res=$d->getSqlData($sql,MYSQL_ASSOC);
    
  }else{

    $page = new Page('user_message',2,'liuyan.php');
    $page->get_cur();
    $num = count($page->getAllData('user_message'));
    $res = $page->get_page_data();

    $count = $num;
    $offset = $page->offset;
  }


  // ask_type   name  qq  time  up  zan   secret  content
  //  --------------------插入信息---------------------------
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


    <link rel="stylesheet" href="sixth/message_houtai.css">

  <!-- $$$$$$$$$$$$$$$$$ QQ表情 $$$$$$$$$$$$$$$$$$$$$$ -->

    <link rel="stylesheet" href="sixth/css/qq.css">
    <script src="sixth/js/jquery.min.js"></script>

    <script type="text/javascript" src="http://static.runoob.com/assets/qrcode/qrcode.min.js"></script>

    <!-- ***************** 由qq号来获取头像 ************************ -->
    <script src="sixth/js/qq.js"></script>

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
                <li><a href="./liuyan.php" class='active'>管理留言</a></li>
                <li><a href=".\change_pwd.php?id=<?php echo $res1[1]['id'];?>">修改密码</a></li>
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
                       

  <!-- ******************留言内容显示********************* -->
  <article class="message_show">        
                <form action="" style='height:30px;' >
                  <input type="search" placeholder="点击搜索" name="search"
                    style='width:200px;margin-top:30px;margin-left:40%;'>
                  <input type="submit" value="搜索" style='margin-top:20px;' >
                </form>
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
          <p class="replay_name">管理员回复：
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
        <?php //if(!empty($_SESSION['admin'])){ ?> 
          <span class="huifu" onclick='huifu(<?php echo $res[$i]['id']?>)'>回复</span>
          
        <?php 
          
         ?>
         <!-- 输入[评论]内容 -->
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
      <?php }else{  ?>
      <li>第<?php echo $page->cur;?> 页/共 <?php echo $page1;?> 页</li>
      <?php } ?>
      <li>
      <?php
        if(empty($value))
           $page->show_fenye();
        else{
          // 23
           $page->search_fenye($page1,$value);
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

  <section class="huifu_show" style="margin-left:100px;margin-top:100px">
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
</div>
<!-- qq的JS -->
  <script type="text/javascript">
//查看结果
function replace_em(str){
      str = str.replace(/\</g,'&lt;');
      str = str.replace(/\>/g,'&gt;');
      str = str.replace(/\n/g,'<br/>');
      str = str.replace(/\[em_([0-9]*)\]/g,'<img src="sixth/arclist/$1.gif" border="0" />');

      return str;
}
</script>

  <script src="sixth/js/huifu.js"></script>   <!--撤销的JS代码-->
  <script src="sixth/js/zan.js"></script>     <!--点赞的JS代码-->
     
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