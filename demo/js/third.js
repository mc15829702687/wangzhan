$(document).ready(function(){

	// 点击第一个按钮
	$('#qushi p:eq(0)').click(function(){
		$('#pic img:eq(0)').show();
		$('#pic img:eq(1)').hide();
		$('#pic img:eq(2)').hide();
	});

	// 点击第二个按钮
	$('#qushi p:eq(1)').click(function(){
		$('#pic img:eq(0)').hide();
		$('#pic img:eq(1)').show();
		$('#pic img:eq(2)').hide();
	});

	// 点击第三个按钮
	$('#qushi p:eq(2)').click(function(){
		$('#pic img:eq(0)').hide();
		$('#pic img:eq(1)').hide();
		$('#pic img:eq(2)').show();
	});

});