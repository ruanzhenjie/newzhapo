	<!-- <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<link href="sim_item.css" rel="stylesheet" type="text/css" />

		<title>sim_item</title>

	</head> -->

<?php
	require_once 'include/DBControler.php';
    require_once 'item.php';
	
	
	$res=DBControler::initialize()->queryWithDB("zhapodb1_1",'SELECT * FROM `page` WHERE ParentID = '.$_GET["id"].' ;');
	
	// echo mysql_num_rows($res);
	$num=mysql_num_rows($res);
	if($num){
		$pages="(";
		while ($row=mysql_fetch_array($res)) {
			$pages.=$row["PageID"];
			if(--$num){
				$pages.=",";
			}
			
		}
		$pages.=")";
		
		$res=DBControler::initialize()->queryWithDB("zhapodb1_1",'SELECT * FROM `item` WHERE PageID in '.$pages.' ORDER BY Weight ASC;');
	// echo 'SELECT * FROM `item` WHERE PageID = '.$_GET["id"].'ORDER BY Weight ASC;';
	// echo mysql_num_rows($res);
	
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
		
		
	}
	else{
		
	// $res=DBControler::initialize()->queryWithDB("zhapodb1_1",'SELECT * FROM `item` WHERE PageID in ('.$_GET["id1"].','.$_GET["id2"].') ORDER BY Weight ASC;');
	
	
	$res=DBControler::initialize()->queryWithDB("zhapodb1_1",'SELECT * FROM `item` WHERE PageID = '.$_GET["id"].' ORDER BY Weight ASC;');
	// echo 'SELECT * FROM `item` WHERE PageID = '.$_GET["id"].'ORDER BY Weight ASC;';
	// echo mysql_num_rows($res);
	
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
	
	}
	
	
?>