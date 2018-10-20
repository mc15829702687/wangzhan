window.onload = function(){
	
	// 1、获取存放图片的大盒子的id
	var demo = document.getElementById('lunbo');

	//2、获取移动的盒子的id
	var inner = document.getElementById('inner');

	//3、获取按钮的内容，放进数组中
	var btn = document.getElementById('btn').getElementsByTagName('span');

	//4、获取左、右按钮的id值
	var left = document.getElementById('left');
	var right = document.getElementById('right');
	//5、获取盒子的可视宽度
	var	distance = demo.offsetWidth;

	var time;		//设置一个自动开始轮播的变量
	var index = 0;	//设置图片下标
	var clickTag = true;
	//自动轮播的函数
	function Autogo(){

		var start = inner.offsetLeft;	//获取当前移动框的左边位置
		var end = index*distance*(-1);	//图片末尾的坐标
		var change = end-start;			//首尾之间的距离

		var timer;	//设置存放图片大盒子开始跑动的变量
		var max=30;	//设置图片分为30份
		var t=0;	//图片分为30份，设置才开始的份数

		clear();	//清除按钮的背景色

		//判断图片下标有没有超过范围
		if(index==btn.length)
		{
			btn[0].className = 'ok';
		}else{
			btn[index].className = 'ok';
		}

		//清除图片跑动函数
		clearInterval(timer);

		//设置图片开始跑动，每17毫秒
		timer = setInterval(function(){
			t++;

			//当超过一张图片范围，立即结束盒子移动
			if(t>=max)
			{
				clearInterval(timer);
				clickTag = true; //图片从头开始，可以单击左右按键
			}

			//装图片盒子左边的坐标
			inner.style.left = change/max*t+start+'px';

			if(index==btn.length && t>=max)
			{
				inner.style.left = 0;
				index = 0;
			}

		},17);
	}
	//图片向右变化的函数
	function forward(){
		index++;
		if(index>btn.length)
		{
			index = 0;
		}
		Autogo();
	}
	//图片向左变化的函数
	function backward(){
		index--;
		if(index<0)
		{
			index = btn.length-1;
			inner.style.left = (index+1)*distance*(-1)+'px';
		}
		Autogo();
	}

	time = setInterval(forward,3000);//自动向右轮播

	//设置鼠标悬停事件
	demo.onmouseover=function(){
		clearInterval(time);
	}
	demo.onmouseout=function(){
		time = setInterval(forward,3000);
	}

	//单击下边的按钮会跳回到相应的页面
	for(var i=0;i<btn.length;i++)
	{
		(function(i){
		btn[i].onclick = function(){
			index = i;
			Autogo();
		}
	})(i);
	}
	// 左切换事件
	left.onclick = function(){
		if(clickTag){
			backward();
		}
		clickTag = false;
	}
	// 右切换事件
	right.onclick = function(){
		if(clickTag)
		{
			forward();
		}
		clickTag = false;
	}


	//清除按钮的背景色
	function clear(){
		for(var i=0;i<btn.length;i++)
		{
			btn[i].className = '';
		}
	}
}