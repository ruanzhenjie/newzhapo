<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
    if(isset($_GET["action"])){
    	switch ($_GET['action']) {
			case 'itemshow':
				// $path="itemshow/".$_GET['id'].".html";
				// echo file_get_contents($path);
				header("Location:itemshow.php?id=".$_GET['id']);
				break;
			
			case 'itemlist':
				header("Location:itemlist.php?id=".$_GET['id']);
				
				
				break;
			
			default:
				
				break;
		}
    }
?>