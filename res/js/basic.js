var exitnotify = document.getElementById('toast-exit');
    function exit() { exitnotify.style.display = " block " ;
    }  
var exitcancel = document.getElementById('cancelexit');
	exitcancel.onclick = cancelexit;
	function cancelexit() { exitnotify.style.display = " none " ;
    } 
function backtop() { $("body").animate({scrollTop:0});}

