$(document).ready(function(){

	
	$('#message').hide();
	$('#trouble').hide();
	
	$('.work:eq(0)').mouseover(function(){
		$('#message').show();
		$('.work img:eq(0)').hide();
	});

	$('.work:eq(0)').mouseout(function(){
		$('#message').hide();
		$('.work img:eq(0)').show();
	});

	$('.work:eq(1)').mouseover(function(){
		$('#trouble').show();
		$('.work img:eq(1)').hide();
	});

	$('.work:eq(1)').mouseout(function(){
		$('#trouble').hide();
		$('.work img:eq(1)').show();
	});

	$('.work:eq(2)').mouseover(function(){
		$('#weixin_show').show();
	});

	$('.work:eq(2)').click(function(){
		$('#weixin_show').hide();
	});

});