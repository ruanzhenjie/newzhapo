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
		<style type="text/css">
			body {
				padding: 0;
				margin: 0;
			}

			#commentitemtable {
				border-collapse: collapse;
				width: 100%;
				border: 1px solid #98bf21;
			}

			#commentitemtable th {
				background-color: #A7C942;
				/*background-color:#FFFF66;*/
				color: #ffffff;
				font-size: 1.1em;
				padding-top: 5px;
				padding-bottom: 4px;
				border: 1px solid #98bf21;
			}

			#commentitemtable td {
				width: 16%;
				border: 1px solid #98bf21;
			}
		</style>
		<title>后台操作</title>

	</head>

	<body>
		

<table id="commentitemtable">
	<tr>
		<th>
			commentID
		</th>
		<th>
			itemID
		</th>
		<th>
			content
		</th>
		<th>
			answerItem
		</th>
		<th colspan="2">
			opration
		</th>
	</tr>
	<?php
		include_once 'include/comment_item.php';
		if(isset($_GET["id"])){
			$a=new ClassComentControler($_GET["id"],-1,-1);
			$a->totr();
		}
	?>
</table>


	</body>
</html>
