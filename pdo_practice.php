<?php
// $db_server = 'mysql:dbname=rakuda_seisyo; host=127.0.0.1';
// $db_user = 'rakuda';
// $db_password = 'QzcE2BXsyp6nU3MD';
include("connect_info.php");

//連線到資料庫
try{
$link = new PDO($db_server, $db_user, $db_password);
}catch(PDOException $e){
printf("DatabaseError: %s", $e->getMessage());
}
//尋訪資料庫抓下來的資料
//$result = $link->query("select `account` from `rakuda_seisyo`.`login`;")->fetch();
$result = $link->query("select `md5_password` from `login`;");
var_dump($result->fetchAll(PDO::FETCH_ASSOC));

// foreach ($result->fetch(PDO::FETCH_ASSOC) as $row) {
// echo $row;
// }


//關閉資料庫
$link = null;


