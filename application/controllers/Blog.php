<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller{

	function __construct(){
	    parent::__construct();
		$this->load->library(array('form_validation', 'table'));
		$this->load->model(array('posts', 'categories', 'post_category_relations', 'comments'));
		$this->load->helper('general');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        }
        
       
	public function index(){
		$data['title']='Home - '. $this->config->item('site_title', 'ion_auth');
		$data['current']='HOME';
		
		$data['query']=Posts::find_all();
		$data['categories']=Categories::find_all();
		$this->load->view('blog/index',$data);
		
	}
	
	
	public function admin_dash(){
		$data['title']='Home - '. $this->config->item('site_title', 'ion_auth');
		$data['current']='HOME';
		
		$data['query']=Posts::find_all();
		$data['categories']=Categories::find_all();
		$this->load->view('auth/blog/index',$data);
		
	}
	
	
	
	public function add_post(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
			}else{
				if(!empty($_POST)){	
					$data['title']='Add new entry - '.$this->config->item('site_title', 'ion_auth');
					$cats = Categories::find_all();
					
					//$categories = array();
					foreach($cats as $category){
						$categories[$category->id] = $category->category_name;
					}
					
					$data['categories']= $categories;
					// redirect them to the home page because they must be an administrator to view this
					$this->form_validation->set_rules('title', 'Title', 'required|max_length[200]');
					$this->form_validation->set_rules('content', 'Body', 'required');
					$this->form_validation->set_rules('post_cats[]', 'Category', 'required');
					
					if ($this->form_validation->run()==FALSE){
						//not valid
						$data['temp_title'] = $this->input->post('title');
						$data['temp_content']= $this->input->post('content');
							
						$temp_cats = $this->input->post('post_cats[]');
						if(!isset($temp_cats)){$temp_cats=array();};
						$data['temp_cats'] = $temp_cats;
						$this->load->view('auth/blog/add_post', $data);
					}else{//form validation works
						$post = new Posts;
						$post->author_id = $this->ion_auth->user()->row();
						$post->title = $this->input->post('title');
						$post->content= $this->input->post('content');
						$post->save();
						
						$categories = $this->input->post('post_cats');
						preprint($categories);
						foreach ($categories as $cat){
							$cat_relation = new Post_category_relations;
							$cat_relation->post_id = $post->id;
							$cat_relation->category_id = $cat;
							$cat_relation->save();
						}
						$this->session->set_flashdata('message', '1 New Entry Added!');
						redirect('blog');
					}
				}
		}
	}
		public function edit_post($post_id){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
			}else{
				$data['title']='Edit post - '.$this->config->item('site_title', 'ion_auth');
				$post = Posts::find_by_id($post_id);
				if(!empty($_POST)){
					// redirect them to the home page because they must be an administrator to view this
					$this->form_validation->set_rules('post_title', 'Title', 'required|max_length[200]');
					$this->form_validation->set_rules('content', 'Body', 'required');
					$this->form_validation->set_rules('post_cats[]', 'Category', 'required');
					
					if ($this->form_validation->run()==FALSE){
						//not valid
					
						$temp_cats = $this->input->post('post_cats[]');
						if(!isset($temp_cats)){$temp_cats=array();};
						$data['temp_cats'] = $temp_cats;
						$this->load->view('auth/blog/edit_post', $data);
					}else{//form validation works
						$post->title = $this->input->post('post_title');
						$post->content= $this->input->post('content');
						$post->save();
						
						$categories = $this->input->post('post_cats');
						
						foreach ($categories as $cat){
							$cat_relation = new Post_category_relations;
							$cat_relation->post_id = $post->id;
							$cat_relation->category_id = $cat;
							$cat_relation->save();
						}
						$this->session->set_flashdata('message', 'Post Updated Fool');
						redirect('edit_post/'.$post_id);
					}
				}
				
				//render page initially
				$data['id']=$post_id;
				$data['post_title']=$post->title; 
				$data['content']=$post->content;
				$cats = Categories::find_all();
				foreach($cats as $category){
					$categories[$category->id] = $category->category_name;
				}
				$data['categories']= $categories;
				$sel_cats=Post_category_relations::find_by('post_id', $post_id);
				foreach($sel_cats as $sel_cat){
					$selected_categories[]=$sel_cat->category_id;
				}
				$data['sel_cats']=$selected_categories;
				$this->load->view('auth/blog/edit_post', $data);
		}
	}
	
		public function post($id){
			$data['post']=Posts::find_by_id($id);
			$data['comments']=$this->posts->get_post_comments($id);
			$data['post_id']=$id;
			$data['total_comments']=$this->posts->total_comments($id);
			
			$this->load->helper('form');
			$this->load->library(array('form_validation', 'session'));
			
			$this->form_validation->set_rules('commentor', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('comment', 'Comment', 'required');
			
			if($this->posts->get_post($id)){
				foreach($this->posts->get_post($id) as $row){
					$data['title']=$row->title;
					$data['content'] = $row->content;
				}
				if($this->form_validation->run() == FALSE){
					$this->load->view('blog/post', $data);
				}else{
					$comment = new Comments;
					$comment->comment_name= $this->input->post('commentor');
					$comment->comment_email = strtolower($this->input->post('email'));
					$comment->comment_body = $this->input->post('comment');
					$comment->post_id = $data['post']->id;
					
					$comment->save();
					$this->session->set_flashdata('message', '1 new comment added!');
					redirect('blog/post/'. $data['post']->id);
				}
			}else{
				show_404();
			}
			
		}
		
	public function add_new_category($action=NULL, $id = NULL){

		$data['title']='Add new category - '. $this->config->item('site_title', 'ion_auth');
		if (!$this->ion_auth->logged_in()){
			// redirect them to the login page
			redirect('auth/login', 'refresh');
			
		}elseif ($this->ion_auth->is_admin()){ // remove this elseif if you want to enable this for non-admins
			$data['categories']=Categories::find_all();
			
			
			
			if($action == 'delete'){
				$del_cat = Categories::find_by_id($id);
				$del_cat->delete();
				redirect('blog/add_new_category', $data);
			}
			
			$this->form_validation->set_rules('category_name', 'Name', 'required|max_length[200]');
			$this->form_validation->set_rules('category_slug', 'Slug', 'max_length[200]');
			
			
			
			if($this->form_validation->run() == FALSE){
				//non valid category was attempted
				$this->load->view('auth/blog/add_new_category', $data);
				
				
			}else{
				$category = new Categories;
				$category->category_name=$this->input->post('category_name');
				$category->slug = url_title($category->category_name);
				$category->save();
				$this->session->set_flashdata('message', $category->category_name. ' category created');
				redirect('blog/add_new_category', $data);
 
			}
		}
	}
	public function get_post_cats($post_id){
        $cats = Categories::find_by('post_id', $post_id);
        return $cats;
    }
    
    
    public function category($slug=FALSE){
    	$data['title'] = 'Category - '.$this->config->item('site_title', 'ion_auth');
		$data['categories'] = Categories::find_all();
		
		if($slug==FALSE){
			redirect('blog/add_new_category');
			
			
		}else{
			$data['category']=Categories::find_by('slug', $slug);
			$data['query']= $this->posts->get_category_post($slug);
		}
		
		
		$this->load->view('blog/category', $data);
    }
    
    
    public function author($id=FALSE){
    	if($id==FALSE){
			redirect('blog');
		}else{
			$user =$this->ion_auth->user($id)->row();
			$data['title'] = 'Category - '.$this->config->item('site_title', 'ion_auth');
			$data['user'] = $user->username;
			$data['full_name']=ucwords($user->first_name. ' '.$user->last_name);
			$posts=Posts::find_by('author_id', $id);
			if(!is_array($posts)){$data['posts'] = array($posts);
			}else{$data['posts']=$posts;
				
			}
		}
		
		$this->load->view('blog/author', $data);
    }
    
    public function delete_comment($id=NULL){
    	if($id==NULL){
    		redirect('blog');
		}else{
			$comment = Comments::find_by('comment_id', $id);
			$post_id = $comment->post_id;
			if($comment){
				$comment->delete();
				redirect('blog/post/'.$post_id);
			}else{
				$this->session->set_flashdata('Sorry, could not find comment');
				redirect('blog/post/'.$post_id);
				
			}
    	}
    }

	
}