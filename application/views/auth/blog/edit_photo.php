<?php $this->load->view('auth/dressings/header');?>
<?php $this->load->view('auth/dressings/navbar');?>

<!-- Added these scripts to beautify textarea's-->


<body>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class = "page-header"><?php echo $title;?></h1>
            <p><?php echo lang('index_subheading');?></p>
            <p><?php echo anchor('photo/albums', "Return to All Albums");?></p>
        </div>
    </div>
    
    <div class="row">
    <div id="content-outer" class ="clear">
        <div id="content-wrapper">
            <div id="content">
                <div class="col-md-6">
                    <?php 
                    if(validation_errors()){echo validation_errors('<p class = "error">','</p>');}?>
                    <?php echo  ($this->session->flashdata('message')); ?>
                    
                    <?php echo form_open_multipart('photo/edit_img/'.$photo->id);?>
                        <div>
                            <table class='table table-bordered'>
                                <tr>
                                    <td>Album Title: </td>
                                    <td><input type="text" name="title" value = "<?php echo $photo->title;?>"/></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Caption: </td>
                                    <td><input type="textarea" name="caption" value = "<?php echo $photo->caption;?>"/></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Album Visibility: </td>
                                    <td><input type="radio" name = "visible" value="1" <?php echo (($photo->visible) ? "checked='checked'": "");?>/>Visible</td>
                                    <td><input type="radio" name = "visible" value="0" <?php echo (($photo->visible) ? "": "checked='checked'");?>/>Hidden</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <td><?php echo form_submit('submit', 'Update');?></td>
                                    <td></td>
                                    <td><?php echo $del_button;?></td>
                                </tr>
                            </table>
                        </div>
          </div><!-- Close content -->
          <div class="col-md-6">
              <td></td>
              <td><?php echo $feat_photo;?></td>
              
          </div>
          
        </div>
    </div>
</div>
</div>
<div class="row">
              
          </div>

</body>
	

        <?php $this->load->view('auth/dressings/footer');?>
