<?php $this->load->view('auth/dressings/header');?>
<?php $this->load->view('auth/dressings/navbar');?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class = "page-header"><?php echo lang('index_heading');?></h1>
            <p><?php echo lang('index_subheading');?></p>
        </div>
        	<h3>Category: </h3>
			<?php if(is_array($category)): foreach($category as $row):?>
				<h2><a href="<?php echo base_url().'category/'.$row->slug;?>"><?php echo ucwords($row->category_name);?></a> (Posts: <?php echo count($query);?>)</h2>
				<?php endforeach;?>
			<?php else: ?>
			<?php $row = $category;?>
			<h2><a href="<?php echo base_url().'category/'.$row->slug;?>"><?php echo ucwords($row->category_name);?></a> (Posts: <?php echo count($query);?>)</h2>
			<?php endif;?>
			<?php echo form_open('blog/add_new_category/delete/'.$row->id).form_submit('submit', 'Delete').form_close();?>
			
			<hr>
			<h4>Related Posts:</h4>
			<?php if( isset($query) && $query ): ?>
			<ul>
			<?php foreach($query as $post):?>
				<li><?php echo $post->title?> -- <a href="<?php echo base_url().'post/'.$post->id;?>">Edit</a></li>
			<?php endforeach; ?>
			</ul>
				
			<?php else: ?>
			<h3>No post yet!</h3>
			<?php endif;?>
			
		</div></div>
		
		<!-- column-two -->
		<?php// $this->load->view('blog/menu_sidebar');?>
		
		<!-- column-three -->
		<?php// $this->load->view('blog/sidebar');?>
	
	<!-- contents end here -->	
	</div></div>

	<!-- footer starts here -->	
	<?php $this->load->view('auth/dressings/footer');?>
	<!-- footer ends here -->

</body>
</html>