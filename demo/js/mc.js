
  // 第一个功能导航栏功能 
$(function(){
	$(".touch").click(function(){
		if($(".touch").val()=="三"){
			$(".touch").val("×");
			$(".one").css("opacity","0.8");

		}else{
			$(".touch").val("三");
			$(".one").css("opacity","1");

		}
		$("#show").slideToggle("slow");
		// $(".one").css("background","rgba(0,0,0,0.1)");
		
	})
         
        

		
})
