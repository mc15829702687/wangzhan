$(function(){ 	
			$("#qq").keyup(function(){
					$.ajax({
						url:"sixth/message_ok.php",
						type:"get",	
						data:{name:$("#qq").val()},					
						error:function(){
							alert('加载失败');
						},
						success:function(data,status){
								
							$(".img img").attr('src',data);
						}
					});
				});



			// 

		});