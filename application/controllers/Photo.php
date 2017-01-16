<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Photo extends MY_Controller{
	var $data;
	
	
	
	function __construct(){
	    parent::__construct();
		$this->load->library(array('form_validation', 'table'));
		$this->load->model(array('images', 'albums'));
		$this->load->helper('general');
		$this->load->library('upload');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        
        
		
		
	}
        
        public function index(){
        	$data['max_file_size'] = 20 * 1048576;
        	if (!$this->ion_auth->logged_in()){
				redirect('auth/login', 'refresh');
			}else{
			
				$data['title']='Upload Photo - '.$this->config->item('site_title', 'ion_auth');
				$this->load->view('auth/blog/photo_upload', $data);
			
			}
        }
        public function add_photo(){
        	if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
			}else{
				if(!empty($_POST)){	
					
					$config['upload_path']          = './uploads/';
                	$config['allowed_types']        = 'gif|jpg|png';
                	$config['max_size']             = 100;
                	$config['max_width']            = 1024;
                	$config['max_height']           = 768;
                	
                	
					$this->load->library('upload', $config);

				}
				
        	}
        }
        
        public function albums(){
        	$data['albums']=$this->albums->find_all();
        	$data['title']='Photo Album Overview - '.$this->config->item('site_title', 'ion_auth');
        	$this->load->view('auth/blog/all_albums', $data);
        }

		public function edit_album($album_id=NULL){
			if (!$this->ion_auth->logged_in()){
				redirect('auth/login', 'refresh');
			}else{
				if($album_id == NULL){
					//add code for creating new album and uploading photos
					echo output_message($this->session->flashdata('message'));
					echo "Hey this is a test for no id";
				}elseif(is_object(Albums::find_by_id($album_id))){
					
					
					echo output_message($this->session->flashdata('message'));
					
					
					if (isset($_POST['submit'])) {
						if (isset($_GET['id'])) {
							//if (isset($_FILES['files'])) {
									$file_array = reArrayFiles($_FILES['files']);
									// Loop $_FILES to exeicute all files
									foreach ($file_array as $file) {     
									    if ($file['error'] == 4) {
									        continue; // Skip file if any error found
									    }else{ // No error found! Move uploaded files 
								        	$photo = new Images();
								        	//$photo->caption = $_POST['caption'];
											$photo->attach_file($file);
											$photo->album_id = $_GET['id'];
											$photo->visible = 1;
											if($photo->save()){
												 //$count++; // Number of successfully uploaded file
												 $message[]=$photo->filename. " Successfully uploaded";
											} else{
												$message[]=join("<br/>",$photo->errors);
											}
								        }
									    
									}
								//}
							$album->album_title = $_POST['album_title'];
							//$album->album_dir = sanitize_filename($_POST['album_title']);
							$album->caption = $_POST['caption'];
							$album->color_tag = $_POST['color_tag'];
							$album->category_id = $_POST['category_id'];
							$album->credit = $_POST['credit'];
							$album->visible=$_POST['visible'];
							$album->featured_photo_id=$_POST['featured'];
					
							//Added option if uploading multiple photos
							if ($album->update()) {
								$session->message($album->album_title." successfully updated");
								redirect_to('add_album.php?id='.$_GET['id']);
							}else{
									//failure
									$message[] = "Failed to update album";
							}
					
					
							//Create completely new album and directory, no photo upload here
						}else{
							$album = new Album();
							$album->album_title = $_POST['album_title'];
							$album->album_dir = sanitize_filename($_POST['album_title']);
							$album->caption = $_POST['caption'];
							$album->category_id = $_POST['category_id'];
							$album->visible=$_POST['visible'];
							$album->credit = $_POST['credit'];
							if ($album->create_album()) {
								//success
								$session->message($album->album_title." successfully created");
								redirect_to('photo/albums');
							}else{
								//failure
								$message = join("<br/>",$album->errors);
							}
						}	
					}
					
					
				}else{
					$this->session->set_flashdata('message', 'No Album Found');
					
					redirect('photo/albums');
				}
		}
		}
		
}