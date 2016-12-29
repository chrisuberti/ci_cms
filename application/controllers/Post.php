<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller{

	function __construct(){
	    parent::__construct();
		$this->load->library(array('form_validation', 'table'));
		$this->load->model('posts');
		$this->load->helper('general');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        }
        
       
	public function index(){
		$data['query']=$this->posts->find_all();
		$this->load->view('blog/index',$data);
		
	}
	public function add_new_entry(){
		$this->form_validation->set_rules('entry_name', 'Title', 'required|xss_clean|max_length[200]');
		$this->form_validation->set_rule('entry_body', 'Body', 'required|xss_clean');
		
		if ($this->form_validation->run()==FALSE){
			//not valid
			$this->load->view('blog/add_new_entry');
		}else{
			$name = $this->input->post('entry_name');
			$body= $this->input->post('entry_body');
			$this->blog_model->add_new_entry($name, $body);
			$this->session->set_flashdata('message', '1 New Entry Added!');
			redirect('post/add_new_entry');
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
					redirect('post/', $id);
				}
			}else{
				show_404();
			}
			
		}
		
		
	}