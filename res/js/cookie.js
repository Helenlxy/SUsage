/*
* ------------------------------------
* getCookie 读取cookie
* ------------------------------------
* name 需要读取内容的Cookie名称
* ------------------------------------
*/
function getCookie(name){
  var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
  if(arr=document.cookie.match(reg)){
    return unescape(arr[2]);
  }else{
    return null;
  }
}


/*
* ------------------------------------
* delCookie 删除Cookie
* ------------------------------------
* name 将要删除的Cookie名称
* ------------------------------------
*/
function delCookie(name){
  var exp = new Date();
  exp.setTime(exp.getTime()-1);
  var cval=getCookie(name);
  if(cval!=null){
    document.cookie= name + "="+cval+";expires="+exp.toGMTString();
  }
}


/*
* ------------------------------------
* setCookie 设置新的Cookie
* ------------------------------------
* name  Cookie名称
* value Cookie值
* time  Cookie失效时间值(数字)(留空则为7)
* unit  Cookie失效时间单位(留空则为d)
* ------------------------------------
* unit 可选内容：d/h/m/s(天,时,分,秒)
* ------------------------------------
*/
function setCookie(name,value,time="7",unit="d"){
  var strsec = getsec(unit,time);
  var exp = new Date();
  value = escape(value);
  exp.setTime(exp.getTime()+strsec*1);
  document.cookie = name+"="+value+";expires="+exp.toGMTString();
}


function getsec(unit,num){
  switch(unit){
    case "s"://秒
      time=num*1000;
      break;
    case "m"://分
      time=num*60*1000;
      break;
    case "h"://时
      time=num*60*60*1000;
      break;
    case "d"://天
      time=num*24*60*60*1000;
      break;
  }
  return time;
}