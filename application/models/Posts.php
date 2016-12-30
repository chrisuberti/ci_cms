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
        $this->db->insert('DB_TABLE', $data);
     }
     function add_new_comment($id, $commentor, $email, $comment){
         $data = array(
             'id'=>$id,
             'comment_name' => $commentor,
             'comment_email' => $email,
             'comment_body' => $comment);
             $this->db->insert('comment', $data);
     }
     
     function get_post($id){
         //$post = Post::find_by_id($id);
         $this->db->where('id', $id);
         $query = $this->db->get('posts');
         if($query->num_rows()!==0){
             return $query->result();
         }else{
             return FALSE;
         }
     }
     
     function get_post_comments($id){
         $this->db->where('entry_id', $id);
         $query = $this->db->get('comment');
         return $query->result();
     }
     function total_comments($id){
         $this->db->like('entry_id', $id);
         $this->db->from('comment');
         return $this->db->count_all_results();

     }
     function add_new_category($name, $slug){
         $i=0;
         $slug_taken=FALSE;
         
         while($slug_taken == FALSE){
             $category = $this->get_category(NULL, $slug);
             if($category == FALSE){
                 $slug_taken = TRUE;
                 $data = array(
                     'category_ name'=>$name, 
                     'slug'=>$slug);
                     $this->db->insert('entry_category', $data);
             }
             $i=$i+1; $slug=$slug.'-'.$i;
         }
     }
 }