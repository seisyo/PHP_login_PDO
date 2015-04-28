<?php
session_start();
$_SESSION["checkok"] = false;
header("Location:index.php");