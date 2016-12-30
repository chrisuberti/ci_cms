<?php $this->load->view('blog/header');?>
<body>

	<!-- header top starts-->
	<!-- header top ends here -->
	
	<!-- content starts -->
	<div id="content-outer" class="clear"><div id="content-wrapper">
	
		<!-- column-one -->
		<div id="content"><div class="col-one">
			<h2>Category: <a href="<?php echo base_url().'category/'.$category->slug;?>"><?php echo ucwords($category->category_name);?></a> (<?php echo count($query);?>)</h2>

			<?php if( isset($query) && $query ): ?>
			<ul>
			<?php foreach($query as $post):?>
				<li><a href="<?php echo base_url().'post/'.$post->id;?>"><?php echo $post->title?></a></li>
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
	<?php $this->load->view('blog/footer');?>
	<!-- footer ends here -->

</body>
</html>