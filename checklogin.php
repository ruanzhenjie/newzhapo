<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if (!isset($_SESSION['user_id'])) {
	header("Location:login.html");
	exit();
}
//包含数据库连接文件
// include ('conn.php');
include_once 'include/DBControler.php';
	
	
	
$userid = $_SESSION['user_id'];
$username = $_SESSION['username'];
$random = $_SESSION['random'];
$count = $_SESSION['count'];
// $user_query = mysql_query("select * from user where user_id = '" . $userid . "' limit 1");

$msql=DBControler::initialize();
	
$user_query = $msql->queryWithDB("zhapodb1_1","select * from user where user_id = '" . $userid . "' limit 1");
$row = mysql_fetch_array($user_query);
if ($row['random_code'] != $random) {
	//echo "random miss";
	//exit();
	header("Location:login.html");
	exit();
}
//echo $count."<br/>";
$_SESSION['count']++;
echo '<div><a href="login.php?action=logout">注销</a> 登录</div>';
//header("string")
?>