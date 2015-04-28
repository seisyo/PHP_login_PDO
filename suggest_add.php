<?php
session_start();
include("check_member.php");
check_member();

//使用者填寫內容
$sugname = $_SESSION["username"];
$sugcontent = $_POST["content"];

if(isset($sugcontent) && $sugcontent != ""){
	//匯入資料庫連線資訊
	include("connect_info.php");
	include("SQL_class.php");
	//建立連線物件
	$user = new SQL_class($db_host, $db_name, $db_user, $db_password);
	$sql = $user->Insert('`suggests`', ['`account`','`content`'], $sugname, $sugcontent);
	$_SESSION["msg"] = "留言完成";
	header("Location:suggest_main.php");
}
else{
	$_SESSION["msg"] = "留言失敗 or 留言無效";
	header("Location:suggest_main.php");
}

