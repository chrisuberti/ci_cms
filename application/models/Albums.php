<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Albums extends MY_Model{
    const DB_TABLE = 'Albums';
    const DB_TABLE_PK = 'id'; //primary key
    
    
	public $id;
	public $album_title; 
	public $album_dir;
	public $caption;
	public $category_id;
	public $credit;
	public $color_tag;
	public $visible;
	public $featured_photo_id;
	public $errors;

	public function create_album(){
		$path = SITE_ROOT . DS. 'public'.DS.'images'.DS.$this->album_dir;
		if (is_dir($path)) {
			$this->errors[] = "Could not create directory";
			return false;
		}else{

			$this->create();
			mkdir($path);
			return true;
		}
	}

	public static function get_album_dir($id=0){
		$album_row = static::find_by_id($id);
		if(is_object($album_row)){
			return $album_row->album_dir;
		}else{
			//$this->errors[] = "Directory does not exist";

			return false;
		}
	}

	public function find_all_album_photos(){
		return Photograph::find_by_album($this->id);
	}


	public function find_featured_image(){
		return Photograph::find_by_id($this->featured_photo_id);
	}


	public function check_for_photos(){
	}

	public function delete_album(){

	}







}
 ?>