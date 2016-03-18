<?php


	include_once 'include/comment_item.php';
	include_once 'include/DBControler.php';
	
	if(!isset($_GET["action"])){
		die("fail");
	}
	
	if(isset($_GET["action"])&& $_GET["action"]=="addmore")
	{
		$a=new ClassComentControler($_GET["itemid"],$_GET["first"],$_GET["length"]);
		$a->display();
	}
	elseif (isset($_GET["action"])&& $_GET["action"]=="add") {
		$msql=DBControler::initialize();
	
	
    	//var_dump($_POST);
	
		$content=filter_var($_POST["txtarea"],FILTER_SANITIZE_SPECIAL_CHARS);
		$itemid=$_POST["itemid"];
	//$answerid=-1;
	
		$str='INSERT INTO `comment`( `Content`, `ItemID`) VALUES ("'.$content.'",'.$itemid.');';
		// echo "<br/>".$str."<br/>";
	
		$res=$msql->queryWithDB("zhapodb1_1",$str);
		if($res){
			header("Location:itemshow.php?id=".$itemid);
		}
		else {
			die("fail");
		}
		
	}
	else{
			include_once 'checklogin.php';
	
	if ($_GET["action"]=="addanswer") {
		$msql=DBControler::initialize();
	
	
    	//var_dump($_POST);
	
		$content=filter_var($_POST["txtarea"],FILTER_SANITIZE_SPECIAL_CHARS);
	//$answerid=-1;
	
		$str='INSERT INTO `answer`( `Content`) VALUES ("'.$content.'");';
		// echo "<br/>".$str."<br/>";
	
		$res=$msql->queryWithDB("zhapodb1_1",$str);
		if($res){
			
		}
		else {
			die("fail");
		}
		
		$str='SELECT LAST_INSERT_ID();';
		
		$res=$msql->queryWithDB("zhapodb1_1",$str);
		
		$answerid=-1;
		if($res){
			while ($row=mysql_fetch_array($res)) {
				$answerid=$row[0];
			}
		}
		else {
			die("fail");
		}
		
		$commentid=$_GET["id"];
		
		$str='UPDATE `comment` SET `AnswerID`='.$answerid.' WHERE `CommentID`='.$commentid.' ;';
		// echo "<br/>".$str."<br/>";
	
		$res=$msql->queryWithDB("zhapodb1_1",$str);
		if($res){
			header("Location:background.php");
		}
		else {
			die("fail");
		}
	}
	elseif ($_GET["action"]=="editanswer") {
		$msql=DBControler::initialize();
		$content=filter_var($_POST["txtarea"],FILTER_SANITIZE_SPECIAL_CHARS);
		$id=$_GET["id"];
		
		$str='UPDATE `answer` SET `Content`="'.$content.'" WHERE  `AnswerID`='.$id.' ;';
		// echo "<br/>".$str."<br/>";
	
		$res=$msql->queryWithDB("zhapodb1_1",$str);
		if($res){
			header("Location:background.php");
		}
		else {
			die("fail");
		}
	}
	elseif ($_GET["action"]=="deletecomment") {
		
		$msql=DBControler::initialize();
		$id=$_GET["id"];
		
		$str='DELETE FROM `comment` WHERE CommentID='.$id.' ;';
		// echo "<br/>".$str."<br/>";
	
		$res=$msql->queryWithDB("zhapodb1_1",$str);
		if($res){
			header("Location:background.php");
		}
		else {
			die("fail");
		}
	}
	
	}
?>