<?php $this->load->view('auth/dressings/header');?>
<?php $this->load->view('auth/dressings/navbar');?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class = "page-header"><?php echo lang('index_heading');?></h1>
            <p><?php echo lang('index_subheading');?></p>
        </div>
        
    <h2>Manage blog posts:</h2>
    <h4><?php echo anchor('blog/add_post', '+Add Post');?></h4>
    <table>
        <?php 
            
	    	echo $post_table;
	    	?>
    </table>
   
   
   
</body>
</html>


<?php $this->load->view('auth/dressings/footer');?>