$(document).ready(function(){
    //根据设备屏幕高宽度自适应底层基本布局
    ChangeStyle();
    //倒计时
    window.setTimeout("CalculateTime()",0);
    window.setInterval("CalculateTime()",1000);
    //slice
    var time=5000;//预定义的切换时间
    ScreenSlice(time);
    //PC端 关注微信二维码
    $(".focus-wechat").mouseover(function(){
        $(".under-line").removeClass("hidden");
        $(this).css({
          "cursor":"pointer"
        });
    });
    $(".focus-wechat").mouseout(function(){
        $(".under-line").addClass("hidden");
    });
    //显示收起二维码
    ToggleQrcode();
    
    //识别Android与iPhone
    var ua=navigator.userAgent.toLowerCase();
    if(ua.indexOf("android")>-1){
      $(".download-btn").html('<img src="/img/android_icon_green.png" />Android版下载');
      // $(".download-btn img").attr("src","");
      //初始化按钮颜色
      $(".download-btn").css({
              "background":"transparent",
              "color":"#aacd06",
              "border-color":"#aacd06"
      });
      $(".download-btn").mouseover(function(){
          $(this).css({
              "background":"#aacd06",
              "color":"#fff"
          });
          $(".download-btn img").attr("src","/img/android_icon.png");
      });
      $(".download-btn").mouseout(function(){
          $(this).css({
              "background":"transparent",
              "color":"#aacd06"
          });
          $(".download-btn img").attr("src","/img/android_icon_green.png");
      });
    }
    else if(ua.indexOf("iphone")>-1) {
      $(".download-btn").mouseover(function(){
          $(this).css({
              "background":"#000",
              "color":"#fff"
          });
          $(".download-btn img").attr("src","/img/iphone_icon.png");
      });
      $(".download-btn").mouseout(function(){
          $(this).css({
              "background":"transparent",
              "color":"#000"
          });
          $(".download-btn img").attr("src","/img/iphone_icon_dark.png");
      });
    }
    //Mobile meet-site
    if(window.innerWidth<992) {
      $(".img-cover .site-words, .contact-list, .download-btn").removeClass("hidden");
    }
    if(window.innerWidth>992) {       
      $(".footer-navigator").removeClass("hidden");
    }
    //download-area
    $(".android").mouseover(function(){
        $(this).find("img").attr("src","/img/Android.png");
    });
    $(".android").mouseout(function(){
        $(this).find("img").attr("src","/img/Android_green.png");
    });
    $(".iphone").mouseover(function(){
        $(this).find("img").attr("src","/img/iPhone.png");
    });
    $(".iphone").mouseout(function(){
        $(this).find("img").attr("src","/img/iPhone_dark.png");
    });
    //底部links
    $(".contact-list a").mouseover(function(){
        $(this).find("li").css({
          "background":"#f6f6f6"
        });
    });
    $(".contact-list a").mouseout(function(){
        $(this).find("li").css({
          "background":"#fff"
        });
    });
    //screen vertical-align
    VerticalAlign();
});
function ChangeStyle(){
    var innerWidth=window.innerWidth;
    var innerHeight=window.innerHeight;
    var border_bottom=80/1366*innerWidth;
    $(".scr").height(innerHeight);
    $(".purple-after, .green-after, .lightgray-after, .white-after").css({
        "border-left":innerWidth+"px dashed transparent"
    });
    $(".purple-after").css({
        "border-bottom":border_bottom+"px solid rgba(34,219,194,1)" 
    })
    $(".green-after").css({
        "border-bottom":border_bottom+"px solid rgba(240,241,246,1)" 
    })
    $(".lightgray-after").css({
        "border-bottom":border_bottom+"px solid rgba(255,255,255,1)" 
    })
    $(".white-after").css({
        "border-bottom":border_bottom+"px solid rgba(255,255,255,1)" 
    })
}
function CalculateTime(){        
    var now,end,timestamp,year,month,date,hour,minute,second;
    //获取当前时间
    now=new Date();
    year=now.getFullYear();
    month=now.getMonth();
    date=now.getDate();
    //计时结束时间
    end=new Date(year,month,date+1,0,0,0);
    //倒计时毫秒数
    timestamp=parseInt((end.getTime()-now.getTime())/1000);
    //时
    hour=parseInt(timestamp/3600);
    //分
    minute=parseInt(timestamp/60)-60*hour;
    //秒
    second=timestamp%60;
    //统一时间格式
    hour=hour<10?"0"+hour:hour;
    minute=minute<10?"0"+minute:minute;
    second=second<10?"0"+second:second;
    //更改.hour,.minute,.second所属元素下的DOM结构
    $(".hour").html("<span>"+hour+"</span>");
    $(".minute").html("<span>"+minute+"</span>");
    $(".second").html("<span>"+second+"</span>");

    //对显示的秒数执行动画
    $(".second span").animate({"top":"2px"},133);
    $(".second span").animate({"top":"2px"},600);
   
    if($(".second span").text()=="00"){
      //对显示的分钟数执行动画
      $(".minute span").css({"top":"2px"}); 
      $(".minute span").animate({"top":"2px"},733);
      $(".minute span").animate({"top":"70px"},133);
      $(".minute span").css({"top":"-65px"}); 
      $(".minute span").animate({"top":"2px"},133);
      if($(".minute span").text()=="00"){
        //对显示的小时数执行动画
        $(".hour span").css({"top":"2px"}); 
        $(".hour span").animate({"top":"2px"},733);
        $(".hour span").animate({"top":"70px"},133);
        $(".hour span").css({"top":"-65px"});
        $(".hour span").animate({"top":"2px"},133);
      }
      else{
       $(".minute span, .hour span").css({"top":"2px"});
      }
    }
    else{
       $(".minute span, .hour span").css({"top":"2px"});
    }
    $(".second span").animate({"top":"70px"},133);
}
function ScreenSlice(time){
    var index=0;
    //预定义的背景色值
    var array=new Array("#ffa545","#b2d057","#24c9e1","#eb75a1","#9462c3","#ffd338");
    //slice
    window.setInterval(function(){
      var _this=$(".screen-area").eq(0);
      var _next=$(".screen-area").eq(1);
      $(_next).css({
          "background":array[index+1]
      });
      //动画结束后执行回调
      $(_this).animate({"marginTop":"-350px"},1000,function(){
        var screen_html=$(_this)[0].outerHTML;
        $(_this).remove();
        $(".screen-area:last").after(screen_html);
        $(".screen-area:last").css({"marginTop":"0"});
      });
      index++;
      if(index>=5){
          index=-1;
      }
    },time);
}
function ToggleQrcode(){
    $(".focus-wechat").click(function(){             
        if($(".logo-block").width()==1140) {
          $(".right-arrow").removeClass("hidden");
          $(".logo-block").animate({"width":"780px"},500).addClass("col-md-8");
          $(".qrcode-block").css({"display":"block"}).addClass("col-md-4"); 
          $(".qrcode-block").animate({"width":"390px","opacity":"1"},1000); 
        }
        else {
          $(".right-arrow").addClass("hidden");
          $(".logo-block").removeClass("col-md-8").animate({"width":"1170px"},500);   
          $(".qrcode-block").animate({"width":"0px","opacity":"0"},500); 
          $(".qrcode-block").removeClass("col-md-4").css({"display":"none"}); 
          
        }
    });
}
function VerticalAlign(){
    var screen=$(".scr .container .row");
    //获取每个container的高度
    var container_height=$(".scr .container").height();
    var border_bottom_width=parseInt($(".purple-after").css("border-bottom-width"));
    var count=0;
    $(screen).each(function(){
      count++;
      border_bottom_width=count==4?0:border_bottom_width;
      var margin_Top=(container_height-border_bottom_width)/2-($(this).height())/2;
      $(this).css({
        "margin-top":margin_Top+"px"
      });
    });
    //特殊block单独处理
    var green_border_bottom_width=parseInt($(".purple-after").css("border-bottom-width"));
    var conutdown_block_margin=(container_height-green_border_bottom_width-30)/2-($(".conutdown-block").height())/2;
    if(window.innerWidth>992){
      $(".conutdown-block").css({
        "margin-top":conutdown_block_margin+"px"
      });
      var row_margin_top=parseInt($(".scr .container .row:first").css("margin-top"));
      var qrcode_margin_top=(container_height-green_border_bottom_width)/2-($(".qrcode-block").height())/2-row_margin_top;
      $(".qrcode-block").css({
        "margin-top":qrcode_margin_top+"px"
      });
    }
    else {
      $(".phone-block").css({
        "margin-top":"30px"
      });
      $(".conutdown-block").css({
        "margin-top":"100px"
      });
    }    
}