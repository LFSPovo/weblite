<?php
class Database {
	public static function getPDO() {
		global $config;
		$db = null;
		try {
			$db = new PDO("mysql:host={$config['database']['host']};dbname={$config['database']['db_name']}", 
				$config['database']['username'], 
				$config['database']['password']);
			$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		}
		catch (PDOException $err) {
			echo "Database error: " . $err->getMessage() . "<br>";
		}
		return $db;
	}
}