<?php
session_start();
include("check_member.php");
check_member();
?>
<html>
<head>
	<meta charset="utf-8">
	<title>留言紀錄</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script>
	function func(sugid){
		$('.post_id').val(sugid);
		$('form').submit();
	}
	</script>
</head>
<body>
	<center>
		<?php
		include("msg.php");
		notify();
		?>
		<a href="suggest_main.php">返回留言版</a>
		<hr>
		<?php
		//和資料庫連線檢查
		include("connect_info.php");
		include("SQL_class.php");
		$user = new SQL_class($db_host, $db_name, $db_user, $db_password);
		//查詢留言紀錄
		$resultarr = $user->Select('`suggests`',[]);
		//顯示查詢留言結果
		?>
		<form  method="post" action="suggest_delete_go.php">
		<?php
		foreach ($resultarr as $value) {
			echo "ID: ".$value["id"]."<br>";
			echo "帳號: ".$value["account"]."<br>";
			echo $value["content"]."<br>";
			echo "發佈時間：".$value["datetime"];
		?>
			<input type="button" value="刪除留言" onclick="func(<?=$value['id']?>)">
		<?php	
		echo "<hr>";
		}
		?>
		<input type="hidden" name="post_id" value="" class="post_id">
		</form>
		<?php
		echo "共有".count($resultarr)."筆留言";
		?>
	</center>
</body>
</html>
