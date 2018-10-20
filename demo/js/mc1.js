var tu=document.getElementsByClassName('datu')[0];
var one=document.getElementsByClassName('one')[0]; 
    var an=document.getElementsByClassName("an")[0];
    var yuan=an.getElementsByTagName("p");
     var width=one.offsetWidth;
     var datuwidth=tu.offsetWidth;
         var a=0;
         var c;
         var x=0;
      

      // window.onresize=function(){
      //    var c=document.documentElement.clientWidth;
      //    alert(c);

      // }
      var timer=setInterval(function(){
      
              $(function(){
                $(tu).animate({

                            "left":-100*a+"%"
              
                        },300)
                  
              });
	      // tu.style.left=parseInt(window.getComputedStyle(tu,null).left)+(-x)+"px";
        var w=(parseInt(tu.style.left))*(-1);
        if(w>=parseInt(datuwidth)){
          tu.style.left="0px"
        }
       
      
        x+=10;
      
     
      if(x>=width){
        x=0;
      }
      tu.style.left=parseInt(window.getComputedStyle(tu,null).left)+(-width)+"px";
     
	     for(var i=0;i<3;i++){
         	yuan[i].className="";
         }
          c=a;
          if(c<3){
	     yuan[c].className="yan";
          }
	      a++;
         if(a==3){
               tu.style.left="auto";
               a=0;
             }
          
        
},3000);