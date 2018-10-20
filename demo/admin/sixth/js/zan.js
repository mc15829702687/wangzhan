

	function zan(i)
	{
		// alert(i);
		// alert(b);
		$.ajax({
			url:'sixth/zan.php',
			type:'POST',
			// data: {'id': i},
			data:{'id':i},
			error:function(){
				alert('存在错误');
			},
			success:function(data,status){
				// alert(data);
				if(data=='000')
				{
					alert('你已经点过赞了!');
				}else{
					$('#'+i).html(data);
				}
				
			}
		});

 
	}