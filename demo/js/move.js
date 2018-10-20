$(document).ready(function(){

	// 1、小图标的移动

		for(var i=0;i<3;i++)
		{
			$('.course').eq(i).mouseenter(function(){
				$(this).animate({marginTop:'-10px'},300,'linear');
			});
			$('.course').eq(i).mouseleave(function(){
				$(this).animate({marginTop:'15px'},300,'linear');
			});
		}

	// 2、明星移动
	// (1)、
	$('.star li:eq(0)').mouseenter(function(){
		$(this).css('background','white');
		// 图片缩放
		$('.star_top img:eq(0)').animate({width:'70px',height:'70px',marginLeft:'10px',marginTop:'5px'},700);
		$('.star_nr:eq(0)').css('marginTop','40px');
		$('.star_middle:eq(0)').slideUp();
	});
	$('.star li:eq(0)').mouseleave(function(){
		$(this).css('background','#4D555D');
		// 图片缩放
		$('.star_top img:eq(0)').animate({width:'90px',height:'90px',marginLeft:'0px',marginTop:'0px'},700);
		$('.star_nr:eq(0)').css('marginTop','0px');
		$('.star_middle:eq(0)').slideDown();
	});

	// （2）、
	$('.star li:eq(1)').mouseenter(function(){
		$(this).css('background','white');
		// 图片缩放
		$('.star_top img:eq(1)').animate({width:'70px',height:'70px',marginLeft:'10px',marginTop:'5px'},700);
		$('.star_nr:eq(1)').css('marginTop','40px');
		$('.star_middle:eq(1)').slideUp();
	});
	$('.star li:eq(1)').mouseleave(function(){
		$(this).css('background','#4D555D');
		// 图片缩放
		$('.star_top img:eq(1)').animate({width:'90px',height:'90px',marginLeft:'0px',marginTop:'0px'},700);
		$('.star_nr:eq(1)').css('marginTop','0px');
		$('.star_middle:eq(1)').slideDown();
	});

	// （3）、
	$('.star li:eq(2)').mouseenter(function(){
		$(this).css('background','white');
		// 图片缩放
		$('.star_top img:eq(2)').animate({width:'70px',height:'70px',marginLeft:'10px',marginTop:'5px'},700);
		$('.star_nr:eq(2)').css('marginTop','40px');
		$('.star_middle:eq(2)').slideUp();
	});
	$('.star li:eq(2)').mouseleave(function(){
		$(this).css('background','#4D555D');
		// 图片缩放
		$('.star_top img:eq(2)').animate({width:'90px',height:'90px',marginLeft:'0px',marginTop:'0px'},700);
		$('.star_nr:eq(2)').css('marginTop','0px');
		$('.star_middle:eq(2)').slideDown();
	});

	// （4）、
	$('.star li:eq(3)').mouseenter(function(){
		$(this).css('background','white');
		// 图片缩放
		$('.star_top img:eq(3)').animate({width:'70px',height:'70px',marginLeft:'10px',marginTop:'5px'},700);
		$('.star_nr:eq(3)').css('marginTop','40px');
		$('.star_middle:eq(3)').slideUp();
	});
	$('.star li:eq(3)').mouseleave(function(){
		$(this).css('background','#4D555D');
		// 图片缩放
		$('.star_top img:eq(3)').animate({width:'90px',height:'90px',marginLeft:'0px',marginTop:'0px'},700);
		$('.star_nr:eq(3)').css('marginTop','0px');
		$('.star_middle:eq(3)').slideDown();
	});

	// （5）、
	$('.star li:eq(4)').mouseenter(function(){
		$(this).css('background','white');
		// 图片缩放
		$('.star_top img:eq(4)').animate({width:'70px',height:'70px',marginLeft:'10px',marginTop:'5px'},700);
		$('.star_nr:eq(4)').css('marginTop','40px');
		$('.star_middle:eq(4)').slideUp();
	});
	$('.star li:eq(4)').mouseleave(function(){
		$(this).css('background','#4D555D');
		// 图片缩放
		$('.star_top img:eq(4)').animate({width:'90px',height:'90px',marginLeft:'0px',marginTop:'0px'},700);
		$('.star_nr:eq(4)').css('marginTop','0px');
		$('.star_middle:eq(4)').slideDown();
	});
});