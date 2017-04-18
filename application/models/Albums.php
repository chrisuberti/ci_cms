<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Albums extends MY_Model{
    const DB_TABLE = 'albums';
    const DB_TABLE_PK = 'id'; //primary key
    
    
	public $id;
	public $album_title; 
	public $album_dir;
	public $author_id;
	public $caption;
	public $visible;
	public $featured_photo_id;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function create_album_table(){
	    $query=$this->find_all();
	
		// Create table of all posts:
		$this->table->set_template(array('table_open'=>"<table class='table table-striped table-bordered table-hover' id='album_summary_table'>"));
	    $this->table->set_heading('Tile','Author', 'Caption', 'Created On', array('data'=>'Featured Image', 'style'=>'width:20%'));
	    	if($query){
	    	    foreach($query as $album){
	    	    	
	    	        $album_title ="<h5><b>". $album->album_title. "</h5></b>";
	    	        $album_title .= anchor('photo/edit_album/'.$album->id, "Edit"). " | ".anchor("photo/delete_album/".$album->id, "Delete", 'style="color:red"');
	    	        $caption = $album->caption;
	    	        $visible = $album->visible;
	    	        $author = $this->ion_auth_model->user($album->author_id)->full_name();
	    	        //Retrive featured image:
	    	        $photo = $this->images->find_by_id($album->featured_photo_id);	
		    			$image_config = array(
		    				//'src'	=>	'uploads/'.$album->album_dir . '/'.$photo->filename,
		    				'src'	=>	$photo->image_path(),
		    				'alt'	=>	$photo->caption,
		    				'class'	=>	'admin_img',
		    				'width'	=>	'100%',
		    				'height' => 'auto',
		    				'title'	=>	$photo->title);
	    	        
	    	        $feat_photo = "<div>". img($image_config)."</div>";
	    	        
	    	        $this->table->add_row($album_title, $author, $caption, pretty_date($album->date), $feat_photo);
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
			mkdir($path);
			$this->create();
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