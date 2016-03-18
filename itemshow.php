<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta http-equiv="Expires" content="0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="renderer" content="ie-stand" />
		<!-- <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,minimum-scale=1.0,user-scalable=no"/> -->
		<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link href="indexmain.css?ver=9" type="text/css" rel="stylesheet" />
		<script src="include/class.js?ver=4" type="text/javascript"></script>
	</head>
	
	<body onload="(function(){ClassAddMore.Instance().clickListen();})()">
		<script type="text/javascript">
			function back () {
				// alert("hello");
			  window.open("","_self").close();
			}
			function autoheight (ele) {
				ele.style.height = 'auto';
				ele.scrollTop = 0;
				ele.style.height=ele.scrollHeight+"px";
			}
			
			
			var a=ClassAddMore.Instance();
			a.setitemid(<?php echo $_GET["id"]; ?>);
			a.setendfun(function(argument) {
				document.getElementById("mclick").innerHTML="no more";
			});
			
			function uploadcomment () {
			  
			  if(document.getElementById("commentContent").value==""){
			  	alert("还没填评论内容");
			  }
			  else{
			  	// alert(document.getElementById("commentContent").value.length);
			  	document.getElementById("commentform").submit();
			  }
			}
			
			function toindex () {
			  window.location.href="index.php";
			  // window.history.back(-1);
			}
		</script>
		<div id="header">
			海陵热点
			<div id="backbtn" onclick="back()">
				<div id="headertxt">&lt;后退</div>
					
				</div>
			<div id="indexbtn" onclick="toindex()">
				<div id="indextxt">首页</div>
					
				</div>
		</div>
		<div id="forheader"></div>
		
		<div id="content">

<?php
	require_once 'include/DBControler.php';
    require_once 'item.php';
	
	
	$res=DBControler::initialize()->queryWithDB("zhapodb1_1",'SELECT * FROM `item` WHERE ItemID = '.$_GET["id"].' ;');
	
	while ($row=mysql_fetch_array($res)) {
		if($row["Img"]=="")
		// echo $row["Img"];
		// echo '<script type="text/javascript">alert("'.$row["Img"].'");</script>';
			$item=new ClassItem($row["Name"],$row["Description"],$row["ItemID"],$row["Price"]);
		else{
			$item=new ClassItem($row["Name"],$row["Description"],$row["ItemID"],$row["Price"],$row["Img"]);
		}
		$item->display();
	}
	
?>
	<div id="itemdesshow" style="word-break: break-all;width: 100%;overflow: auto;">
		<?php
			$path="itemshow/".$_GET['id'].".html";
			$cont=file_get_contents($path);
			echo $cont;
		?>
	</div>
	
	
	
	<div style="text-align: center;">评价列表</div>
	<div style="margin: 0.5em">
	<form method="post" action="commentcontroler.php?action=add" id="commentform">
			<textarea id="commentContent" name="txtarea" style="width: 100%;height:5em; overflow:hidden;" maxlength="300" oninput="autoheight(this)"></textarea>
			<div style="text-align: center;">
				<input type="button" value="提交我的评价" onclick="uploadcomment()"/>
			</div>
			<input type="hidden" name="itemid" value="<?php echo $_GET["id"]; ?>" />
	</form>
	</div>
	
	</div>
	
		<div id="show" style="display: none;text-align: center;">loading</div>
		<div id="mclick" onclick="(function(){ClassAddMore.Instance().clickListen();})()" style="text-align: center;height: 3em;line-height: 3em;">add more</div>


	</body>
	</html>