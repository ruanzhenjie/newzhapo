<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
	include_once 'include/DBControler.php';
	
	$msql=DBControler::initialize();
	
	
    var_dump($_POST);
	
	$content=filter_var($_POST["txtarea"],FILTER_SANITIZE_SPECIAL_CHARS);
	$itemid=$_POST["itemid"];
	//$answerid=-1;
	
	$str='INSERT INTO `comment`( `Content`, `ItemID`) VALUES ("'.$content.'",'.$itemid.');';
	echo "<br/>".$str."<br/>";
	
	$res=$msql->queryWithDB("zhapodb1_1",$str);
	if($res){
		echo "yes";
	}
	else {
		echo "no";
	}
?>
</body>

</html>