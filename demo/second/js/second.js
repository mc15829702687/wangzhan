	
// ------------------	1、实现栏目下面的背景颜色变化	-------------------
	var show = document.getElementsByClassName('show');
	var xinxi = document.getElementsByClassName('xinxi');
	
	// alert(xinxi_img[0]);
	var lis1 = show[0].getElementsByTagName('li');
	var lis2 = show[1].getElementsByTagName('li');

	function change2(k){

		for(var j=0;j<lis2.length;j++)
		{
			lis2[j].className = '';
		}

		lis2[k].className = 'all';
	}
	for(var i=0;i<lis2.length;i++)
	{
		lis2[i].id = i;
		lis2[i].onclick = function(){
			change2(this.id);
			// show2(this.id);
		};
	}

	function change1(k){
		for(var j=0;j<lis1.length;j++)
		{
			lis1[j].className = '';
		}

		lis1[k].className = 'all';
	}

	for(var i=0;i<lis1.length;i++)
	{
		lis1[i].id = i;
		lis1[i].onclick = function(){
			change1(this.id);
			show1(this.id);
		};
	}

// 2、--------------------	2、ajax实现数据的取用  --------------------------
	function show1(j){
		
		 if(j==1)		//前端技术
		{
			$.ajax({
					url:'./second/php/show.php',
					type:'post',
					data:{lm1:'233',lm:'lm2'},
					dataType:'json',
					success:function(data){
					
					for(i=0;i<lis2.length;i++)
					{
						lis2[i].innerHTML='';
					}

					lis2[0].innerHTML='全部';
					lis2[1].innerHTML=data[0];
					lis2[2].innerHTML=data[24];
					lis2[3].innerHTML=data[30];
					lis2[4].innerHTML=data[33];
					lis2[5].innerHTML=data[36];
					lis2[6].innerHTML=data[48];
					
					
					for(i=0;i<26;i++)
					{
						$('.xinxi .img').eq(i).html('');
						$('.xinxi .title').eq(i).html('');
						$('.xinxi .nei_rong').eq(i).html('');
					}

			
					for(var i=1,j=0;i<data.length;i+=3,j++)
					{
							$('.xinxi a').eq(j).attr('href','xiangqing/second_xq.php?id='+data[i+1]);
							$('.xinxi .img').eq(j).html(data[i][0]);
							$('.xinxi .title').eq(j).html(data[i][1]);
							$('.xinxi .nei_rong').eq(j).html(data[i][2]);
					}
					$('.fenye').hide();
				}
				});
		}else{	//后端技术
			$.ajax({
					url:'./second/php/show.php',
					type:'post',
					data:{lm1:'234',lm:'lm2'},
					dataType:'json',
					success:function(data){
								// alert(1);
					for(i=0;i<lis2.length;i++)
					{
						lis2[i].innerHTML='';
					}

					lis2[0].innerHTML='全部';
					lis2[1].innerHTML=data[0];
					lis2[2].innerHTML=data[9];

					for(i=0;i<26;i++)
					{

						$('.xinxi .img').eq(i).html('');
						$('.xinxi .title').eq(i).html('');
						$('.xinxi .nei_rong').eq(i).html('');
					}

					
			
					for(var i=1,j=0;i<data.length;i+=3,j++)
					{
							$('.xinxi a').eq(j).attr('href','xiangqing/second_xq.php?id='+data[i+1]);
							$('.xinxi .img').eq(j).html(data[i][0]);
							$('.xinxi .title').eq(j).html(data[i][1]);
							$('.xinxi .nei_rong').eq(j).html(data[i][2]);							
					}	

					$('.fenye').hide();
				}
				});
		}
	}
