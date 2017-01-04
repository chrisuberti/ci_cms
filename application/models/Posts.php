<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Posts extends MY_Model{
    const DB_TABLE = 'posts';
    const DB_TABLE_PK = 'id';
    
    //Need to list out all the db fields here
    public $id;
    public $title;
    public $content;
    public $date;
    public $author_id; 
    
    
    public function __construct(){
        parent::__construct();
       
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
         $this->db->where('post_id', $id);
         $query = $this->db->get('comments');
         return $query->result();
     }
     function total_comments($id){
         $this->db->like('post_id', $id);
         $this->db->from('comments');
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
                     'category_name'=>$name, 
                     'slug'=>$slug);
                     $this->db->insert('categories', $data);
             }
             $i=$i+1; $slug=$slug.'-'.$i;
         }
     }
     
     
    function get_categories(){
		$query = $this->db->get('categories');
		return $query->result();
	}
	
	
	function get_category_post($slug){
	    $cat = Categories::find_by('slug', $slug);
	    $relations = Post_category_relations::find_by('category_id', $cat->id);

	    if(count($relations)==0){
	        return false;
	    }
	    if(isset($relations)&&$relations){
	        if(!is_array($relations)){
	            $list_post = array(Posts::find_by_id($relations->post_id));
	        }else{
	            foreach($relations as $relation){
	                $list_post[] = Posts::find_by_id($relation->post_id);
	            }   
	        }
	        //$list_post=array_shift($list_post);
	    }
	    return $list_post;
	}
 }