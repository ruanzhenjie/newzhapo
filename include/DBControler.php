<?php
    class DBControler{
    	var $conn=null;
		var $db=null;
		
		private static $mDBControler=null;
		
    	private function __construct()
		{
			$this->conn=mysql_connect("localhost","root","");
			if(!$this->conn){
				die("fail connect");
			}
		}
		
		function __destruct(){
			if(!$this->conn){
				mysql_close($this->conn);
			}
		}
		
		static function initialize()
		{
			if(null==DBControler::$mDBControler){
				DBControler::$mDBControler=new DBControler();
				return DBControler::$mDBControler;
			}
			else{
				return DBControler::$mDBControler;
			}
		}
		
		
		function queryWithDB($mDB,$mquery){
			if(!$this->conn){
				return FALSE;
			}
			mysql_select_db($mDB,$this->conn);
			$res=mysql_query($mquery,$this->conn);
			
			// $res=mysql_db_query($mDB, $mquery,$this->conn);
			if($res)
				$this->db=$mDB;
			return $res;
		}
		
		function selectDB($database_name){
			if(!$this->conn){
				return FALSE;
			}
			
			$res=mysql_select_db($database_name,$this->conn);
			if($res)
				$this->db=$database_name;
			return res;
		}
		
		function query($mquery){
			if(!($this->conn && $this->db)){
				return FALSE;
			}
			
			return mysql_query($mquery,$this->conn);
		}
    }
	
	
	// $msql=new DBControler();
	// $res=$msql->queryWithDB("zhapodb", "select * from page;");
// 	
	// if($res)
	// {
		// while($row=mysql_fetch_array($res)){
			// var_dump($row);
		// }
	// }
?>