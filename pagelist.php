<?php
    include_once 'include/DBControler.php';
	
	$msql=DBControler::initialize();
	
	$res=$msql->queryWithDB("zhapodb1_1",'SELECT * FROM `page` ORDER BY Weight;');
	
	$pageid=array();
	$parentid=array();
	$pagename=array();
	
	if($res)
	{
		while($row=mysql_fetch_array($res)){
			// var_dump($row);
			$pageid[]=$row["PageID"];
			$parentid[]=$row["ParentID"];
			$pagename[]=$row["Name"];
		}
	}
	
	$len=count($pageid);
	
	echo '<script type="text/javascript">';
	echo "var pageid = new Array(";
	for($i=0;$i<$len;$i++){
		if($i!=0)
			echo ",";
		echo $pageid[$i];
	}
	echo ");";
	
	echo "var parentid = new Array(";
	for($i=0;$i<$len;$i++){
		if($i!=0)
			echo ",";
		echo $parentid[$i];
	}
	echo ");";
	
	echo 'var pagename = new Array("';
	for($i=0;$i<$len;$i++){
		if($i!=0)
			echo '","';
		echo $pagename[$i];
	}
	echo '");';
	echo "</script>";
?>