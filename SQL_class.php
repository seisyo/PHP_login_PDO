<?php
class SQL_class{
	private  $link;
	
	public function __construct($db_host = "127.0.0.1", $db_name, $db_user, $db_password){
		//匯入連線資訊
		$dsn = "mysql:dbname={$db_name};host={$db_host};charset=UTF8";
		//連線到資料庫
		try{
			$this->link = new PDO($dsn, $db_user, $db_password);
			//$this->link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}catch(PDOException $e){
			printf("DatabaseError: %s", $e->getMessage());
			}
		echo "Connect successfully!"."<br>";
	}
	
	// public function implodecolumns($cols = []){
	// 	if(empty($cols)){
	// 		$cols= '*';
	// 	}elseif(is_string($cols)){
	// 		return 'Please input array!';
	// 		break;
	// 	}else{
	// 		$cols = implode(",",$cols);
	// 	}
	// 	return $cols;
	// }

	public function selection($table_name, $columns = [], $wherecon = 1, $whereval = 1){
		//查詢資料並輸出
		try{
			if(empty($columns)){//先將columns裡的欄位連接成字串
				$columns= '*';
			}elseif(is_string($columns)){
				return 'Please input array!';
			}else{
				$columns = implode(",",$columns);
			}
			$sql = "select ".$columns." from ".$table_name." where".$wherecon."= :whereval;";//先將變數以外的地方串接起來
			$sth = $this->link->prepare($sql);
			$sth->execute(array(':whereval'=>$whereval));//再prepare變數執行
		}catch(PDOException $e){
			printf("Database Connect Error: %s", $e->getMessage());
			}
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		//$result->fetchAll(PDO::FETCH_NUM);//將結果fetch出來
		var_dump($result);
	}
	
	public function insertion($table_name, $columns = [], $account, $content){
		//插入新資料
		try{
			if(empty($columns)){//先將columns裡的欄位連接成字串
				$columns= '*';
			}elseif(is_string($columns)){
				return 'Please input array!';
			}else{
				$columns = implode(",",$columns);
			}
			$sql = "insert into ".$table_name." ( ".$columns." ) "." values (:account,:content);";
			$sth = $this->link->prepare($sql);
			$sth->execute(array(':account'=>$account, ':content'=>md5($content)));//再prepare變數執行
		}catch(PDOException $e){
			printf("Database Connect Error: %s", $e->getMessage());
			}
	}
	
	public function __destruct(){
		$this->link = null;
		echo "<br>"."Bye~!";
	}
}
$o = new SQL_class('127.0.0.1','rakuda_seisyo', 'rakuda', 'QzcE2BXsyp6nU3MD');
$o->selection('`login`',['`account`','`md5_password`'],'`account`','abc');
$o -> insertion('`login`',['`account`','`md5_password`'],'seisyo','12345678');