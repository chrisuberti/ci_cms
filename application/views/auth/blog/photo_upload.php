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
            <p><input type="file" name="file_upload[]" id="imgUpload" class="form-control" multiple/></p>
            <div id ='upload_img'></div>
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
    <div class="row">
        <ul class="gallery">
            
            <?php if(!empty($files)): foreach($files as $file): ?>
            <li class="item">
                <img src="<?php echo base_url($file->image_path()); ?>" alt="" width=20%>
                <p>Uploaded On <?php echo date("j M Y",strtotime($file->pub_date)); ?></p>
            </li>
            <?php endforeach; else: ?>
            <p>Image(s) not found.....</p>
            <?php endif; ?>
        </ul>
    </div>
            
    </div>
    </div>
    </div>
    </div>
</body>
	
<script type= "text/javascript">
	  
document.getElementById("imgUpload").onchange = function () {
    var reader = new FileReader();
    
    reader.onload = function (e) {
        for(i = 0; i<e.length; i++){
            alert(i);
            // get loaded data and render thumbnail.
            var elem = document.createElement("img");
            elem.src= e[i].target.result;
            elem.setAttribute("width", "20%");
            //elem.setAttribute("width", "1024");
            elem.setAttribute("alt", "");
            document.getElementById("upload_img").appendChild(elem);
        }
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
</script>

        <?php $this->load->view('auth/dressings/footer');?>
