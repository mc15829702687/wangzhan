function cancel(id,time)
{

	k = parseInt($('#message_text0 #s0').text())-1+'楼';
	k1 = parseInt($('#message_text1 #s1').text())-1+'楼';
	// alert(id);
	$.ajax({
		url:'sixth/cancel.php',
		type:'post',
		dataType:'json',
		data:{'id':id,'time':time},
		error:function(){
			alert('错误异常');
		},
		success:function(data,status){
			// alert(data);
			if(data=='1111')
			{
				alert('你的撤销时间已过！！');
			}else{
				
				if(data[0]['ask_type']==0)
				{
					$('#ask_type0').html("<strong style='color:red;'>技术问题：</strong>");
				}else if(data[0]['ask_type']==1){
					$('#ask_type0').html("<strong style='color:blue;'>咨询问题：</strong>");
				}else{
					$('#ask_type0').html("<strong style='color:yellow;'>生活问题：</strong>");
				}

				$('#s0').text(k);
			 	$('#message_text0 .left p img').attr('src',data[0]['photo']);
			 	$('#h0').text(data[0]['name']);
			 	$('#h20').text(data[0]['time']);
			 	$('#look0').html(replace_em(data[0]['content']));
			 	zhi = data[0]['id'];
			 	zhi1 = data[0]['zan'];
			 	
			 	$('#zan_show0').html("<span class='span2' onclick=zan("+zhi+")><img src='sixth/images/aixin.png'></span><span class='zan' id='"+zhi+"'><label id='label0'>"+zhi1+"</label></span>");
			 	
		
				if(data[1]['ask_type']==0)
				{
					$('#ask_type1').html("<strong style='color:red;'>技术问题：</strong>");
				}else if(data[1]['ask_type']==1){
					$('#ask_type1').html("<strong style='color:blue;'>咨询问题：</strong>");
				}else{
					$('#ask_type1').html("<strong style='color:yellow;'>生活问题：</strong>");
				}

				$('#s1').html(k1);
			 	$('#message_text1 .left p img').attr('src',data[1]['photo']);
			 	$('#h1').text(data[1]['name']);
			 	$('#h21').text(data[1]['time']);
			 	$('#look1').html(replace_em(data[1]['content']));
			 	$('#zan_show1').html("<span class='span2' onclick=zan("+data[1]['id']+")><img src='sixth/images/aixin.png'></span><span class='zan' id='"+data[1]['id']+"'><label id='label1'>"+data[1]['zan']+"</label></span>");
			 	
			}
		}
		
	});
}