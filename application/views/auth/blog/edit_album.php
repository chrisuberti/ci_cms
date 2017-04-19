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

    <div id="content-outer" class ="clear"><div id="content-wrapper">
        <div id="content"><div class="col-one">
            <?php 
            if(validation_errors()){echo validation_errors('<p class = "error">','</p>');}?>
            <?php echo  ($this->session->flashdata('message')); ?>
            
            <?php echo form_open_multipart('photo/edit_album/'.$album->id);?>
            <div>
                <table>
                    <tr>
                        <td>Album Title: </td>
                        <td><input type="text" name="album_title"/></td>
                    </tr>
                    <tr>
                        <td>Caption: </td>
                        <td><input type="textarea" name="caption"/></td>
                    </tr>
                    <tr>
                        <td>Album Visibility: </td>
                        <td><input type="radio" name = "visible" value="1" <?php echo (($album->visible) ? "checked='checked'": "");?>/>Visible</td>
                        <td><input type="radio" name = "visible" value="0" <?php echo (($album->visible) ? "": "checked='checked'");?>/>Hidden</td>
                    </tr>
                </table>
            </div>
            <br>
            <h4>Album Photos:</h4>

            <?php echo($album_photos); ?>
          </div><!-- Close content -->
        </div>
    </div>
</div>

</body>
	

        <?php $this->load->view('auth/dressings/footer');?>
