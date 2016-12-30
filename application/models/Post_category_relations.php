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
}

    
    