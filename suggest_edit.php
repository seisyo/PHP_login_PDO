<?php
session_start();
include("check_member.php");
check_member();
?>
<html>
<head>
	<meta charset="utf-8">
	<title>編輯留言</title>
</head>
<body>
	<center>
		<a href="suggest_main.php">返回留言版</a>
		<hr>
		<h3>編輯留言</h3>
		<form name="form1" method="post" action="suggest_edit_go.php">
			帳號：
			<?php
			echo $_SESSION["username"]."<br>";
			?>
			請輸入要編輯的留言ID：
			<input type="text" name="your_suggest_id"><br>
			內容(150字以下)：
			<br>
			<textarea rows=20 name="content"></textarea><br>
			<input type="submit" name="Submit" value="更新送出">
			<input type="Reset" name="Reset" value="重新填寫">
		</form>

	</center>
</body>
</html>