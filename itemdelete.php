<?php
		include_once 'checklogin.php';
		?>
<?php
				require_once 'include/DBControler.php';

				$msql = DBControler::initialize();
				$res = $msql -> queryWithDB("zhapodb1_1", 'DELETE FROM `item` WHERE ItemID="'.$_GET["id"].'";');

				if ($res) {
					header("Location:background.php");
				} else {
				die("fail to query");
				}
				?>