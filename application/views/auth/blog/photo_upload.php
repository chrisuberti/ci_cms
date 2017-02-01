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
            
            <?php echo form_open_multipart('photo/upload');?>

            <?php if(validation_errors()){echo validation_errors('<p class = "error">','</p>');}?>
            <?php echo output_message($this->session->flashdata('message'));?>
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
            
            <p>Photo Title: <input type="text" name="pic_title" value=""></p>
            <p>Caption: <input type="text" name="caption" value=""></p>
            	<input type="submit" name="submit" value = "Upload">
            </form>        	
<?php
    if(isset($upload_data)){
        echo "<ul>";
        foreach($upload_data as $item => $value){
            echo '<li>'.$item.':'.$value.'</li>';
        }
        echo "</ul>";
    }
?>
            
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
