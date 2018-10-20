	var demo0=document.getElementById("demo0");//大盒子
	var demo1=document.getElementById("demo1");//单元格
	var demo2=document.getElementById("demo2");//
	var demo=document.getElementById("demo");//
	demo2.innerHTML=demo1.innerHTML;//图片换为和上部分相同的
	var x=demo.scrollWidth-demo0.offsetWidth;//两部分图片总宽减去盒子的可见宽度
	function fun(){
		if(demo0.scrollLeft>=x)//第二部分图片走到底了就重新开始
		{
			demo0.scrollLeft=0;
		}else{
			demo0.scrollLeft++;
		}
	}
//鼠标移在图片上就停止
	var my=setInterval(fun,15);
	demo.onmouseover=function(){
		clearInterval(my);
	}
//鼠标移在图片外就开始
	demo.onmouseout=function(){
		my=setInterval(fun,15);
	}
