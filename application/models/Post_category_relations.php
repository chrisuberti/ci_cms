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
    
    
    //returns simple array of categories that are assoicated with a particular post
     public function post_category_list($id){
        $sel_cats = self::find_by('post_id', $id);
        $selected_categories=array();
        if(!empty($sel_cats)){
            if(is_array($sel_cats)){
                foreach($sel_cats as $sel_cat){
                    
        			$selected_categories[]=$sel_cat->category_id;
        		}
            }else{
                $selected_categories = $sel_cats->category_id;
            }
        }else{ return FALSE;}
		return $selected_categories;
    }
    
    
    // Pulls down associative array of slugs => category_names
    public function cat_name_list($id){
         $sel_cats = self::post_category_list($id);
         if($sel_cats){
             if(is_array($sel_cats)){
                 foreach($sel_cats as $cat_relate){
                     $category = Categories::find_by_id($cat_relate);
                     $categories[$category->slug]=$category->category_name;
                 }
             }else{
                 $category = Categories::find_by_id($sel_cats);
                 $categories[$category->slug]=$category->category_name;
             }
         }else{ return NULL;}
         return $categories;
         
    }
    
    
}

    
    