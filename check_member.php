<?php
function check_member(){
	if (isset($_SESSION["username"]) && $_SESSION["checkok"] == true){
	}
	else{
		$_SESSION["msg"] = "請登入";
		header("Location:index.php");
	}
}

		