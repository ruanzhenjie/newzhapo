<?php
		include_once 'checklogin.php';
		?>
<?php
	require_once 'include/DBControler.php';

    if($_GET["action"]=="add"){
    	$name=$_POST["pagename"];
		$weight=$_POST["pageweight"];
		$parentid="";
		if($_POST["leader"]=="main"){
			$parentid="-1";
		}
		else{
			$parentid=$_POST["parentid"];
		}
		
		$msql = DBControler::initialize();
		$str='INSERT INTO `page`( `ParentID`, `Name`, `Weight`) VALUES ('.$parentid.',"'.$name.'",'.$weight.')';
		$res=$msql->queryWithDB("zhapodb1_1",$str);
		if($res){
			header("Location:background.php");
		}
		else{
			die("fail to add");
		}
    }
	elseif ($_GET["action"]=="edit") {
		$id=$_POST["pageid"];
		$name=$_POST["pagename"];
		$weight=$_POST["pageweight"];
		$parentid="";
		if($_POST["leader"]=="main"){
			$parentid="-1";
		}
		else{
			$parentid=$_POST["parentid"];
		}
		
		$msql = DBControler::initialize();
		$str='UPDATE `page` SET `ParentID`='.$parentid.',`Name`="'.$name.'",`Weight`='.$weight.' WHERE `PageID`='.$id.' ;';
		//$str='INSERT INTO `page`( `ParentID`, `Name`, `Weight`) VALUES ('.$parentid.',"'.$name.'",'.$weight.')';
		$res=$msql->queryWithDB("zhapodb1_1",$str);
		if($res){
			header("Location:background.php");
		}
		else{
			die("fail to add");
		}
	}
	elseif ($_GET["action"]=="delete") {
		$id=$_GET["id"];
	
	
	function deletepage($mid)
	{
		$msql = DBControler::initialize();
		$str='SELECT * FROM `page` WHERE ParentID='.$mid.' ;';
		$res=$msql->queryWithDB("zhapodb1_1",$str);
		$ar=array();
		while($row=mysql_fetch_array($res)){
			$ar[]=$row["PageID"];
		}
		if(count($ar)){
			foreach ($ar as $key => $value) {
				deletepage($value);
			}
			$str='DELETE  FROM `page` WHERE PageID='.$mid.' ;';
			$res=$msql->queryWithDB("zhapodb1_1",$str);
			if(!$res)
				die("fail delete");
		}
		else{
			
			$str='DELETE  FROM `item` WHERE PageID='.$mid.' ;';
			echo $str."<br/>";
			$res=$msql->queryWithDB("zhapodb1_1",$str);
			if(!$res)
				die("fail delete");
			$str='DELETE  FROM `page` WHERE PageID='.$mid.' ;';
			$res=$msql->queryWithDB("zhapodb1_1",$str);
			if(!$res)
				die("fail delete");
		}
		
	}
	
	deletepage($id);
	header("Location:background.php");
	}
?>