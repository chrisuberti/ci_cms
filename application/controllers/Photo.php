<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Photo extends MY_Controller{

	
	
	
	function __construct(){
	    parent::__construct();
		$this->load->library(array('form_validation', 'table'));
		$this->load->model(array('images', 'albums'));
		$this->load->helper('general');
		$this->load->library('upload');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        
        $data['title']='Photos - '.$this->config->item('site_title', 'ion_auth');
		
        
        $this->load->vars($data);
		
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
        
        public function all_imgs(){
        	if (!$this->ion_auth->logged_in()){
				redirect('auth/login', 'refresh');
			}else{
				$this->table->set_template(array('table_open'=>"<table class='table table-striped table-bordered table-hover' id='post_summary_table'>"));
		    	$this->table->set_heading('Image',array('data'=>'&nbsp', 'style'=>'width:20%'), 'Album', 'Size', 'Date Published', '');
		    	$images = $this->images->find_all();
		    	if($images){
		    		foreach($images as $photo){
		    			$album = $this->albums->find_by_id($photo->album_id);
		    			$title = $photo->title . "<br>".anchor('photo/edit/'.$photo->id, 'Edit');
		    			
		    			
		    			$image_config = array(
		    				//'src'	=>	'uploads/'.$album->album_dir . '/'.$photo->filename,
		    				'src'	=>	$photo->image_path(),
		    				'alt'	=>	$photo->caption,
		    				'class'	=>	'admin_img',
		    				'width'	=>	'100%',
		    				'height'=>'auto',
		    				'title'	=>	$photo->title);
		    			$image = "<div>". img($image_config);
		    			$image .= "</div>".$photo->caption;
		    			
		    			$album_name = $album->album_title;
		    			$size = $photo->size_as_text();
		    			$date_published = pretty_date($photo->pub_date);
		    			$del_button = form_open('photo/del_img/'.$photo->id);
		    			$del_button .= form_submit('del_img', 'Delete', array("onClick"=>"return deleteconfirm();"));
		    			$del_button .= form_close();
		    			
		    			$this->table->add_row($title, $image, $album->album_title, $size, $date_published, $del_button);
		    		}
		    		$data['image_table'] = $this->table->generate();
		    	}else{
		    		$data['image_table'] = anchor('photo/upload', 'No Images, add some!');
		    	}
		    $this->load->view('auth/blog/all_imgs', $data);	
	   
	        }
        }
        
        public function del_img($id = NULL, $album=NULL){
        	if($photo=Images::find_by_id($id)){
        		$photo->destroy();
        		$photo->delete();
        		$this->session->set_flashdata('message', $photo->title. ' Deleted');
        		if(isset($album)){
        			redirect('photo/edit_album/'.$album);
        		}else{
        			redirect('photo/all_imgs');
        		}
        	}else{
        		$this->session->set_flashdata('message','Photo not found');
        		redirect('photo/all_imgs');
        		
        	}
        	
        }



        public function upload(){
        if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}else{
			$data['title']='Upload Photo - '.$this->config->item('site_title', 'ion_auth');
				
        	if(!empty($_POST)){
        		$this->agnostic_photo_upload();
	        	}

        		$data['files']=$this->images->find_all();
        		$this->load->view('auth/blog/photo_upload', $data);
        	}
    	}
        
      

	
        public function albums(){
        	$data['albums']=$this->albums->find_all();
        	$data['title']='Photo Album Overview - '.$this->config->item('site_title', 'ion_auth');
        	
        	$images = $this->albums->find_all();
        	$data['albums']=$this->albums->create_album_table();
        	
        	
        	$this->load->view('auth/blog/all_albums', $data);
        	
        	
        	
        }
        
        
        public function add_album(){
	        if(isset($_POST['submit'])){
				$album = new Albums();
				$album->album_title = $_POST['album_title'];
				$album->album_dir = sanitize_filename($_POST['album_title']);
				$album->caption = $_POST['caption'];
				$album->visible=$_POST['visible'];
				////Upload featured Photo
					$_POST['pic_title']= $album->album_title;
					$_POST['album_id']= 1;
					$_POST['visible'] = $album->id;;
					$photo_id = $this->agnostic_photo_upload();
					$album->featured_photo_id = $photo_id;
				
				
				if ($album->save()) {
				
					$this->session->set_flashdata('message', 'Album Created');
					redirect_to('photo/albums');
				}else{
					//failure
					$this->session->set_flashdata('message', join("<br/>",$album->errors));
			      	$this->load->view('auth/blog/add_album');
				}
	        }
        }

		public function edit_album($album_id=NULL){
			if (!$this->ion_auth->logged_in()){
				redirect('auth/login', 'refresh');
			}else{
				if($album_id == NULL){
					$this->session->set_flashdata('message', 'No Album Found');
					
					redirect('photo/new_album');
				}elseif(is_object(Albums::find_by_id($album_id))){

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
					$data['album'] = $this->albums->find_by_id($album_id);
					$data['album_photos']=$this->images->edit_photos_album($album_id);
					
					$this->load->view('auth/blog/edit_album', $data);
				}
		}
		}
	
		public function agnostic_photo_upload(){
    		$fileCount = count($_FILES['file_upload']['name']);
    		var_dump($_FILES['file_upload']);
        	for($i=0; $i<$fileCount; $i++){	
        		$_FILES['userFile']['name']= $_FILES['file_upload']['name'][$i];
		        $_FILES['userFile']['type']= $_FILES['file_upload']['type'][$i];
		        $_FILES['userFile']['tmp_name']= $_FILES['file_upload']['tmp_name'][$i];
		        $_FILES['userFile']['error']= $_FILES['file_upload']['error'][$i];
		        $_FILES['userFile']['size']= $_FILES['file_upload']['size'][$i];
        		
        		
        		
        		$photo = new Images;
				$photo->caption = $_POST['caption'];
				$photo->title = $_POST['pic_title'];
				$photo->album_id = $_POST['album_id'];
				$photo->visible = $_POST['visible'];
        		$album_slug = $this->albums->find_by_id($photo->album_id)->album_dir;
        		
	    	    $config['upload_path']          = "./".$photo->image_path();
	            $config['allowed_types']        = 'gif|jpg|png';
	            $config['max_size']             = 100000;
	            $config['max_width']            = 4024;
	            $config['max_height']           = 3768;
	            $config['overwrite']			= TRUE;
	            
	            //need to swith all multiple file variables over to $_file['doupload'] in order for CI thing to work.
	            
	            
	            
	            $this->upload->initialize($config);
	            $data['error']=NULL;
	            
	           
				
			
	            if(!$this->upload->do_upload('userFile')){
	            	$this->session->set_flashdata('message',$this->upload->display_errors());
	            	$data['photo_info'] = $config;
	            	return false;
	            	//$this->load->view('auth/blog/photo_upload', $data);
	            }else{
	            	$data['upload_data']=$this->upload->data();
	            	$photo->filename = $this->upload->data('file_name');
					$photo->type = $this->upload->data('image_type');
					$photo->size = $this->upload->data('file_size')*1048576;
					$photo->size = $photo->size_as_text();
		            
		            $data['photo']=$photo;
	            	$photo->save();
	            	$this->session->set_flashdata('message', 'Uploaded Multiple Photosg');
	            	return $photo->id;
	            	
	            }
	            
        	}
	}
	
}