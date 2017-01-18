<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Albums extends MY_Model{
    const DB_TABLE = 'albums';
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
	
	public function __construct(){
		parent::__construct();
	}
	
	public function create_album_table(){
	    $query=$this->find_all();
	
		// Create table of all posts:
		$this->table->set_template(array('table_open'=>"<table class='table table-striped table-bordered table-hover' id='album_summary_table'>"));
	    $this->table->set_heading('Tile', 'Caption', 'Credit', 'Featured Image');
	    	if($query){
	    	    foreach($query as $album){
	    	    	
	    	        $album_title = anchor('photo/edit_album/'.$album->id, $album->album_title);
	    	        $caption = $album->caption;
	    	        $photo_cred = $album->credit;
	    	        $visible = $album->visible;
	    	        //$album_categories = $this->album_category_relations->cat_name_list($album->id);
	    	        //$category_list = "";
	    	        //
	    	        //
	    	        //if(!empty($album_categories)){
		    	    //    foreach($album_categories as $slug=>$category){
		    	    //    	$category_list .= anchor('blog/category/'.$slug, $category). ", ";
		    	    //    }
	    	        //}
	    	        
	    	        
	    	        $num_comms = count(Comments::find_by('album_id', $album->id));
	    	        $this->table->add_row($album_title, $author,$category_list, $num_comms, pretty_date($album->date));
	    	    }
	    	
	    	$album_table= $this->table->generate();
	    	return $album_table;
	    	}
	}

	public function create_album(){
		$path = base_url(). '/uploads/'.$this->album_dir;
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
//
//	public function find_all_album_photos(){
//		return Photograph::find_by_album($this->id);
//	}
//
//
//	public function find_featured_image(){
//		return Photograph::find_by_id($this->featured_photo_id);
//	}
//
//
//	public function check_for_photos(){
//	}
//
//	public function delete_album(){
//
//	}







}
 ?>