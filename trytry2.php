<?php
	include_once 'include/comment_item.php';
	
	$a=new ClassComentControler($_GET["itemid"],$_GET["first"],$_GET["length"]);
	$a->display();
?>