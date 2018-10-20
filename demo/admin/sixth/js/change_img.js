$(document).ready(function(){

	// 遍历每个下拉按钮，会出现图片转换（图片必须名字必须为相连的数字）
	// $('option').each(function(index,obj){
	// 		$(obj).click(function(){
	// 			$(".im").attr('src','sixth/images/'+index+'.jpg');
	// 		});
	// });

	$('option:eq(0)').change(function(){
		$('.img img').attr('src','sixth/images/2.jpg');
	});

	$('option:eq(1)').click(function(){
		$('.img img').attr('src','sixth/images/demo.jpg');
	});

	$('option:eq(2)').click(function(){
		$('.img img').attr('src','sixth/images/chess.jpg');
	});

	$('option:eq(3)').click(function(){
		$('.img img').attr('src','sixth/images/hello.jpg');
	});

	$('option:eq(4)').click(function(){
		$('.img img').attr('src','sixth/images/message.jpg');
	});
	
});