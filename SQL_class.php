<?php
class SQL_class{
	private  $link;
	
	public function __construct($db_host = "127.0.0.1", $db_name, $db_user, $db_password){
		//匯入連線資訊
		$dsn = "mysql:dbname={$db_name};host={$db_host};charset=UTF8";
		//連線到資料庫
		try{
			$this->link = new PDO($dsn, $db_user, $db_password);
		}catch(PDOException $e){
			printf("DatabaseError: %s", $e->getMessage());
			}
		echo "Connect successfully!"."<br>";
	}
	
	public function selection($table_name, $columns = []){
		//查詢資料並輸出
		try{
			if(empty($columns)){
				$columns = '*';
			}elseif(is_string($columns)){
				return 'Please input array!';
			}else{
				$columns = implode(",",$columns);
			}
			//echo $columns."<br>";
			//echo $table_name."<br>";

			$result = $this->link->prepare("select :columns from :table;");
			//$result->bindParam(":columns", $columns);
			//$result->bindParam(":table_name", $table_name);
			$result->execute(array(':columns'=>$columns, ':table'=>$table_name));
			//$result->execute();

		}catch(PDOException $e){
			printf("Database Connect Error: %s", $e->getMessage());
			}
		var_dump($result->fetchAll(PDO::FETCH_NUM));
	}
	
	public function insertion(){
		//插入新登入資料
		try{
			$result = $this->link->exec("insert into `login` (`account`,`md5_password`) values ('abc','202cb962ac59075b964b07152d234b70')");
		}catch(PDOException $e){
			printf("Database Connect Error: %s", $e->getMessage());
			}
	}
	public function __destruct(){
		$this->link = null;
		echo "Bye~!";
	}
}
$o = new SQL_class('127.0.0.1','rakuda_seisyo', 'rakuda', 'QzcE2BXsyp6nU3MD');
$o->selection('`login`',['`account`','`md5_password`']);
// $o -> insertion();