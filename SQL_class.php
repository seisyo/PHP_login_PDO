<?php
class SQL_class{
	private  $link;
	private  $result;
	public function __construct(){
		//匯入連線資訊
		include("connect_info.php");
		//連線到資料庫
		try{
			$this->link = new PDO($db_server, $db_user, $db_password);
		}catch(PDOException $e){
			printf("DatabaseError: %s", $e->getMessage());
			}
		echo "Connect successfully!";
	}
	public function selection(){
		//查詢資料並輸出
		try{
			$this->result = $this->link->query("select `md5_password` from `login`;");
		}catch(PDOException $e){
			printf("Database Connect Error: %s", $e->getMessage());
			}
		
		
		var_dump($this->result->fetchAll(PDO::FETCH_ASSOC));
	}
	public function insertion(){
		//插入新登入資料
		try{
			$this->result = $this->link->exec("insert into `login` (`account`,`md5_password`) values ('abc','202cb962ac59075b964b07152d234b70')");
		}catch(PDOException $e){
			printf("Database Connect Error: %s", $e->getMessage());
			}
	}
	public function __destruct(){
		$this->link = null;
		echo "Bye~!";
	}
}
$o = new SQL_class();
$o -> selection();
$o -> insertion();