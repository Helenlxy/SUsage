<?php require_once("../Includes/CheckLog.php"); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SUsage 管理中心 :: 查看角色权限</title>
  
  <!-- Bootstrap -->
  <link href="/SUsage/Admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.bootcss.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.svg" rel="stylesheet">
  
  <style>
  a{color:#4caf50;}
  a:hover{color:#4fb4f7;transition: 0.6s;}
  </style>
  
	<link rel="stylesheet" href="/SUsage/res/css/zTree/zTreeStyle.css" type="text/css">
	<script type="text/javascript" src="/SUsage/res/js/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="/SUsage/res/js/ztree.core.js"></script>
	<script type="text/javascript" src="/SUsage/res/js/ztree.excheck.js"></script>
  
	<SCRIPT type="text/javascript">
		var setting = {
			check: {
				enable: true,
				chkDisabledInherit: true
			},
			data: {
				simpleData: {
					enable: true
				}
			}
		};

		var zNodes =[
		
	 	/* Role Purview :: Group Master */
			{ id:1, pId:0, name:"角色：组长", chkDisabled:true},
			{ id:11, pId:1, name:"系统前台", chkDisabled:true, checked:true,open:true},
			{ id:111, pId:11, name:"任务系统", chkDisabled:true, checked:true},
			{ id:1111, pId:111, name:"发布任务", chkDisabled:true, checked:true},
			{ id:1112, pId:111, name:"接收任务", chkDisabled:true, checked:true},
			{ id:1113, pId:111, name:"完成任务", chkDisabled:true, checked:true},
			{ id:1114, pId:111, name:"删除任务", chkDisabled:true, checked:true},
			
			{ id:112, pId:11, name:"聊天系统（VegeChat）", chkDisabled:true, checked:true},
			{ id:1121, pId:112, name:"实时聊天", chkDisabled:true, checked:true},

			{ id:12, pId:1, name:"系统后台", chkDisabled:true, open:true},
			{ id:121, pId:12, name:"任务管理", chkDisabled:true},
			{ id:1211, pId:121, name:"删除任务", chkDisabled:true},
			{ id:1212, pId:121, name:"发布全局公告", chkDisabled:true},
			
			{ id:122, pId:12, name:"用户管理", chkDisabled:true},
			{ id:1221, pId:122, name:"新增用户", chkDisabled:true},
			{ id:1222, pId:122, name:"用户编辑", chkDisabled:true},
			{ id:1223, pId:122, name:"用户删除", chkDisabled:true},
			{ id:1224, pId:122, name:"用户重置密码", chkDisabled:true},
			
			{ id:123, pId:12, name:"系统管理", chkDisabled:true},
			{ id:1231, pId:123, name:"用户角色配置（组员/组长）", chkDisabled:true},
			{ id:1232, pId:123, name:"用户角色配置（管理员/超管）", chkDisabled:true},
			
			
			
			/* Role Purview :: Admin */
			{ id:2, pId:0, name:"角色：管理员", chkDisabled:true},
			{ id:21, pId:2, name:"系统前台", chkDisabled:true, checked:true,open:true},
			{ id:211, pId:21, name:"任务系统", chkDisabled:true, checked:true},
			{ id:2111, pId:211, name:"发布任务", chkDisabled:true, checked:true},
			{ id:2112, pId:211, name:"接收任务", chkDisabled:true, checked:true},
			{ id:2113, pId:211, name:"完成任务", chkDisabled:true, checked:true},
			{ id:2114, pId:211, name:"删除任务", chkDisabled:true, checked:true},
			
			{ id:212, pId:21, name:"聊天系统（VegeChat）", chkDisabled:true, checked:true},
			{ id:2121, pId:212, name:"实时聊天", chkDisabled:true, checked:true},

			{ id:22, pId:2, name:"系统后台", chkDisabled:true, open:true},
			{ id:221, pId:22, name:"任务管理", chkDisabled:true, checked:true},
			{ id:2211, pId:221, name:"删除任务", chkDisabled:true, checked:true},
			{ id:2212, pId:221, name:"发布全局公告", chkDisabled:true, checked:true},
			
			{ id:222, pId:22, name:"用户管理", chkDisabled:true, checked:true},
			{ id:2221, pId:222, name:"新增用户", chkDisabled:true, checked:true},
			{ id:2222, pId:222, name:"用户编辑", chkDisabled:true, checked:true},
			{ id:2223, pId:222, name:"用户删除", chkDisabled:true, checked:true},
			{ id:2224, pId:222, name:"用户重置密码", chkDisabled:true, checked:true},
			
			{ id:223, pId:22, name:"系统管理", chkDisabled:true, checked:true},
			{ id:2231, pId:223, name:"用户角色配置（组员/组长）", chkDisabled:true, checked:true},
			{ id:2232, pId:223, name:"用户角色配置（管理员/超管）", chkDisabled:true},
			
			
			
			/* Role Purview :: Super */
			{ id:3, pId:0, name:"角色：超级管理员", chkDisabled:true},
			{ id:31, pId:3, name:"系统前台", chkDisabled:true, checked:true,open:true},
			{ id:311, pId:31, name:"任务系统", chkDisabled:true, checked:true},
			{ id:3111, pId:311, name:"发布任务", chkDisabled:true, checked:true},
			{ id:3112, pId:311, name:"接收任务", chkDisabled:true, checked:true},
			{ id:3113, pId:311, name:"完成任务", chkDisabled:true, checked:true},
			{ id:3114, pId:311, name:"删除任务", chkDisabled:true, checked:true},
			
			{ id:312, pId:31, name:"聊天系统（VegeChat）", chkDisabled:true, checked:true},
			{ id:3121, pId:312, name:"实时聊天", chkDisabled:true, checked:true},

			{ id:32, pId:3, name:"系统后台", chkDisabled:true, open:true, checked:true},
			{ id:321, pId:32, name:"任务管理", chkDisabled:true, checked:true},
			{ id:3211, pId:321, name:"删除任务", chkDisabled:true, checked:true},
			{ id:3212, pId:321, name:"发布全局公告", chkDisabled:true, checked:true},
			
			{ id:322, pId:32, name:"用户管理", chkDisabled:true, checked:true},
			{ id:3221, pId:322, name:"新增用户", chkDisabled:true, checked:true},
			{ id:3222, pId:322, name:"用户编辑", chkDisabled:true, checked:true},
			{ id:3223, pId:322, name:"用户删除", chkDisabled:true, checked:true},
			{ id:3224, pId:322, name:"用户重置密码", chkDisabled:true, checked:true},
			
			{ id:323, pId:32, name:"系统管理", chkDisabled:true, checked:true},
			{ id:3231, pId:323, name:"用户角色配置（组员/组长）", chkDisabled:true, checked:true},
			{ id:3232, pId:323, name:"用户角色配置（管理员/超管）", chkDisabled:true, checked:true},

		];

		function disabledNode(e) {
			var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
			disabled = e.data.disabled,
			nodes = zTree.getSelectedNodes(),
			inheritParent = false, inheritChildren = false;
			if (nodes.length == 0) {
				alert("请先选择一个节点");
			}
			if (disabled) {
				inheritParent = $("#py").attr("checked");
				inheritChildren = $("#sy").attr("checked");
			} else {
				inheritParent = $("#pn").attr("checked");
				inheritChildren = $("#sn").attr("checked");
			}

			for (var i=0, l=nodes.length; i<l; i++) {
				zTree.setChkDisabled(nodes[i], disabled, inheritParent, inheritChildren);
			}
		}

		$(document).ready(function(){
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
			$("#disabledTrue").bind("click", {disabled: true}, disabledNode);
			$("#disabledFalse").bind("click", {disabled: false}, disabledNode);
			
		});
</SCRIPT>
</HEAD>

<BODY>
<?php require_once("../Includes/shownav.php"); ?>
<h1>SUsage系统所有角色对应权限</h1>
<hr>
<center>
<div class="content_wrap">
	<div class="zTreeDemoBackground">
		<ul id="treeDemo" class="ztree"></ul>
	</div>
</div>
</center>
</BODY>

  <script src="/SUsage/Admin/Includes/footer.js"></script>
  <script src="/SUsage/Admin/js/bootstrap.js"></script>

</HTML>