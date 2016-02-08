<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Post extends MY_Model{
    const DB_TABLE = 'posts';
    const DB_TABLE_PK = 'id';
    
    public static $db_fields=array('id','title','content');
    
    public $id;
    public $title;
    public $content;
    
    
    public function __construct(){
        parent::__construct();
       
    }
}

