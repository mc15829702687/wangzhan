<?php 
	include_once "db.class.inc.php";//链接父类的库
	/**模块：首页     上一页     下一页     尾页    跳转下拉菜单
	  *【思路】
	  *1、链接父类的库
	  *2、初始化值     
	  *3、获取分页的当前页文件
	  *4、显示翻页的字符链接
	  *5、根据下拉选择的页码自动跳转到相应的页面
	  */
		  
	class Page extends db
	{
		public $records;	//总记录数
		public $pagecount;	//总页数
		public $table;		//表名
		public $pagesize;	//每页的记录数
		public $url;		//分页的PHP文件
		public $cur;
		public $offset;

		/**
		  *1、【功能】继承父类db,获得初始化的值
		  *	   para：$records     const   总记录数
		  *			 $pagecount   const   总页数
		  *          $table   	  string  表名
		  *			 $pagesize    const   每页的记录数
		  *			 $url         string  分页的PHP文件
		  *			 $cur    	  const   当前页
		  *	 return：void
		  *    date：2018.7.25
		  */
		public function __construct($table,$pagesize,$url)
		{
			// parent::__construct();
			$this->url =  $url;//PHP文件
			$this->table = $table;
			$this->pagesize = $pagesize;
			$arr = $this->getAllData($table);
			$this->records = count($arr);//计算总记录数
			$this->pagecount = ceil($this->records/$this->pagesize);//计算总页数

		}
		/**
		  *2、【功能】获取分页的当前页文件
		  *	   para：$_GET['page']   string    地址栏的url
		  *			 $cur    	  const     当前页
		  *	   return：void
		  *    date：2018.7.25
		  */
		
		public function  get_cur(){
			if(empty($_GET['page'])){
				$this->cur = 1;
			}else{
				$this->cur = $_GET['page'];
			}
		}

		/**
		  *3、【功能】根据当前页获取当前页数据
		  *	   para：
		  *			
		  *          $table   	  string    表名
		  *			 $pagesize    const     每页的记录数
		  *			 $cur    	  const     当前页
		  *	 return：$arr         array()   返回一个二维数组  
		  *    date：2018.7.25
		  */

		public function get_page_data(){
			$this->offset = ($this->cur-1)*$this->pagesize;
			$sql = "select * from $this->table order by id desc limit $this->offset,$this->pagesize";
			
			$arr = $this-> getSqlData($sql,MYSQL_ASSOC);
			return $arr;
		}
		/**
		  *4、【功能】显示翻页的字符链接
		  *	   para：$url         string    分页的PHP文件
		  *			 $pagecount   const     总页数
		  *          $table   	  string    表名
		  *			 $pagesize    const     每页的记录数
		  *			 $cur    	  const     当前页
		  *	 return：void
		  *    date：2018.7.25
		  */
		public function show_fenye(){
		  	if($this->cur==$this->pagecount)
		  	{
		
		 		echo "<td colspan='4'>
		 		<a href='$this->url'>首页</a>
		 		<a href='$this->url?page=",$this->cur-1,"'>上一页 </a>
		 		<a>下一页 </a>
		 		<a>尾页</a>
		 		
		 		</td>";
		
		
		}
		 	else if($this->cur==1)
		 	{
		  
		 		echo "<td colspan='4'>
		 		<a>首页</a>
		 		<a>上一页</a>
		 		<a href='$this->url?page=",$this->cur+1,"'>下一页 </a>
		 		<a href='$this->url?page=",$this->pagecount,"'>尾页</a>
		 		</td>";
		
		
		}
		 else {
			echo "
			<td colspan='4'>
		 		<a href='$this->url'>首页</a>
		 		<a href='$this->url?page=",$this->cur-1,"'>上一页 </a>
		 		<a href='$this->url?page=",$this->cur+1,"'>下一页 </a>
		 		<a href='$this->url?page=",$this->pagecount,"'>尾页</a>
		 		
		 		</td>";
		
		
		}
	}


		/**
		  *5、【功能】搜索分页
		  *	   para：$url         string    分页的PHP文件
		  *			 $pagecount   const     总页数
		  *          $table   	  string    表名
		  *			 $pagesize    const     每页的记录数
		  *			 $cur    	  const     当前页
		  *	 return：void
		  *    date：2018.7.25
		  */
		public function search_fenye($page1,$search){
		  	if($this->cur==$page1)
		  	{
		
		 		echo "<td colspan='4'>
		 		<a href='$this->url?search=$search'>首页</a>
		 		<a href='$this->url?page=",$this->cur-1,"&search=$search'>上一页 </a>
		 		<a>下一页 </a>
		 		<a>尾页</a>
		 		
		 		</td>";
		
		
		}
		 	else if($this->cur==1)
		 	{
		  
		 		echo "<td colspan='4'>
		 		<a>首页</a>
		 		<a>上一页</a>
		 		<a href='$this->url?page=",$this->cur+1,"&search=$search'>下一页 </a>
		 		<a href='$this->url?page=",$page1,"&search=$search'>尾页</a>
		 		</td>";
		
		
		}
		 else {
			echo "
			<td colspan='4'>
		 		<a href='$this->url?search=$search'>首页</a>
		 		<a href='$this->url?page=",$this->cur-1,"&search=$search'>上一页 </a>
		 		<a href='$this->url?page=",$this->cur+1,"&search=$search'>下一页 </a>
		 		<a href='$this->url?page=",$page1,"&search=$search'>尾页</a>
		 		
		 		</td>";
		}
	}




	/**
	  *【功能】：根据下拉选择的页码自动跳转到相应的页面
	  * para：   $page         string    分页的PHP文件
	  *			 $pagecount   const     总页数
	  *			 $cur    	  const     当前页
	  *	 return：void 
	  *    date：2018.7.25
	  *
	  **/
	public function jumppage($page)
	{
		echo "
		<form action='$page' method='get'>
		  		<select name='ds' id='' onchange='fun(this.value)'>";
		  		for($i=1;$i<=$this->pagecount;$i++)
		  		{	
		  			if($i==$this->cur) 
		  			{
		  		
		  			echo "
		  			<option value='$i' selected='selected'> $i</option>";
		  			}else
		  			{
		  		 	echo "<option value='$i'> $i</option>";
					} 
				 } 
		  		echo "</select>
		  	</form>";
	}

}

 ?>