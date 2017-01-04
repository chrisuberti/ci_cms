<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Post_category_relations extends MY_Model{
    const DB_TABLE = 'post_category_relations';
    const DB_TABLE_PK = 'id';
    
    //Need to list out all the db fields here
    public $id;
    public $post_id;
    public $category_id;
    
    public function __construct(){
        parent::__construct();
    }
    
     public function post_category_list($id){
        $sel_cats = self::find_by('post_id', $id);
        foreach($sel_cats as $sel_cat){
			$selected_categories[]=$sel_cat->category_id;
		}
		return $selected_categories;
    }
}

    
    