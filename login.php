<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta http-equiv="Expires" content="0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<?php  
//注销登录  
session_start();  
if(isset($_GET['action']) && $_GET['action'] == "logout"){  
    unset($_SESSION['user_id']);  
    unset($_SESSION['username']);  
    unset($_SESSION['count']);  
    unset($_SESSION['random']);
	header("Location:login.html");
    //echo '注销登录成功！点击此处 <a href="login.html">登录</a>';  
    exit();  

}  

//登录  
if(!isset($_POST['submit'])){  
    exit('非法访问!');  
}  
$username = $_POST['username'];  
$password = $_POST['password'];  
  
//包含数据库连接文件  
include_once 'include/DBControler.php';
//检测用户名及密码是否正确  
$msql=DBControler::initialize();
	
$check_query =  $msql->queryWithDB("zhapodb1_1","select user_id from user where account='$username' and password='$password' limit 1");
// $check_query = mysql_query("select user_id from user where account='$username' and password='$password' limit 1");  
if($result = mysql_fetch_array($check_query)){  
    //登录成功  
    $_SESSION['username'] = $username;  
    $_SESSION['user_id'] = $result['user_id'];  
    $random=rand();
    $_SESSION['random']=$random;
    $_SESSION['count']=0;
    $count=$_SESSION['count'];

    $check_query = $msql->queryWithDB("zhapodb1_1","UPDATE `user` SET `random_code`=".$random." WHERE `user_id`=".$_SESSION['user_id'].";");

	header("Location:background.php");
    echo $username,' 欢迎你！进入 <a href="my.php">用户中心</a><br />';  
    // echo '点击此处 <a href="login.php?action=logout">注销</a> 登录！<br />'; ."<br/>";
    echo  $random."<br/>";
    exit;  
} else {  
    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');  
}  
  
  
  
  
?>  