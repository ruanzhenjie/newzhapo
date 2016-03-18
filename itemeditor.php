<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta http-equiv="Expires" content="0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<script type="text/javascript" charset="utf-8" src="utf8-php/ueditor.config.js"></script>
		<script type="text/javascript" charset="utf-8" src="utf8-php/ueditor.all.min.js"></script>
		<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
		<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
		<script type="text/javascript" charset="utf-8" src="utf8-php/lang/zh-cn/zh-cn.js"></script>
		<?php
		include_once 'checklogin.php';
		?>
		<?php
		include_once 'pagelist.php';
		?>

		<script src="include/class.js?ver=2" type="text/javascript"></script>
		
		<title>editor</title>

	</head>

	<body>

		<div id="content" style="margin: auto; width: 100%;">
				<?php
					if($_GET["action"]=="edit"){
						require_once 'include/DBControler.php';
						$msql = DBControler::initialize();
						$res = $msql -> queryWithDB("zhapodb1_1", "select * from item where ItemID='".$_GET["id"]."';");
						if($res){
							$row = mysql_fetch_array($res);
							$ordid=$_GET["id"];
							$weight=$row["Weight"];
							$name=$row["Name"];
							$des=$row["Description"];
							$price=$row["Price"];
							$pageid=$row["PageID"];
							$cont=file_get_contents("itemshow/".$ordid.".html");
							
							
							echo <<<EOF
						
			<form enctype="multipart/form-data" action="itemupload.php?action=edit&id=$ordid" method="post">
				<div>
				标志图片:<input type="file" name="imgfile"/>
				</div>
				<div>
					名称:<input  type="text" name="name" value="$name"/>
				</div>
				<div>
					简述:<input  type="text" name="des" value="$des"/>
				</div>
				<div>
					价格:<input  type="text" name="price" value="$price"/>
				</div>
				<div>
					权重:<input  type="text" name="weight" value="$weight" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" />
				</div>
				<div>
				类别:
				<select name="choice" id="choice">
				</select>
				</div>
				<br/>
				<div>
				详细描述:
				</div>
				<div>
					<script id="editor" type="text/plain" style="width:960px;height:500px;">$cont</script>
				</div>
				<input type="submit" value="上传" />
			</form>
						
EOF;
							
						}
					}
					else{
						echo <<<EOF
						
			<form enctype="multipart/form-data" action="itemupload.php?action=add" method="post">
				<div>
				标志图片:<input type="file" name="imgfile"/>
				</div>
				<div>
					名称:<input  type="text" name="name"/>
				</div>
				<div>
					简述:<input  type="text" name="des"/>
				</div>
				<div>
					价格:<input  type="text" name="price"/>
				</div>
				<div>
					权重:<input  type="text" name="weight" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" />
				</div>
				<div>
				类别:
				<select name="choice" id="choice">
				</select>
				</div>
				<br/>
				<div>
				详细描述:
				</div>
				<div>
					<script id="editor" type="text/plain" style="width:100%;height:500px;"></script>
				</div>
				<input type="submit" value="上传" />
			</form>
						
EOF;
					}
				?>
		</div>

		<script type="text/javascript">
			var ue = UE.getEditor('editor');
			ClassLeader.Instance().initialiael(pageid, parentid, pagename,null,null,"");
			
			
			
			<?php
			if($_GET["action"]=="edit")
	echo 'var ordid="'.$pageid.'";';
else
	{
	echo 'var ordid="";';
	}
			?>
			
			
			var selectArray=new Array();
	
	for(var i in ClassLeader.Instance().PageArray){
		if(0==ClassLeader.Instance().PageArray[i].child.length){
			selectArray.push(ClassLeader.Instance().PageArray[i]);
		}
	}
	
	
	//var lp=PageArray.length;
	
	//for(var i=0;i<PageArray.length;i++){
//		var l=PageArray[i].child.length;
//		if(0==PageArray[i].child.length){
//			selectArray.push(PageArray[i]);
//		}
//	}

	var sele = document.getElementById("choice");
	
	for(var i=0;i<selectArray.length;i++){
		sele.options[sele.options.length] = new Option(selectArray[i].pageName,selectArray[i].pageId);
		if(ordid==selectArray[i].pageId)
		{
			sele.options[i].selected=true;
		}
	}

		</script>
	</body>
</html>