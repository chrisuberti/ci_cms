<?php $this->load->view('auth/dressings/header');?>
<?php $this->load->view('auth/dressings/navbar');?>

<!-- Added these scripts to beautify textarea's-->


<body>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class = "page-header"><?php echo $title;?></h1>
            <p><?php echo lang('index_subheading');?></p>
        </div>

    <div id="content-outer" class ="clear"><div id="content-wrapper">
        <div id="content"><div class="col-one">
           
            <form action="photo/add_photo" enctype="multipart/form-data" method="POST" runat="server">
            	<input type="hidden" name = "MAX_FILE_SIZE" value = <?php echo $max_file_size; ?>>
            	<p><input type="file" name="file_upload" multiple = "multiple" id="imgInp" style="width:20%;"></p>
            	<img src="#" id ='upload_img'/>
            	<p>Album:
            	<select name="album_id">
            		<?php 
            			$albums = (array) Albums::find_all();
            			foreach ($albums as $album) {
            				echo "<option value='". $album->id."'>". $album->album_title."</option>";
            			}
            		 ?>
            	</select></p>
            	<input type="radio" name="visible" value= "1" checked="checked">Visible
            	<input type="radio" name="visible" value= "0">Hidden
            
            
            	<p>Caption: <input type="text" name="caption" value=""></p>
            		<input type="submit" name="submit" value = "Upload">
            	</form>
            	
    </form>
            
    </div>
    </div>
    </div>
    </div>
</body>
	
<script type= "text/javascript">
	  
	 function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#upload_img').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>

        <?php $this->load->view('auth/dressings/footer');?>
