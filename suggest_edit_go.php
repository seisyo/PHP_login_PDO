<?php
session_start();
include("check_member.php");
check_member();

//使用者填寫內容
$sugname = $_SESSION["username"];
$sugcontent = $_POST["content"];
$sugid = $_POST["your_suggest_id"];

if(isset($sugcontent) && $sugcontent != ""){
	//匯入資料庫連線資訊
	include("connect_info.php");
	include("SQL_class.php");
	//建立連線物件
	$user = new SQL_class($db_host, $db_name, $db_user, $db_password);
	$maxid = $user->Max('`suggests`', '`id`');
	if($sugid <= $maxid){
		$result = $user->Select('`suggests`',['`account`'], '`id`', $sugid);
		if($result[0]["account"] === $sugname){
			$user->Update('`suggests`', '`content`', $sugcontent, $sugid);
			$_SESSION["msg"] = "成功更改留言";
			header("Location:suggest_main.php");
		}
		else{
			$_SESSION["msg"] = "無權更改留言";
			header("Location:suggest_main.php");
		}
	}
	else{
		$_SESSION["msg"] = "無此留言";
		header("Location:suggest_main.php");
	}
}
else{
	$_SESSION["msg"] = "留言失敗 or 留言無效";
	header("Location:suggest_main.php");
}