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
		<title>后台操作</title>

	</head>

	<body>
		
<?php
	include_once 'include/DBControler.php';
	if(!(isset($_GET["action"]) && isset($_GET["id"])))
		die("error");
    $id=$_GET["id"];
	$action=$_GET["action"];
	// var_dump($_GET);
	$content="";
	if($_GET["action"]=="addanswer")
	{
		$content="";
		
		
	}
	elseif ($_GET["action"]=="editanswer") {
		$msql=DBControler::initialize();
		
		$str='SELECT * FROM `answer` WHERE AnswerID='.$id.' ;';
		// echo "<br/>".$str."<br/>";
	
		$res=$msql->queryWithDB("zhapodb1_1",$str);
		if($res){
			while ($row=mysql_fetch_array($res)) {
				$content=$row["Content"];
			}
		}
		else {
			die("fail");
		}
		
	}
	echo <<<EOF
	<div style="margin: 0.5em">
	<form method="post" action="commentcontroler.php?action=$action&id=$id">
			<textarea name="txtarea" style="width: 100%;height:5em; overflow:hidden;" maxlength="300" oninput="autoheight(this)">$content</textarea>
			<div style="text-align: center;">
				<input type="submit" value="提交回复" />
			</div>
	</form>
	</div>
EOF;
?>

</body>
</html>