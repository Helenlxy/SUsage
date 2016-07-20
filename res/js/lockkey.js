//禁止刷新
function lockf5(){
  if(event.keyCode == 116){
    event.keyCode=0;
    event.returnValue=false;
  }
}