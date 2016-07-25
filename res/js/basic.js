var exitnotify = document.getElementById('toast-exit');
function exit(){
  exitnotify.style.display = "block";
}
 
var exitcancel = document.getElementById('cancelexit');
exitcancel.onclick = cancelexit;
function cancelexit(){
  exitnotify.style.display = "none";
}

//返回顶部
function backtop(){
  $("body").animate({scrollTop:0});
}

//彩蛋--关于我们	
function easteregg(){
  if(event.altKey && event.shiftKey && event.keyCode == 71){
    window.location.href="about.html";
  }
}