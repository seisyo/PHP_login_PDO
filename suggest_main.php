<?php
session_start();
include("check_member.php");
check_member();
?>
<html>
<head>
	<meta charset="utf-8">
	<title>留言板</title>
</head>
<body>
	<center>
		<?php
		include("msg.php");
		notify();
		?>
		<a href="suggest_view.php">--留言紀錄--</a>
		<a href="suggest_edit.php">--編輯留言--</a>
		<a href="suggest_delete.php">--刪除留言--</a>
		<a href="logout.php">--登出--</a>
		<hr>
		<h3>新增留言</h3>
		<form name="form1" method="post" action="suggest_add.php">
			帳號：
			<?php
			echo $_SESSION["username"];
			?>
			<br>
			內容(150字以下)：
			<br>
			<textarea rows=20 name="content"></textarea><br>
			<input type="submit" name="Submit" value="送出">
			<input type="Reset" name="Reset" value="重新填寫">
		</form>

	</center>
</body>
</html>