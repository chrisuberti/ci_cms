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
            <?php 
            if(validation_errors()){echo validation_errors('<p class = "error">','</p>');}?>
            <?php echo output_message($this->session->flashdata('message'));?>
         
            <?php echo form_open('blog/edit_post/'.$id);?>
            <p><strong>Title</strong>:<br />
			<input type="text" name="post_title" size="60" value = "<?php echo $post_title?>" /></p>
            <br clear="all" />
            
            <p><strong>Body</strong>: (HTML mode)</p>
            <textarea rows="6" cols="80%" name="content" style="resize:none;" value =""><?php echo $content;?></textarea>
            
            
            <br clear="all" />
            <?php echo form_multiselect('post_cats[]', $categories, $sel_cats);?>
            
            <p><input type="submit" value="Update" /></p>
            <?php echo form_close(); ?>
            <hr>
            <h4>Comments:</h4>
            <div>
            <?php if($comments): foreach($comments as $com):?>
                <div class="comment">
                    <div>
                        <strong><?php echo ucwords($com->comment_name);?> (on <?php echo pretty_date($com->comment_date);?>):</strong>
                    </div>
                    <div><?php echo $com->comment_body; ?></div>
                    <div>
                        <?php if ($this->ion_auth->is_admin()){
                        echo form_open('blog/delete_comment/'.$com->comment_id);
                        echo form_submit('delete', 'Delete Comment');
                        echo form_close();
                        }?>
                    </div>
                </div>
            </div>
             <?php endforeach; endif;?>
            
            <hr />
        </div><!-- Close content -->
        </div>

</body>
	
<?php $this->load->view('auth/dressings/footer');?>
