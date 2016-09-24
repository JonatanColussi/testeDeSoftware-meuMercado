<?php
class Database{
	public static $db;
	const BD_HOST = 'localhost';
	const BD_USER = 'root';
	const BD_PASS = '';
	const BD_NAME = 'meuMercado';
	//const BD_PORT = 3306;

	public function instance(){
		if (!self::$db){
			$db = new Database();
			self::$db = $this->connect();
		}
		return self::$db;	
	}
	private function connect(){
		try{
			$db = new PDO("mysql:host=".self::BD_HOST.";dbname=".self::BD_NAME,self::BD_USER,self::BD_PASS);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}