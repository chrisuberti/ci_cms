<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Posts extends MY_Model{
    const DB_TABLE = 'posts';
    const DB_TABLE_PK = 'id';
    
    //Need to list out all the db fields here
    public $id;
    public $title;
    public $content;
    public $date;
    //public $author; 
    
    
    public function __construct(){
        parent::__construct();
       
    }
     function add_new_entry($name, $body){
         $data = array(
             'title' => $name,
             'content' => $body,
             'date' => date('Y-m-d')
             );
        $this->db->insert('entry', $data);
     }
 }