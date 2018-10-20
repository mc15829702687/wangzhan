

// 1、定义要输出的内容
var text = "互联网（英语：internet），又称网际网路或音译因特网、英特网，是网络与网络之间所串连成的庞大网络，这些网络以一组通用的协定相连，形成逻辑上的单一巨大国际网络。这种将计算机网络互相联接在一起的方法可称作“网络互联”，在这基础上发展出覆盖全世界的全球性互联网络称“互联网”，即是“互相连接一起的网络”。互联网并不等同万维网（World Wide Web），万维网只是一建基于超文本相互链接而成的全球性系统，且是互联网所能提供的服务其中之一。单独提起互联网，更多一般都是互联网或接入其中的某网络，有时将其简称为网或网络（the Net）可以通讯、社交、网上贸易。";

// 2、测出它的长度
var length = text.length;

// 3、定义起始截取长度
var i = 1;

function show(){
  document.getElementById("internet").innerHTML=text.substr(0,i);
  i++;

  if(i>length)
  {
    clearInterval('start');
  }                         
  }


var start = setInterval('show()',200);