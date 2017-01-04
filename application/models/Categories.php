<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Categories extends MY_Model{
    const DB_TABLE = 'categories';
    const DB_TABLE_PK = 'id';
    
    //Need to list out all the db fields here
    public $id;
    public $slug;
    public $category_name;
    
    public function __construct(){
        parent::__construct();
    }
    
    //Need to add some logic to check if category or slug is already taken!!!!!
    
    //Also a save function that just skips category if that slug/category is already taken
    //This is particularly used in the post edit function 
    
    
    public function list_all_cats(){
        //This function returns a category id => category name related array (used for listing all categories)
        $cats = self::find_all();
        foreach($cats as $category){
			$categories[$category->id] = $category->category_name;
        }
        return $categories;
    }
    
    public function delete_cat(){
    //This function not only deteles the category but any post relations that reference that cat    
        $this->load->model('post_category_relations');
        $relations = $this->post_category_relations->find_by('category_id', $this->id);
        foreach($relations as $relate){
            $relate->delete();
        }
        $this->delete();
    }
}

    
    