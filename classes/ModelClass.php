<?php
class ModelClass {
	public static $primary_key = 'id';
	public static $table_name;

	#
	#	Change PDORow into array
	#
	private static function row2obj($row) {
		# Find out the name of inherent class
		$class = get_called_class();
		# Convert PDORow properties to array
		$properties = get_object_vars($row);
		# Initialise inherent class
		$temp = new $class();
		# Set array key as property containing value
		foreach ($properties as $key => $value) {
			$temp->{$key} = $value;
		}
		return $temp;
	}
	
	#
	#	Return array of all model objects
	#
	public static function get_all() {
		# If table name isn't set, use model name as table
		$table_name = static::$table_name;
		if ($table_name == null)
			$table_name = substr($class, 0, strlen($class) - 5);

		$db = Database::getPDO();

		# Get data from DB
		$stmt = $db->prepare("SELECT * FROM `$table_name`");
		$stmt->execute();
		$rows = $stmt->fetchAll();
		
		# Process rows
		$result = array();
		foreach ($rows as $row) {
			$result[] = self::row2obj($row);
		}
		
		return $result;
	}

	#
	#	Return model object where $col=$value
	#
	public static function get($value, $col = null) {
		# If table name isn't set, use model name as table
		$table_name = static::$table_name;
		if ($table_name == null)
			$table_name = substr($class, 0, strlen($class) - 5);

		# Default column will be primary key
		if ($col == null)
			$col = static::$primary_key;

		$db = Database::getPDO();

		# Get data from DB
		$stmt = $db->prepare("SELECT * FROM `$table_name` WHERE `$col`=:value");
		$stmt->bindValue(':value', $value);
		$stmt->execute();
		
		# Only return object if a row exists.
		if ($stmt->rowCount() > 0)
			return self::row2obj($stmt->fetch());
		
		return null;
	}
}