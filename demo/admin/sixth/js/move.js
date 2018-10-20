	
	// 1、文本无缝移动

	var box = document.getElementById('show1');
	var con1 = document.getElementById('ask1');
	var con2 = document.getElementById('ask2');

	con2.innerHTML = con1.innerHTML;

	function move()
	{
		if(box.scrollTop >= con2.offsetHeight)
		{	
			box.style.marginTop=90;
			box.scrollTop = 0;
	
		}else{
			box.scrollTop++;
		}
	}

		var time = setInterval('move()',50);

		box.onmouseover = function(){
			clearInterval(time);
		}

		box.onmouseout = function(){
			time = setInterval('move()',50);
		}

	// 2、文本有缝移动

	var box2 = document.getElementById('show2');
	var con3 = document.getElementById('ask3');
	var con4 = document.getElementById('ask4');

	con4.innerHTML = con3.innerHTML;

	function move2()
	{
		if(box2.scrollTop >= con4.offsetHeight)
		{	
			box2.style.marginTop=90;
			box2.scrollTop = 0;
	
		}else{
			box2.scrollTop++;
		}
	}

		var time2 = setInterval('move2()',50);

		box2.onmouseover = function(){
			clearInterval(time2);
		}

		box2.onmouseout = function(){
			time2 = setInterval('move2()',50);
		}

