function huifu(id){
	$('.huifu_show').show();

	$.ajax({
		url:'sixth/huifu.php',
		type:'post',
		data:{'id':id},
		dataType:'json',
		error:function(){
			alert('异常错误！！！');
		},
		success:function(data,status){
			// Array
			// (
			//     [id] => 85
			//     [ask_type] => 2
			//     [name] => 傻得
			//     [qq] => 2131231
			//     [time] => 2018-08-20 23:41:15
			//     [photo] => http://q1.qlogo.cn/g?b=qq&nk=2131231&s=100
			//     [zan] => 26
			//     [secret] => 0
			//     [content] => 奥德赛[em_8]
			//     [IP] => 
			// )
			// alert(data['name']);
			$('#user_replay_id').val(data['id']);
			$('.huifu_name').text(data['name']);

			if(data['ask_type']==0)
			{
				$('.huifu_question').html("<strong style='color:red;'>技术问题：</strong>");
			}else if(data['ask_type']==1){
				$('.huifu_question').html("<strong style='color:blue;'>咨询问题：</strong>");
			}else{
				$('.huifu_question').html("<strong style='color:yellow;'>生活问题：</strong>");
			}

			$('.huifu_content').html(replace_em(data['content']));
		}
	});

}