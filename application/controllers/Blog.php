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
	public function add_new_entry(){
		if (!$this->ion_auth->logged_in()){redirect('auth/login', 'refresh');}
		else{
			$data['title']='Add new entry - '.$this->config->item('site_title', 'ion_auth');
			$data['categories']=$this->posts->get_categories();
			// redirect them to the home page because they must be an administrator to view this
			$this->form_validation->set_rules('entry_name', 'Title', 'required|xss_clean|max_length[200]');
			$this->form_validation->set_rules('entry_body', 'Body', 'required|xss_clean');
			$this->form_validation->set_rules('entry_category', 'Category', 'required|xss_clean');
			
			if ($this->form_validation->run()==FALSE){
				//not valid
				$this->load->view('blog/add_new_entry', $data);
			}else{//form validation works
				$user = $this->ion_auth->user()->row();
				$name = $this->input->post('entry_name');
				$body= $this->input->post('entry_body');
				$categories = $this->input->post('entry_category');
				
				$this->posts->add_new_entry($user->id, $name, $body, $categories);
				$this->session->set_flashdata('message', '1 New Entry Added!');
				redirect('blog/add_new_entry');
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
		
		public function add_new_category(){
			$data['title']='Add new category - '. $this->config->item('site_title', 'ion_auth');
			if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			$this->form_validation->set_rules('category_name', 'Name', 'required|max_length[200]|xss_clean');
			$this->form_validation->set_rules('category_slug', 'Slug', 'max_length[200]|xss_clean');
			
			if($this->form_validation->run() == FALSE){
				//non valid category was attempted
				$this->load->view('auth/blog/add_new_category', $data);
			}else{
				$name=$this->input->post('category_name');
				if( $this->input->post('category_slug') != '' ){
					$slug = $this->input->post('category_slug');
				}else{
					$slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));
				}
				
				$this->posts->add_new_category($name, $slug);
				$this->session->set_flashdata('message', '1 new comment added');
				redirect('blog/add-new-category');
 
			}
		}
	}
	public function get_post_cats($post_id){
        $cats = Categories::find_by('post_id', $post_id);
        return $cats;
    }

	
}