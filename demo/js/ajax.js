
	$(document).ready(function(){
		alert(1);
		function w(){
		$.ajax({
		url:'datu.php',
		type:'post',
		data:{'id':'215'},
		dataType:'json',
		success:function(data){
			alert(data);
		}});}
		w();
		
	});