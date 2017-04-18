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
    </div>

    <div id="content-outer" class ="clear"><div id="content-wrapper">
        <div id="content"><div class="col-one">
            <?php echo form_open_multipart('photo/add_album');?>

            <?php if(validation_errors()){echo validation_errors('<p class = "error">','</p>');}?>
            <?php echo output_message($this->session->flashdata('message'));?>
      <table style = "text-align: center">
    	<tr><p><td>Album Title:</td><td><input type="text" name="album_title" maxlength = "40"></td><td>What is displayed to user on site</td></tr></p>
    	<tr><p><td>Album Directory:</td><td> Set based on above </td><td> (cannot be changed once set)</td></tr></p>
    	<tr><p><td>Album Caption:</td><td> <input type="textarea" name="caption"/></td><td></td></tr></p>
    	<tr><p><td>Album Visibility:</td><td>
                <input type="radio" name="visible" value= "1" checked="checked">Visible</td><td> 
                <input type="radio" name="visible" value= "0">Hidden</td></tr></p>
         <tr><td>Featured Image: </td><td><input type="file" name="file_upload" id="imgUpload" class="form-control"/></td><td><img id="blah" src="#" alt="featured image"></img></td></tr>
         <tr><td><input type="submit" name="submit" value = "Create"></td></tr>
         
                </form>        	      
    </div>
            
    </div>
    </div>
    </div>
    </div>
    </div>
</body>
<script type="text/javascript" src="">
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgUpload").change(function(){
        readURL(this);
    });
</script>
<?php $this->load->view('auth/dressings/footer');?>
