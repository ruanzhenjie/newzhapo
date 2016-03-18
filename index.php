<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta http-equiv="Expires" content="0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<meta name="renderer" content="ie-stand" />
		<link href="indexmain.css?ver=4" type="text/css" rel="stylesheet" />
		
		
		<?php
		include_once 'pagelist.php';
		?>

		<script src="include/class.js?ver=2" type="text/javascript"></script>
		<script src="indexmain.js?ver=2" type="text/javascript"></script>
		


		<title>海陵热点</title>

	</head>

	<body >
		<div id="header">
			海陵热点
			<div id="leaderbtn" onclick="ClassLeader.Instance().showMainLead()">
				<div id="headertxt">导航</div>
					
				</div>
		</div>
		<div id="mainleader"><div class="itemleader" onclick="gotoindex()">首页</div><div class="itemleader">AAAAAA</div></div>
		<div id="viceLeader"></div>
		
		<script type="text/javascript">
			ClassLeader.Instance().initialiael(pageid, parentid, pagename, document.getElementById("mainleader"), document.getElementById("viceLeader"), "itemleader");

		</script>
		<div id="forheader"></div>
		
		
		<div id="content">

			<div id="secheader">
				<img id="secheaderimg" src="image/secheader.jpg" />
			</div>

			<div id="firstlead">
				<div class="itemFirstLead" onclick="ClassLeader.Instance().jump(0)">
					<p><img src="image/jindian.png" />
					</p>
					闸坡景点
				</div>
				<div class="itemFirstLead" onclick="ClassLeader.Instance().jump(1)">
					<p><img src="image/jiudian.png" />
					</p>
					酒店宾馆
				</div>
				<div class="itemFirstLead" onclick="ClassLeader.Instance().jump(2)">
					<p><img src="image/yule.png" />
					</p>
					娱乐项目
				</div>
				<div class="itemFirstLead" onclick="ClassLeader.Instance().jump(3)">
					<p><img src="image/waimai.png" />
					</p>
					宵夜外卖
				</div>
			</div>

			<div id="recommend">
				<div style="margin-left: 3em;">
					热销推荐
				</div>
				<?php
					include_once 'include/DBControler.php';
					$res=DBControler::initialize()->queryWithDB("zhapodb1_1",'SELECT * FROM `item` LIMIT 4 ;');
					$arid=array();
					$arname=array();
					$ardes=array();
	
					while ($row=mysql_fetch_array($res)) {
						$arname[]=$row["Name"];
						$arid[]=$row["ItemID"];
						$ardes[]=$row["Description"];
					}
					
					echo <<<EOF
					<table id="recommendtable" rules="all" frame="above" bordercolor="#FF0033" align="center">
					<tr  align="center">
						<td onclick="open_item($arid[0])">
							$arname[0]
							<div style="font-size: 0.5em;">$ardes[0]</div>
						</td>
						<td onclick="open_item($arid[1])">
							$arname[1]
							<div style="font-size: 0.5em;">$ardes[1]</div>
						</td>
					</tr>
					<tr  align="center">
						<td onclick="open_item($arid[2])">
							$arname[2]
							<div style="font-size: 0.5em;">$ardes[2]</div>
						</td>
						<td onclick="open_item($arid[3])">
							$arname[3]
							<div style="font-size: 0.5em;">$ardes[3]</div>
						</td>
					</tr>
				</table>
EOF;
				?>
				
			</div>
		</div>

	</body>
</html>









