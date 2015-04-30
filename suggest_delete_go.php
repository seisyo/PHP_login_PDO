<?php
session_start();
include("check_member.php");
check_member();

//使用者填寫內容
$sugname = $_SESSION["username"];
$sugid = $_POST["post_id"];

//匯入資料庫連線資訊
include("connect_info.php");
include("SQL_class.php");
//建立連線物件
$user = new SQL_class($db_host, $db_name, $db_user, $db_password);
$maxid = $user->Max('`suggests`', '`id`');
if($sugid <= $maxid){
	$result = $user->Select('`suggests`',['`account`'], '`id`', $sugid);
	if($result[0]["account"] === $sugname){
		$user->Delete('`suggests`', $sugid);
		$_SESSION["msg"] = "成功刪除留言";
		header("Location:suggest_view.php");
	}
	else{
		$_SESSION["msg"] = "刪除留言失敗";
		header("Location:suggest_view.php");
	}
}
else{
	$_SESSION["msg"] = "無此留言";
	header("Location:suggest_view.php");
}

