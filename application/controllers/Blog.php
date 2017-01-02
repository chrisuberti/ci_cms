<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller{

	function __construct(){
	    parent::__construct();
		$this->load->library(array('form_validation', 'table'));
		$this->load->model(array('posts', 'categories', 'post_category_relations'));
		$this->load->helper('general');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        }
        
       
	public function index(){
		$data['title']='Home - '. $this->config->item('site_title', 'ion_auth');
		$data['current']='HOME';
		
		$data['query']=$this->posts->find_all();
		$data['categories']=$this->posts->get_categories();
		$this->load->view('blog/index',$data);
		
	}
	public function add_post(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
			}else{
				if(isset($_POST)){	
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
	
		public function post($id){
			$data['query']=$this->posts->get_post($id);
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
					$name= $this->input->post('commentor');
					$email = strtolower($this->input->post('email'));
					$comment = $this->input->post('comment');
					$post_id = $this->input->post('id');
					
					$this->posts->add_new_comment($id, $name, $email, $comment);
					$this->session->set_flashdata('message', '1 new comment added!');
					redirect('blog/', $id);
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

	
}