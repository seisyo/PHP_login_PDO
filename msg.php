<?php
	function notify(){
		if(isset($_SESSION["msg"])){
			echo '<script type="text/javascript">alert("'.$_SESSION["msg"].'")</script>';
			unset($_SESSION["msg"]);
			return 1;
		}
	}
?>