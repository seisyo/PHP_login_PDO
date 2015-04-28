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
		//echo "Connect successfully!"."<br>";
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

	public function Select($table_name, $columns = [], $wherecon = 1, $whereval = 1){
		//查詢資料並輸出(login & suggest)
		try{
			if(empty($columns)){//先將columns裡的欄位連接成字串
				$columns= ' * ';
			}elseif(is_string($columns)){
				return 'Please input array!';
			}else{
				$columns = implode(",",$columns);
			}
			$sql = "select ".$columns." from ".$table_name." where ".$wherecon." = :whereval;";//先將變數以外的地方串接起來
			$sth = $this->link->prepare($sql);		
			$sth->execute(array(':whereval'=>$whereval));//再prepare變數執行
		}catch(PDOException $e){
			printf("Database Connect Error: %s", $e->getMessage());
			}
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function Insert($table_name, $columns = [], $account = 1, $content = 1){
		//插入新資料(login & suggest)
		try{
			if(empty($columns)){//先將columns裡的欄位連接成字串
				$columns= '*';
				echo "haha";
			}elseif(is_string($columns)){
				return 'Please input array!';
			}else{
				$columns = implode(",",$columns);
			}
			$sql = "insert into ".$table_name." ( ".$columns." ,`datetime`) "." values (:account,:content,'".date("Y-m-d H:i:s")."');";//先將變數以外的地方串接起來
			$sth = $this->link->prepare($sql);
			$sth->execute(array(':account'=>$account, ':content'=>$content));//再prepare變數執行
		}catch(PDOException $e){
			printf("Database Connect Error: %s", $e->getMessage());
			}
	}

	public function Delete($table_name, $suggestid){
		//刪除資料(suggest)
		try{
			$sql = "delete from ".$table_name." where id = :suggestid";
			$sth = $this->link->prepare($sql);
			$sth->execute(array(':suggestid'=>$suggestid));
		}catch(PDOException $e){
			printf("Database Connect Error: %s", $e->getMessage());
			}
	}

	public function Update($table_name, $column, $content, $id){
		//編輯資料(suggest)
		try{
			$sql = "update ".$table_name." set ".$column." = :content where id = :id";
			$sth = $this->link->prepare($sql);
			$sth->execute(array(':content'=>$content, ':id'=>$id));
		}catch(PDOException $e){
			printf("Database Connect Error: %s", $e->getMessage());
			}
	}

	public function Max($table_name, $column){
		try{
			$sql = "select max(".$column.") from ".$table_name.';';
			$sth = $this->link->prepare($sql);
			$sth->execute();
		}catch(PDOException $e){
			printf("Database Connect Error: %s", $e->getMessage());
			}
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function __destruct(){
		$this->link = null;
		//echo "<br>"."Bye~!";
	}
}
// $o = new SQL_class('127.0.0.1','rakuda_seisyo', 'rakuda', 'QzcE2BXsyp6nU3MD');
// $k = $o->Select('`login`',[],'`account`','abc');
// $o->Insert('`login`',['`account`','`md5_password`'],'seisyo',md5('12345678'));
// $o->Insert('`suggests`',['`account`','`content`'],'seisyo','XDDDDDDD');
// var_dump($o);
// $o->Delete('`suggests`','3');
// $o->Update('`suggests`','`content`','SQL&PHP','6');