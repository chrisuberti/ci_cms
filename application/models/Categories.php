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
}

    
    