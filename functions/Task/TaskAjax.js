function PublishTask(ct,dep){
$.ajax({
  url:"../functions/Task/toPublishTask.php",
  type:"POST",
  data:{ct:ct,dep:dep},
  error:function(e){
    alert("电波故障……发布任务失败！"+eval(e));
  },
  success:function(g){
    alert("发布任务成功！");
    history.go(0);
  }
});
}

function DeleteTask(Tid){
$.ajax({
  url:"../functions/Task/toDeleteTask.php",
  type:"POST",
  data:{Taskid:Tid},
  error:function(e){
    alert("任务删除失败！"+eval(e));
  },
  success:function(got){
    if(got=="9"){
      alert("你不想说话，并成功把一只任务扔进了垃圾桶！");
      history.go(0);
    }else if(got=="1"){
      alert("删除任务也要按照基本法\n\n很抱歉，非任务发布人无法删除任务");
    }else if(got=="0"){
      alert("电波故障……数据传输失败！");
    }else if(got=="2"){
      alert("电波故障……任务数据删除失败！");
    }else if(got=="3"){
      alert("电波故障……任务完成数据删除失败！");
    }else{
      alert("电波故障……未知错误码："+got);
    }
  }
});  
}

function CompleteTask(Tid){
$.ajax({
  url:"../functions/Task/toCompleteTask.php",
  type:"POST",
  data:{Taskid:Tid},
  error:function(e){
    alert("电波故障……任务完成失败！"+eval(e));
  },
  success:function(got){
    if(got=="9"){
      alert("电波故障……数据传输失败！");
    }else if(got=="1"){
      alert("任务完成了，干得漂亮！\n\n奖励你一根棒棒糖【其实并没有");
      history.go(0);
    }else if(got=="2"){
      alert("电波不见了……网络连接失败！");
    }else{
      alert("电波故障……未知错误码："+got);
    }
  }
}); 
}

function GetWhoFinished(Taskid){
 $.ajax({
  url:"../functions/Task/toGetWhoFinished.php",
  type:"post",
  dataType:"json",
  data:{Tid:Taskid},
  error:function(e){alert("OMG"+eval(e));},
  success:function(got){
   show = "";peoplenum = 0;
   for(i in got){
    //i->第几条
    for(j in got[i]){
     //j->字段名
     if(j==="HeadimgURL"){
      show += '<div class="card fnspeople"><img class="fnsimg" src="'+got[i][j];
     }else if(j==="TrueName"){
      show += '"/><span class="fnsname">'+got[i][j]+'</span></div>';
     }else{
      show += got[i][j];
     }
    }
    peoplenum ++;
   }
   document.getElementById("Showing").innerHTML = show;
   document.getElementById("PeopleNum").innerHTML = "共 "+peoplenum+" 人完成了此任务";
   $("#whofinished").removeClass("modhide");
   $("#whofinished").addClass("moddisplay");
   $("#whofinished").addClass("animate fadeInDown");
   $("#panel").addClass("disablemod");
  }
 });
}