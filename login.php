<?php
session_start();
//頁面輸入的帳號及密碼紀錄
$accountIn = $_POST["your_account"];
$passwordIn = md5($_POST["your_password"]);
//匯入資料庫連線資訊
include("connect_info.php");
include("SQL_class.php");
//判斷輸入是否為空
if(isset($accountIn) && isset($passwordIn)){//輸入不為空
	
	//去搜尋此帳號資料
	$user = new SQL_class($db_host, $db_name, $db_user, $db_password);
	$resultarr = $user->Select('`login`',['`md5_password`'],'`account`',$accountIn);
	//判斷密碼是否符合
	if ($resultarr[0]["md5_password"] === $passwordIn){
		//成功登入，前往suggest_main頁面
		$_SESSION["username"] = $accountIn;
		$_SESSION["checkok"] = true;
		header("Location:suggest_main.php");
	}
	else{
		//登入失敗
		$_SESSION["msg"] = "登入失敗";
		header("Location:index.php");
	}
}
else{//輸入為空
	$_SESSION["msg"] = "輸入不能空白";
	header("Location:index.php");
}

