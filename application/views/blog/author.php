
<?php $this->load->view('blog/header');?>
<body>

	<!-- header top starts-->
	<!-- header top ends here -->
	
	<!-- content starts -->
	<div id="content-outer" class="clear"><div id="content-wrapper">
	
		<!-- column-one -->
		<div id="content"><div class="col-one">
			<h2>Author: <?php echo $full_name;?> (<?php echo count($posts);?> Posts)</h2>

			<?php if( isset($posts) && $posts ): ?>
			<ul>
			<?php foreach($posts as $post):?>
				<li><a href="<?php echo base_url().'post/'.$post->id;?>"><?php echo $post->title?></a></li>
			<?php endforeach; ?>
			</ul>
				
			<?php else: ?>
			<h3>No post yet!</h3>
			<?php endif;?>
			
		</div></div>
		

	<!-- contents end here -->	
	</div></div>

	<!-- footer starts here -->	
	<?php $this->load->view('blog/footer');?>
	<!-- footer ends here -->

</body>
</html>