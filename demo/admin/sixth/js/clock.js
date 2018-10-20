 var dom=document.getElementById("clock");
	 var cxt=dom.getContext('2d');
	 var width=cxt.canvas.width;
	 var height=cxt.canvas.height;
	 var r=width/2;
	 var rem=width/200;
	 
	 //做背景
	 function drawbackground(){
		 cxt.save();
		 cxt.translate(r,r);
		 cxt.beginPath(); 
		 cxt.lineWidth=10*rem;
		 cxt.arc( 0, 0, r-cxt.lineWidth/2, 0, 2*Math.PI, false);
		 cxt.stroke();
		 
		 var hourNumbers=[3,4,5,6,7,8,9,10,11,12,1,2];
		 cxt.font=18*rem+'px Arial';
		 cxt.textAlign="center";
		 cxt.textBaseline="middle";
		 hourNumbers.forEach(function(number,i){
		 var rad=2*Math.PI/12*i;
		 var x=Math.cos(rad)*(r-30*rem);
		 var y=Math.sin(rad)*(r-30*rem);
		 cxt.fillText(number,x,y);	 
			});
		 
		 for(i=0;i<60;i++)
		 {
			var rad=2*Math.PI/60*i;
			var x=Math.cos(rad)*(r-18*rem);
			var y=Math.sin(rad)*(r-18*rem);
			cxt.beginPath();
			if(i%5===0)
			{
			cxt.fillStyle="#000";
			cxt.arc( x, y, 2*rem, 0 ,2*Math.PI,false);
			}
			else
			{
			cxt.fillStyle="#ccc";
			cxt.arc( x, y, 2*rem, 0 ,2*Math.PI,false);
			}
			cxt.fill();
		 }
		 }
		
	//做静态的时针，分针，秒针
		 function drawhour(hour,minute){
		  cxt.save();
		  var rad=2*Math.PI/12*hour;
		  var mrad=2*Math.PI/12/60*minute;
		  cxt.beginPath();
		  cxt.lineWidth=6*rem;
		  cxt.lineCap="round";
		  cxt.rotate(rad+mrad);
		  cxt.moveTo(0,10*rem);
		  cxt.lineTo(0,-r/2);
		  cxt.stroke(); 
		  cxt.restore();
		  }
		function drawminute(minute){
		  var rad=2*Math.PI/60*minute;
		  cxt.save();
		  cxt.beginPath();
		  cxt.lineWidth=3*rem;
		  cxt.lineCap="round";
		  cxt.rotate(rad);
		  cxt.moveTo(0,10*rem);
		  cxt.lineTo(0,-r+30*rem);
		  cxt.stroke();
		  cxt.restore();		
		}
		function drawsecond(second){
		  var rad=2*Math.PI/60*second;
		  cxt.fillStyle="red";
		  cxt.save();
		  cxt.beginPath();
		  cxt.rotate(rad);
		  cxt.moveTo(-2,20*rem);
		  cxt.lineTo(2,20*rem);
		  cxt.lineTo(1,-r+18*rem);
		  cxt.lineTo(-1,-r+18*rem);
		  cxt.fill();
		  cxt.restore();	
			}
		function drawdot(){
		  cxt.beginPath();
		  cxt.fillStyle="#fff";
		  cxt.arc( 0, 0, 3*rem, 0, 2*Math.PI, false);
		  cxt.fill();
			}
	 
	 
	  //动态钟表
	  function draw(){
		  cxt.clearRect(0,0,width,height);
		  var now=new Date();
		  var hour=now.getHours();
		  var minute=now.getMinutes();
		  var second=now.getSeconds();
		  drawbackground();
		  drawhour(hour,minute);
	      drawminute(minute);
	      drawsecond(second); 
		  drawdot();
		  cxt.restore();
		  }
	  draw();
	  setInterval(draw,1000);