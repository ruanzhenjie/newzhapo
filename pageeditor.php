<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta http-equiv="Expires" content="0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<?php
		include_once 'checklogin.php';
		?>
		<?php
		include_once 'pagelist.php';
		include_once 'include/DBControler.php';
		?>

		<script src="include/class.js?ver=2" type="text/javascript"></script>
		

		<title>后台操作</title>

	</head>

	<body>
	<?php
	if($_POST["action"]=="add"){
		echo <<<EOF
		<div style="width: 100%;">
			<form id="editform" action="pageupload.php?action=add" method="post">
			<div>
				名称:<input type="text" name="pagename"/>
			</div>
			<div>
				权重:<input type="text" name="pageweight" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/>
			</div>
			<div>
			标签类别:
			</div>
			<div>				
				<input id="main" type="radio" name="leader" value="main" checked="true"/>mainleader
			</div>
			<div>
				<input id="vice" type="radio" name="leader" value="vice"/>viceleader
			</div>
			<div>
			所属父标签:
				<select id="parentid" name="parentid"></select>
			</div>
			<div>
				<input type="button" value="上传" onclick="checkpage()"/>
			</div>
			
			</form>
		</div>
		
<script type="text/javascript">
	ClassLeader.Instance().initialiael(pageid, parentid, pagename,null,null,"");
			
			
			var mainleader=new Array();
	
	for(var i in ClassLeader.Instance().PageArray){
		if(ClassLeader.Instance().PageArray[i].parentNode===null){
			mainleader.push(ClassLeader.Instance().PageArray[i]);
		}
	}
	
	var msel=document.getElementById("parentid");
	
	for(var i=0;i<mainleader.length;i++){
		msel.options[msel.options.length] = new Option(mainleader[i].pageName,mainleader[i].pageId);
	}

	
	
		
</script>
		
		
		
EOF;
	}
elseif ($_POST["action"]=="edit") {
	$id=$_POST["pagechoice"];
	$msql = DBControler::initialize();
	$str='SELECT * FROM `page` WHERE PageID='.$id.' ;';
	$res=$msql->queryWithDB("zhapodb1_1",$str);
	$name="";
	$weight=0;
	$parentid="";
	while($row=mysql_fetch_array($res)){
		$name=$row["Name"];
		$weight=$row["Weight"];
		$parentid=$row["ParentID"];
	}
	
	echo <<<EOF
	
			<div style="width: 100%;">
			<form id="editform" action="pageupload.php?action=edit" method="post">
			<div>
				名称:<input type="text" name="pagename" value="$name"/>
			</div>
			<div>
				权重:<input type="text" name="pageweight" value="$weight" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/>
			</div>
			<div>
			标签类别:
			</div>
			<div>				
				<input id="main" type="radio" name="leader" value="main" checked="true"/>mainleader
			</div>
			<div>
				<input id="vice" type="radio" name="leader" value="vice"/>viceleader
			</div>
			<div>
			所属父标签:
				<select id="parentid" name="parentid"></select>
			</div>
			<div>
				<input type="button" value="上传" onclick="checkpage()"/>
			</div>
			<input id="pageid" type="hidden" name="pageid" value="$id" />
			</form>
		</div>
		
<script type="text/javascript">
	ClassLeader.Instance().initialiael(pageid, parentid, pagename,null,null,"");
			
			
			var mainleader=new Array();
	
	for(var i in ClassLeader.Instance().PageArray){
		if(ClassLeader.Instance().PageArray[i].parentNode===null){
			mainleader.push(ClassLeader.Instance().PageArray[i]);
		}
	}
	
	if(ClassLeader.Instance().PageArray[$id].child.length){
		document.getElementById("vice").disabled=true;
	}
	
	var msel=document.getElementById("parentid");
	var parentid=$parentid;
	for(var i=0;i<mainleader.length;i++){
		msel.options[msel.options.length] = new Option(mainleader[i].pageName,mainleader[i].pageId);
		if(parentid==mainleader[i].pageId)
		{
			msel.options[i].selected=true;
			document.getElementById("vice").checked="true";
		}
	}

	
	
		
</script>
	
EOF;
	
}
elseif ($_POST["action"]=="delete") {
	$id=$_POST["pagechoice"];
	
	
	// function deletepage($mid)
	// {
		// $msql = DBControler::initialize();
		// $str='SELECT * FROM `page` WHERE ParentID='.$mid.' ;';
		// $res=$msql->queryWithDB("zhapodb1_1",$str);
		// $ar=array();
		// while($row=mysql_fetch_array($res)){
			// $ar[]=$row["PageID"];
		// }
		// if(count($ar)){
			// foreach ($ar as $key => $value) {
				// deletepage($value);
			// }
		// }
		// else{
// 			
			// $str='DELETE * FROM `item` WHERE PageID='.$mid.' ;';
			// $res=$msql->queryWithDB("zhapodb1_1",$str);
			// if(!$res)
				// die("fail delete");
			// $str='DELETE * FROM `page` WHERE PageID='.$mid.' ;';
			// $res=$msql->queryWithDB("zhapodb1_1",$str);
			// if(!$res)
				// die("fail delete");
		// }
// 		
	// }
// 	
	// deletepage($id);
	// header("Location:background.php");
	
	header("Location:pageupload.php?action=delete&id=".$id);
	
	
}
	
	?>

		




<script type="text/javascript">

	function checkpage () {
	  if(document.getElementById("vice").checked)
	  {
	  	if(confirm("the items of this page may by delete . are you sure?")){
	  		document.getElementById("editform").submit();
	  	}
	  }
	  else
	  	document.getElementById("editform").submit();
	}


	// ClassLeader.Instance().initialiael(pageid, parentid, pagename,null,null,"");
// 			
// 			
			// var mainleader=new Array();
// 	
	// for(var i in ClassLeader.Instance().PageArray){
		// if(ClassLeader.Instance().PageArray[i].parentNode===null){
			// mainleader.push(ClassLeader.Instance().PageArray[i]);
		// }
	// }
// 	
	// var msel=document.getElementById("parentid");
// 	
	// for(var i=0;i<mainleader.length;i++){
		// msel.options[msel.options.length] = new Option(mainleader[i].pageName,mainleader[i].pageId);
		// if(ordid==mainleader[i].pageId)
		// {
			// msel.options[i].selected=true;
		// }
	// }


	
		
</script>

</body>
</html>