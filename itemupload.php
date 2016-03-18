<?php
		include_once 'checklogin.php';
		?>
<?php

require_once 'include/DBControler.php';

function getImg()
{
	if ((($_FILES["imgfile"]["type"] == "image/gif") || ($_FILES["imgfile"]["type"] == "image/jpeg") || ($_FILES["imgfile"]["type"] == "image/png") || ($_FILES["imgfile"]["type"] == "image/x-png") || ($_FILES["imgfile"]["type"] == "image/pjpeg"))) {
		if ($_FILES["imgfile"]["error"] > 0) {
			die("Return Code: " . $_FILES["imgfile"]["error"] . "<br />");
		} else {
			// echo "Upload: " . $_FILES["imgfile"]["name"] . "<br />";
			// echo "Type: " . $_FILES["imgfile"]["type"] . "<br />";
			// echo "Size: " . ($_FILES["imgfile"]["size"] / 1024) . " Kb<br />";
			// echo "Temp file: " . $_FILES["imgfile"]["tmp_name"] . "<br />";

			$ar = explode("/", $_FILES["imgfile"]["type"]);
			$imgtype = $ar[1];
			if($imgtype=="x-png"){
				$imgtype="png";
			}
			$imgplace = "headimg/" . time() . "." . $imgtype;

			move_uploaded_file($_FILES["imgfile"]["tmp_name"], $imgplace);
			// echo "Stored in: " . $imgplace;
			return $imgplace;

		}
	} else {
		die("picture fail");
	}
}




if ($_GET["action"] == "edit") {

	require_once 'include/DBControler.php';

	$msql = DBControler::initialize();
	// $res = $msql -> queryWithDB("zhapodb", 'select * from item where ItemID = "' . $_GET["id"] . '";');

	$ordid = $_GET["id"];

	$name = $_POST["name"];
	$des = $_POST["des"];
	$weight = (int)$_POST["weight"];
	$price=$_POST["price"];

	$newpageid = $_POST["choice"];
	$maxord = 0;

	$imgplace = "";
	$ordimgplace = "";
	$imgtype = "";
	
	
	
	if (strlen($_FILES["imgfile"]["name"])) {

			$imgplace = "";
			$imgtype = "";
			
			$imgplace=getImg();
			$sqlstr = 'UPDATE `item` SET `Weight`=' . $weight . ',`PageID`='.$newpageid.',`Name`="' . $name . '",`Description`="' . $des . '",`Price`="' . $price . '",`Img`="' . $imgplace . '" WHERE `ItemID`='.$ordid.' ;';
	}else{
			$sqlstr = 'UPDATE `item` SET `Weight`=' . $weight . ',`PageID`='.$newpageid.',`Name`="' . $name . '",`Description`="' . $des . '",`Price`="' . $price . '" WHERE `ItemID`='.$ordid.' ;';
	}
			$res = $msql -> queryWithDB("zhapodb1_1", $sqlstr);
			if ($res) {
				header("Location:background.php");
				// echo "sql succeed";
			} else {
				die("sql fail");
			}

			file_put_contents("itemshow/" . $ordid . ".html", $_POST["editorValue"]);



} 


else {
	require_once 'include/DBControler.php';

	$msql = DBControler::initialize();
	// $res = $msql -> queryWithDB("zhapodb", 'select * from item where ItemID like "' . $_POST["choice"] . '%";');

	$name = $_POST["name"];
	$des = $_POST["des"];
	$weight = (int)$_POST["weight"];
	$price=$_POST["price"];

	$newpage = $_POST["choice"];
	$maxord = 0;

	
	$imgplace = "";
	$imgtype = "";
	
	$imgplace=getImg();
	
	

	$newid="";
	$sqlstr = 'INSERT INTO `item`( `Weight`, `PageID`, `Name`, `Description`, `Price`, `Img`) VALUES (' . $weight . ',' . $newpage . ',"' . $name . '","' . $des . '","' . $price . '","' . $imgplace . '");';
	// echo $sqlstr."<br/>";
	// echo $sqlstr . "<br/>";
	$res = $msql -> queryWithDB("zhapodb1_1", $sqlstr);
	if ($res) {
		header("Location:background.php");
		// echo "sql succeed";
		// echo $res."<br/>";
		$res=$msql -> queryWithDB("zhapodb1_1", "SELECT LAST_INSERT_ID();");
		while($row=mysql_fetch_array($res)){
			// var_dump($row);
			$newid=$row[0];
		}
	} else {
		die("sql fail");
	}

	file_put_contents("itemshow/" . $newid . ".html", $_POST["editorValue"]);
}

// editorValue
?>