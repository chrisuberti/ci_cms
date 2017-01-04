<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Comments extends MY_Model{
    const DB_TABLE = 'comments';
    const DB_TABLE_PK = 'comment_id';
    
    //Need to list out all the db fields here
    public $comment_id;
    public $post_id;
    public $comment_name;
    public $comment_email;
    public $comment_body;
    public $comment_date;
    
    public function __construct(){
        parent::__construct();
    }
}