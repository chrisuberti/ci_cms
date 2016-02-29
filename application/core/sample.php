<?php 
require_once(LIB_PATH.DS."database.php");
// these are common fuctions to all DB objects, users, comments, photos, etc
class DatabaseObject {
	// need to use late static bindings here

	public static function find_all(){

		return static::find_by_sql('SELECT * FROM '. static::$table_name);	
	}

	public static function find_by_id($id=0){
		global $database;
		$result_array=static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id=".$database->escape_value($id)." LIMIT 1");
		return !(empty($result_array))?array_shift($result_array): false;
		//this array shift pulls first element out of the array		
	}

	public static function find_by_sql($sql=""){
		global $database;
		//echo $sql."<br>";
		//var_dump($database->query($sql));
		$result_set = $database->query($sql);
		$object_array = array();
		while ($row=$database->fetch_array($result_set)) {
			$object_array[] = static::instantiate($row);
		}
		return $object_array;
	}

	private static function instantiate($record){
		$object = new static;
		// simple long form approach
		// $object->id 		= $record['id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->first_name = $record['first_name'];
		// $object->last_name 	= $record['last_name'];

		foreach ($record as $attribute => $value) {
			if ($object->has_attribute($attribute)) {
				$object->$attribute = $value;
			}
		}
		//print_r($object);
		return $object;
	}
	private function has_attribute($attribute){
		//get obj vars returns an associate array with all attributes, including private ones, as the keys and their current values as value
		$object_vars = $this->attributes();

		//we don't care about the value we jsut want to know if the key exists
		//will return true or false
		return array_key_exists($attribute, $object_vars);
	}

	public function create(){
		global $database;
		//don't forget SQL syntax, escape values and use single quotes
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".static::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .=") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		if ($database->query($sql)) {
			$this->id = $database->insert_id();
			//gets last id on current db connection
			return true;

		}else{
			return false;
		}
	}
	public function update(){
		global $database;

		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach ($attributes as $key => $value) {
			if ($key == 'order'){$attribute_pairs[]="`{$key}` = '{$value}'";}
			else{$attribute_pairs[]="{$key} = '{$value}'";}
		}
		$sql = "UPDATE ".static::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id = ". $database->escape_value($this->id);
		echo $sql;
		//have to be very careful with sql teFFFFxt
		$database->query($sql);
		return ($database->affected_rows() <= 1)? true : false;
	}





	public function delete(){
		global $database;
		$sql = "DELETE FROM ".static::$table_name." ";
		$sql .= "WHERE id=".$database->escape_value($this->id);
		$sql .= " LIMIT 1";
		$database->query($sql);
		return ($database->affected_rows() <= 1)? true: false;
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(static::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}

	protected function sanitized_attributes(){
		global $database;

		foreach ($this->attributes() as $key => $value) {
			$clean_attributes[$key] = $database->escape_value($value);
			}
		return $clean_attributes;

	}
public function sanitize_filename($string, $force_lowercase = true, $anal = false) {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                   "â€”", "â€“", ",", "<", ".", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
    return ($force_lowercase) ?
        (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') :
            strtolower($clean) :
        $clean;
}


	public static function getRows(){
		$query = static::find_by_sql("SELECT * FROM `".static::$table_name."` ORDER BY `order` ASC") or die(mysql_error());
		return $query;
	}
	
	
	
	public static function sortTable($sort=""){
		$sql = "SELECT * FROM `".static::$table_name."` ORDER BY ";
		//This sorts the albums/photos based on various parameters. Important not to directly insert GET requests into SQL srings.
		switch ($sort) {
			case "size":
				$sql .= "size";
				break;
			case "visible":
				$sql .= "visible";
				break;
			case "title":
				$sql .= "title";
				break;
			case "album_id":
				$sql .= "album_id";
				break;
			default:
				static::getRows();
		}
		
		$sql .= " ASC";
		echo $sql;
		$query = static::find_by_sql($sql) or die(mysql_error());
		return $query;
	}
	
	
    public static function updateOrder($id_array){
        $count = 1;
        foreach ($id_array as $id){
            $update = static::find_by_sql("UPDATE `".static::$table_name."` SET `order` = $count WHERE id = $id");
            $count ++;    
        }
        return true;
    }


}




?>