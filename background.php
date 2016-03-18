<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta http-equiv="Expires" content="0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link type="text/css" href="background.css?ver=3" rel="stylesheet" />
		<?php
		include_once 'checklogin.php';
		?>
		<?php
		include_once 'pagelist.php';
		?>

		<script src="include/class.js?ver=2" type="text/javascript"></script>

		<title>后台操作</title>

	</head>

	<body>
		

		
		
		<div id="content">
			
			<div>
				<form id="pageform" action="pageeditor.php" method="post">
					<div>
						<a style="margin: 1em;" href="javascript:void(0);" onclick="pageadd()">增加标签</a>
					</div>
					<div>
						<a style="margin: 1em;" href="javascript:void(0);" onclick="pagedelete()">删除标签</a>
					</div>
					<div>
						<a style="margin: 1em;" href="javascript:void(0);" onclick="pageedit()">编辑标签</a>
					</div>
					<input id="pageaction" type="hidden" name="action" value="mdefault" />
				<table id="pagetable">
					<tr>
						<th>主标签</th>
						<th>副标签</th>
					</tr>
				</table>
				</form>
			</div>
			
			<!-- <div >
				<a href="javascript:void(0);" onclick="alert('还没做这个功能，过会做哈。');">CHANG THE PAGE</a>
			</div> -->
			<div >
				<a href="itemeditor.php?action=add">增加商品</a>
			</div>
			
			<table id="itemtable">
				<tr>
					<th>商品id</th>
					<th>权重</th>
					<th>名称</th>
					<th>简述</th>
					<th colspan="3">操作</th>
				</tr>
				<?php
				require_once 'include/DBControler.php';

				$msql = DBControler::initialize();
				$res = $msql -> queryWithDB("zhapodb1_1", 'select * from item ;');

				if ($res) {
				while ($row = mysql_fetch_array($res)) {
					$id=$row["ItemID"];
					$weight=$row["Weight"];
					$name=$row["Name"];
					$des=$row["Description"];
					echo <<<EOF
					
				<tr>
					<td>$id</td>
					<td>$weight</td>
					<td>$name</td>
					<td>$des</td>
					<td><a href="itemdelete.php?id=$id">删除<a></td>
					<td><a href="itemeditor.php?action=edit&id=$id">修改<a></td>
					<td><a href="commentedit.php?id=$id">管理评价<a></td>
				</tr>
EOF;
				}
				} else {
				die("fail to query");
				}
				?>
			</table>
		</div>
		
		<script type="text/javascript">
			ClassLeader.Instance().initialiael(pageid, parentid, pagename,null,null,"");
			
			
			var mainleader=new Array();
	
	for(var i in ClassLeader.Instance().PageArray){
		if(ClassLeader.Instance().PageArray[i].parentNode===null){
			mainleader.push(ClassLeader.Instance().PageArray[i]);
		}
	}
	
		var mt=document.getElementById("pagetable");
		
		for(var mainpage in mainleader){
			var mrow=mt.insertRow(mt.rows.length);
			var md=mrow.insertCell(mrow.cells.length);
			var r=document.createElement("input");
			r.type="radio";
			r.name="pagechoice";
			r.value=mainleader[mainpage].pageId+"";
			md.appendChild(r);
			var txt=document.createTextNode(mainleader[mainpage].pageName);
			md.appendChild(txt);
			if(mainleader[mainpage].child.length){
				md.rowSpan=""+mainleader[mainpage].child.length;
				for(var vicepage in mainleader[mainpage].child){
					if(vicepage!=0){
						var mrow=mt.insertRow(mt.rows.length);
					}
					var md=mrow.insertCell(mrow.cells.length);
					var r=document.createElement("input");
					r.type="radio";
					r.name="pagechoice";
					r.value=mainleader[mainpage].child[vicepage].pageId+"";
					md.appendChild(r);
					var txt=document.createTextNode(mainleader[mainpage].child[vicepage].pageName);
					md.appendChild(txt);
				}
			}
		}
		
		
		function radioscheck () {
		  var rs=document.getElementsByName("pagechoice");
		  var f=-1;
		  for(var i in rs){
		  	if(rs[i].checked){
		  		f=i;
		  		break;
		  	}
		  }
		  
		  if(f<0){
		  	return false;
		  }
		  else{
		  	return f;
		  }
		}
		
		function pagedelete() {
			var page=radioscheck();
		  if(page===false){
		  	alert("have no check");
		  }
		  else{
		  	// if(ClassLeader.Instance().PageArray[page].child.length){
		  		// alert(page);
		  	// }
		  	
		  	if(confirm("will delete all vice pages and items. are you sure?")){
		  		
		  		var ac=document.getElementById("pageaction");
		  		ac.value="delete";
		  		document.getElementById("pageform").submit();
		  	}
		  	
		  }
		}
		
		
		function pageedit() {
		  var page=radioscheck();
		  if(page===false){
		  	alert("have no check");
		  }
		  else{
		  	// if(ClassLeader.Instance().PageArray[page].child.length){
		  		// alert(page);
		  	// }
		  	
		  	
		  	var ac=document.getElementById("pageaction");
		  	ac.value="edit";
		  	document.getElementById("pageform").submit();
		  	
		  }
		}
		
		
		function pageadd() {
		  var ac=document.getElementById("pageaction");
		  	ac.value="add";
		  	document.getElementById("pageform").submit();
		}
			
		</script>

	
	</body>
</html>
