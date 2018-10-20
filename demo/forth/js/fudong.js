
var className = 'tooltip-box';

    var isIE = navigator.userAgent.indexOf('MSIE') > -1;
    // 用JS代码判别IE浏览器
    
    function showTooltip(obj, id, html, width, height) {
        if (document.getElementById(id) == null) {

            var tooltipBox;
            tooltipBox = document.createElement('div');
            tooltipBox.className = className;
            tooltipBox.id = id;
            tooltipBox.innerHTML = html;

            obj.appendChild(tooltipBox);

            tooltipBox.style.width = width ? width + 'px' : 'auto';
            tooltipBox.style.height = height ? height + 'px' : 'auto';

            if (!width && isIE) {
                tooltipBox.style.width = tooltipBox.offsetWidth;
            }

            tooltipBox.style.position = "absolute";
            tooltipBox.style.display = "block";

            var left = obj.offsetLeft+20;
            var top = obj.offsetTop + 20;

            if (left + tooltipBox.offsetWidth > document.body.clientWidth) {
                var demoLeft = document.getElementById("fudong1").offsetLeft;
                left = document.body.clientWidth - tooltipBox.offsetWidth - demoLeft;
                if (left < 0) left = 0;
            }

            tooltipBox.style.left = left+ 'px';
            tooltipBox.style.top = top+ 'px';

            obj.onmouseleave = function () {
                setTimeout(function () {
                    document.getElementById(id).style.display = "none";
                }, 100);
            };

        } else {
            document.getElementById(id).style.display = "block";
        }
    }

    var t1 = document.getElementById("tooltip1");
    var t2 = document.getElementById("tooltip2");
    var t3 = document.getElementById("tooltip3");
    var t4 = document.getElementById("tooltip4");
    var t5 = document.getElementById("tooltip5");
    var t6 = document.getElementById("tooltip6");
    
    t1.onmouseenter = function () {
        var _html = '<div id="fudong"><div><li class="jiantou"></li><li class="jiantou"></li><li class="jiantou"></li></div><p id="fudong_top"><strong>深圳汇创五谷网络科技有限公司</strong></p><div class="fudong_left"><div class="fudong_hr"></div><p><span>企业认证：</span>  诚信等级</p><p><span>薪资待遇：</span> 5000-8000元</p><p><span>工作地点：</span>高新-科技二路</p><div class="fudong_hr"></div></div><div class="fudong_left"><div class="fudong_hr"></div><p><span>工作经验：</span>3-5年</p><p><span>最低学历：</span>本科招聘人数：5人</p><p><span>公司规模：</span>100-499人</p><div class="fudong_hr"></div></div><div id="fudong_bottom"><p>岗位职责：负责商城网站的开发和运营，APP软件的研发维护管理工作</p><p>任职资格:</p><p>工作时间:</p></div></div>  ';
        showTooltip(this, "t1", _html, 550);
    };
    t2.onmouseenter = function () {
        var _html = '<div id="fudong"><div><li class="jiantou"></li><li class="jiantou"></li><li class="jiantou"></li></div><p id="fudong_top"><strong>深圳汇创五谷网络科技有限公司</strong></p><div class="fudong_left"><div class="fudong_hr"></div><p><span>企业认证：</span>  诚信等级</p><p><span>薪资待遇：</span> 5000-8000元</p><p><span>工作地点：</span>高新-科技二路</p><div class="fudong_hr"></div></div><div class="fudong_left"><div class="fudong_hr"></div><p><span>工作经验：</span>3-5年</p><p><span>最低学历：</span>本科招聘人数：5人</p><p><span>公司规模：</span>100-499人</p><div class="fudong_hr"></div></div><div id="fudong_bottom"><p>岗位职责：负责商城网站的开发和运营，APP软件的研发维护管理工作</p><p>任职资格:</p><p>工作时间:</p></div></div>  ';
        showTooltip(this, "t2", _html, 550);
    };
    t3.onmouseenter = function () {
        var _html = '<div id="fudong"><div><li class="jiantou"></li><li class="jiantou"></li><li class="jiantou"></li></div><p id="fudong_top"><strong>深圳汇创五谷网络科技有限公司</strong></p><div class="fudong_left"><div class="fudong_hr"></div><p><span>企业认证：</span>  诚信等级</p><p><span>薪资待遇：</span> 5000-8000元</p><p><span>工作地点：</span>高新-科技二路</p><div class="fudong_hr"></div></div><div class="fudong_left"><div class="fudong_hr"></div><p><span>工作经验：</span>3-5年</p><p><span>最低学历：</span>本科招聘人数：5人</p><p><span>公司规模：</span>100-499人</p><div class="fudong_hr"></div></div><div id="fudong_bottom"><p>岗位职责：负责商城网站的开发和运营，APP软件的研发维护管理工作</p><p>任职资格:</p><p>工作时间:</p></div></div>  ';
        showTooltip(this, "t3", _html, 550);
    };
    t4.onmouseenter = function () {
        var _html = '<div id="fudong"><div><li class="jiantou"></li><li class="jiantou"></li><li class="jiantou"></li></div><p id="fudong_top"><strong>深圳汇创五谷网络科技有限公司</strong></p><div class="fudong_left"><div class="fudong_hr"></div><p><span>企业认证：</span>  诚信等级</p><p><span>薪资待遇：</span> 5000-8000元</p><p><span>工作地点：</span>高新-科技二路</p><div class="fudong_hr"></div></div><div class="fudong_left"><div class="fudong_hr"></div><p><span>工作经验：</span>3-5年</p><p><span>最低学历：</span>本科招聘人数：5人</p><p><span>公司规模：</span>100-499人</p><div class="fudong_hr"></div></div><div id="fudong_bottom"><p>岗位职责：负责商城网站的开发和运营，APP软件的研发维护管理工作</p><p>任职资格:</p><p>工作时间:</p></div></div>  ';
        showTooltip(this, "t4", _html, 550);
    };
    t5.onmouseenter = function () {
        var _html = '<div id="fudong"><div><li class="jiantou"></li><li class="jiantou"></li><li class="jiantou"></li></div><p id="fudong_top"><strong>深圳汇创五谷网络科技有限公司</strong></p><div class="fudong_left"><div class="fudong_hr"></div><p><span>企业认证：</span>  诚信等级</p><p><span>薪资待遇：</span> 5000-8000元</p><p><span>工作地点：</span>高新-科技二路</p><div class="fudong_hr"></div></div><div class="fudong_left"><div class="fudong_hr"></div><p><span>工作经验：</span>3-5年</p><p><span>最低学历：</span>本科招聘人数：5人</p><p><span>公司规模：</span>100-499人</p><div class="fudong_hr"></div></div><div id="fudong_bottom"><p>岗位职责：负责商城网站的开发和运营，APP软件的研发维护管理工作</p><p>任职资格:</p><p>工作时间:</p></div></div>  ';
        showTooltip(this, "t5", _html, 550);
    };
    t6.onmouseenter = function () {
        var _html = '<div id="fudong"><div><li class="jiantou"></li><li class="jiantou"></li><li class="jiantou"></li></div><p id="fudong_top"><strong>深圳汇创五谷网络科技有限公司</strong></p><div class="fudong_left"><div class="fudong_hr"></div><p><span>企业认证：</span>  诚信等级</p><p><span>薪资待遇：</span> 5000-8000元</p><p><span>工作地点：</span>高新-科技二路</p><div class="fudong_hr"></div></div><div class="fudong_left"><div class="fudong_hr"></div><p><span>工作经验：</span>3-5年</p><p><span>最低学历：</span>本科招聘人数：5人</p><p><span>公司规模：</span>100-499人</p><div class="fudong_hr"></div></div><div id="fudong_bottom"><p>岗位职责：负责商城网站的开发和运营，APP软件的研发维护管理工作</p><p>任职资格:</p><p>工作时间:</p></div></div>  ';
        showTooltip(this, "t6", _html, 550);
    };
