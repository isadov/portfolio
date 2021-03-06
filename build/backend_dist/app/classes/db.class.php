<?php
class DB{
	private static $db_link;

	public static function init($user, $password, $dbname, $host, $charset){
		self::$db_link = self::connect($user, $password, $dbname, $host, $charset);
	}

	private static function connect($user, $password, $dbname, $host, $charset){
		$opt = array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.$charset
		);

		$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $password, $opt);
		return $connection;
	}

	public static function get_select($sql, $data = array()){
		$db_link = self::$db_link;
		$res = $db_link->prepare($sql);
		$res -> execute($data);

		$result = $res->fetchAll();
		$count = $res->rowCount();

		return array('count' => $count, 'result' => $result);
	}

	public static function insert($sql, $data = array()){
		$db_link = self::$db_link;
		$res = $db_link->prepare($sql);

		return $res -> execute($data);
	}

	public static function clear($table = ""){
		$db_link = self::$db_link;
		$sql = "TRUNCATE TABLE $table";
		$res = $db_link->exec($sql);

		return $res;
	}
}