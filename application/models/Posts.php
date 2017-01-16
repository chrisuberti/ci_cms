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

     


     function total_comments($id){
         $this->db->like('post_id', $id);
         $this->db->from('comments');
         return $this->db->count_all_results();

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
	
	
	
	
	
	
	
	
	function create_post_table(){
	    $query=$this->find_all();
	
		// Create table of all posts:
		$this->table->set_template(array('table_open'=>"<table class='table table-striped table-bordered table-hover' id='post_summary_table'>"));
	    $this->table->set_heading('Post', 'Author', 'Categories', 'Comments', 'Date Published');
	    	if($query){
	    	    foreach($query as $post){
	    	    	
	    	        $user = $this->ion_auth->user($post->author_id);
	    	        $author = $user->full_name();
	    	        
	    	        $post_title = anchor('blog/edit_post/'.$post->id, $post->title);
	    	        $post_categories = $this->post_category_relations->cat_name_list($post->id);
	    	        $category_list = "";
	    	        
	    	        
	    	        if(!empty($post_categories)){
		    	        foreach($post_categories as $slug=>$category){
		    	        	$category_list .= anchor('blog/category/'.$slug, $category). ", ";
		    	        }
	    	        }
	    	        
	    	        
	    	        $num_comms = count(Comments::find_by('post_id', $post->id));
	    	        $this->table->add_row($post_title, $author,$category_list, $num_comms, pretty_date($post->date));
	    	    }
	    	
	    	$post_table= $this->table->generate();
	    	return $post_table;
	    	}
	}
	
	
	
 }