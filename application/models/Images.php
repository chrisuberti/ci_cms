<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Images extends MY_Model{
    const DB_TABLE = 'images';
    const DB_TABLE_PK = 'id'; //primary key
    
    public $id;
 	public $filename;
 	public $title;
 	public $type;
 	public $size;
 	public $caption;
 	public $album_id;
 	public $visible;


 	private $temp_path;
 	//protected $upload_dir=base_url()."/img";
 	public $errors = array();

 	public $upload_errors=array(UPLOAD_ERR_OK => "No errors.", UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize", UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE", UPLOAD_ERR_PARTIAL => "Partial upload", UPLOAD_ERR_NO_FILE => "No file", UPLOAD_ERR_NO_TMP_DIR => "No temporary directory", UPLOAD_ERR_CANT_WRITE => "Cant write to disk", UPLOAD_ERR_EXTENSION => "File upload stopped by extension.");


    public function add_photo(){
        	if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
			}else{
				if(!empty($_POST)){	
					$config['upload_path']          = './uploads/';
                	$config['allowed_types']        = 'gif|jpg|png';
                	$config['max_size']             = 100;
                	$config['max_width']            = 1024;
                	$config['max_height']           = 768;
                	
                	
					$this->load->library('upload', $config);

				}
				
        }
    }
}




//	////////////////////////////////////////////////
//	public function attach_file($file){
//		if (!$file || empty($file) || !is_array($file)) {
//			$this->errors[] = "No file was uploaded";
//			return false;	
//		} elseif ($file['error']!=0) {
//			$this->errors[] = $this->upload_errors[$file['error']];
//			return false;
//		} else{
//			$this->temp_path 	= $file['tmp_name'];
//			$this->filename 	=basename($file['name']);
//			$this->type 		=$file['type'];
//			$this->size 	 	=$file['size'];
//			return true;
//		}
//
//	}
//	public static function count_all(){
//		$sql ="SELECT COUNT(*) FROM " .self::$table_name;
//		$result_set = $database->query($sql);
//		$row = $database->fetch_array($result_set);
//		return array_shift($row);
//		// this responds as a database row, 
//		//that's why you need to do fetch array
//
//
//
//	}
//	public static function find_by_album($album_id=0){
//		global $database;
//		$results=static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE album_id=".$database->escape_value($album_id));
//		return !(empty($results))? $results : false;
//		//this array shift pulls first element out of the array		
//	}
//
//
//
//	public function save(){
//		if (isset($this->id)) {
//			$this->update();
//			//really just updates caption if id already exists
//		} else {
//			//check first before creating new file
//			if (!empty($this->errors)) {return false;}
//			//string length is too long caption
//			if (strlen($this->caption)>=255) {$this->errors[] = "Caption can only be 255 chars long";return false;}
//			//file location or path not available
//			if (empty($this->filename) || empty($this->temp_path)) {$this->errors[]="The file location was not available<br>"."filename:{$this->filename}<br>"."temp path: {$this->temp_path}"; return false;}
//	
//			if($album_dir=Album::get_album_dir($this->album_id)){
//				$this->target_path = SITE_ROOT. DS. 'public'.DS.$this->upload_dir.DS.$album_dir.DS.$this->filename;
//			}else {
//				$this->target_path = SITE_ROOT. DS. 'public'.DS.$this->upload_dir.DS.$this->filename;
//			}
//
//			//make sure file doesn't already exist
//			if (file_exists($this->image_path())) {$this->errors[] = "The file {$this->filename} already exits"; return false;}
//			//try to move file
//			if (move_uploaded_file($this->temp_path, $this->image_path())) {
//				if ($this->create()) {
//					unset($this->temp_path);
//					return true;
//				}
//				
//			}else{
//				//move file was unsuccessful, display error message
//				$this->errors[]="The file upload failed, possibly due to incorrect permissions on folder";
//				return false;
//			}
//		}
//	}
//	public function size_as_text(){
//		if ($this->size < 1024) {
//			return "{$this->size} bytes";
//		}elseif ($this->size < 1048576) {
//			$size_kb = round($this->size/1024);
//			return "{$size_kb} KB";
//		}else {
//			$size_mb = round($this->size/1048576);
//			return "{$size_mb} MB";
//		}
//	}
//
//	public function comments(){
//		//this supposidly simplifies things
//		// returns object that's a comment
//		return Comment::find_comments_on($this->id);
//	}
//
//
//	public function image_path(){
//		if($album_dir=Album::get_album_dir($this->album_id)){
//				return $this->target_path = SITE_ROOT. DS. 'public'.DS.$this->upload_dir.DS.$album_dir.DS.$this->filename;
//			}else {
//				return $this->target_path = SITE_ROOT. DS. 'public'.DS.$this->upload_dir.DS.$this->filename;
//			}
//		//return $this->upload_dir.DS.$this->filename;
//
//	}
//
//////////////////////////THIS FUNCITON IS ONLY NEEDED TO DISPLAY IMAGES VIA LOCALHOST///////////
//
//	////need to revert to JUST image_path once you go live///////////////////
//	public function localhost_image_path(){
//		if($album_dir=Album::get_album_dir($this->album_id)){
//				return $this->target_path = IMG_ROOT. DS. 'public'.DS.$this->upload_dir.DS.$album_dir.DS.$this->filename;
//			}else {
//				return $this->target_path = IMG_ROOT. DS. 'public'.DS.$this->upload_dir.DS.$this->filename;
//			}
//	}
//
//
//
//	public function destroy(){
//		//remove db entry
//		if ($this->delete()) {
//			return unlink($this->image_path())? true:false;
//		} else{
//			return false;
//		}
//		//remove the file
//
//	}
