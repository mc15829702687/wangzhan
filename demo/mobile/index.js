 window.onload=function(){
         /*变为手机端*/
        (function(win) {
    var doc = win.document;
    var docEl = doc.documentElement;
    var tid;

    function refreshRem() {
        var width = docEl.getBoundingClientRect().width;
        if (width > 540) { // 最大宽度
            width = 540;
        }
        var rem = width / 7.5; // 将屏幕宽度分成10份， 1份为1rem
        docEl.style.fontSize = rem + 'px';
    }
win.addEventListener('resize', function() {
        clearTimeout(tid);
        tid = setTimeout(refreshRem, 300);
    }, false);
    win.addEventListener('pageshow', function(e) {
        if (e.persisted) {
            clearTimeout(tid);
            tid = setTimeout(refreshRem, 300);
        }
    }, false);

    refreshRem();

})(window);
 	/*大图轮播*/
        var wrap=document.getElementById("demo");
        var inner=document.getElementById("demo1");
        //var spanList=document.getElementById("anniu").getElementsByTagName("span");
        var left=document.getElementById("left");
        var right=document.getElementById("right");

        var clickFlag=true;//设置左右切换标记位防止连续按
        var time//主要用来设置自动滑动的计时器
        var index=0;//记录每次滑动图片的下标
        var Distance=wrap.offsetWidth;//获取展示区的宽度，即每张图片的宽度
        //定义图片滑动的函数
        if(wrap!=null)
        {
        function AutoGo(){
            var start=inner.offsetLeft;//获取移动块当前的left的开始坐标

            var end=index*Distance*(-1);//获取移动块移动结束的坐标。
            //计算公式即当移动到第三张图片时，图片下标为2乘以图片的宽度就是块的left值。
            var change=end-start;//偏移量

            var timer;//用计时器为图片添加动画效果
            var t=0;
            var maxT=30;
            //clear();//先把按钮状态清除,再让对应按钮改变状态
            /*if(index==spanList.length){
                spanList[0].className="bg";
            }else{
                spanList[index].className="bg";
            }*/
            clearInterval(timer);//开启计时器前先把之前的清
            timer=setInterval(function(){
                t++;
                if(t>=maxT){//当图片到达终点停止计时器
                    clearInterval(timer);
                    clickFlag=true;//当图片到达终点才能切换
                }
                //         偏移量/30*t+ 开始坐标
        inner.style.left=change/maxT*t+start+"px";//每个17毫秒让块移动
                if(index==5&&t>=maxT){
                    inner.style.left=0;
                    index=0;
                    //当图片到最后一张时把它瞬间切换回第一张，由于都同一张图片不会影响效果
                }
            },17);
        }
        //编写图片向右滑动的函数
        function forward(){
            index++;
            //当图片下标到最后一张把小标换0
            /*if(index>spanList.length){
                index=0;
            }*/
            AutoGo();
        }
        //编写图片向左滑动函数
        function backward(){
            index--;
            //当图片下标到第一张让它返回到倒数第二张，
            //left值要变到最后一张才不影响过渡效果
            if(index<0){
                //index=spanList.length-1;
                inner.style.left=(index+1)*Distance*(-1)+"px";
            }
            AutoGo();
        }

        //开启图片自动向右滑动的计时器
        time=setInterval(forward,3000);

        //设置鼠标悬停动画停止
        wrap.onmouseover=function(){
            clearInterval(time);
        }
        wrap.onmouseout=function(){
        time=setInterval(forward,3000); 
        }

        //遍历每个按钮让其切换到对应图片
        /*for(var i=0;i<spanList.length;i++){
            spanList[i].onclick=function(){
                index=this.innerText-1;
                AutoGo();
            }
        }*/

        //左切换事件
        if(left!=null)
        left.onclick=function(){
            if(clickFlag){
                backward();
            }
            clickFlag=false;
        }
        //右切换事件
         if(right!=null)
        right.onclick=function(){
            if(clickFlag){
                forward();
            }
            clickFlag=false;
        }
    }
        //清除页面所有按钮状态颜色
        /*function clear(){
            for(var i=0;i<spanList.length;i++){
                spanList[i].className="";
            }
        }*/

    /*单击字体实现图片转换*/
	$(".first").click(function(){
		$(".first").css({"color":"red"});
		$(".second").css({"color":"black"});
    	$(".third").css({"color":"black"});
    	$("#news1").show();
    	$("#news2").hide();
    	$("#news3").hide();
    });
    $(".second").click(function(){
    	$(".first").css({"color":"black"});
    	$(".second").css({"color":"red"});
    	$(".third").css({"color":"black"});
    	$("#news1").hide();
    	$("#news2").show();
    	$("#news3").hide();
    });
    $(".third").click(function(){
    	$(".third").css({"color":"black"});
    	$(".second").css({"color":"black"});
    	$(".third").css({"color":"red"});
    	$("#news1").hide();
    	$("#news2").hide();
    	$("#news3").show();
    });
    
 }
