<?php $this->load->view('dressings/header');?>
<?php $this->load->view('dressings/navbar');?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class = "page-header"><?php echo lang('index_heading');?></h1>
            <p><?php echo lang('index_subheading');?></p>
        </div>
        
    <h2>Manage blog posts:</h2>
    <table>
        <?php 
            $this->table->set_template(array('table_open'=>"<table class='table table-striped table-bordered table-hover' id='post_summary_table'>"));
	    	$this->table->set_heading('Post', 'Author', 'Categories', 'Comments');
	    	if($query){
	    	    foreach($query as $post){
	    	        $author = $this->ion_auth->user($post->author_id)->row();
	    	        $cat_relation = Post_category_relation::find_by('post_id', $post->id);
	    	        foreach($cat_relation as $relate){
	    	            $categories[]=Categories
	    	        }
	    	        $num_comms = count(Comments::find_by('post_id', $post->id));
	    	        $this->table->add_row($post_title, $author_name, $comments, pretty_date($post->date));
	    	    }
	    	}
	    	?>
    </table>
    <?php //$this->load->view('blog/menu');?>
    <?php  if($query):foreach($query as $post):?>
    <h3><a href="post/<?php echo $post->id;?>"><?php echo $post->title; ?></a></h3>
    <h5>(<?php echo pretty_date($post->date);?>)</h5>
    <div><p><?php echo $post->content;?></p></div>
    <?php endforeach; else:?>
    <h4>No entries yet!</h4>
    <?php endif;?>
</body>
</html>