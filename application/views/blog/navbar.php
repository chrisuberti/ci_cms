<div class="col-two">
			
			<?php if ( ! $this->ion_auth->logged_in() ):?>
			<h3>Sidebar Menu</h3>
			<ul class="sidemenu">
				<li><a href="<?php echo base_url().'auth/login';?>">Login</a></li>
				<li><a href="<?php echo base_url().'about';?>">About</a></li>
				<li><a href="http://www.pisyek.com" rel="follow" target="_blank">Contact</a></li>
			<?php else: ?>
			<h3>Admin Menu</h3>
			<ul class="sidemenu">
				<li><a href="<?php echo base_url().'auth/';?>">Dashboard</a></li>
				<li><a href="<?php echo base_url().'add_new_entry';?>">Add new entry</a></li>
				<li><a href="<?php echo base_url().'add_new_category';?>">Add new category</a></li>
				<li><a href="<?php echo base_url().'auth/logout';?>">Logout</a></li>
			<?php endif; ?>
				
			</ul>

            <?php if( isset($categories) && $categories ):?>
			<h3>Category</h3>
			<ul class="sidemenu">
			<?php foreach( $categories as $category ):?>
				<li><a href="<?php echo base_url().'category/'.$category->slug;?>"><?php echo $category->category_name;?></a></li>
			<?php endforeach; ?>
			</ul>
			<?php endif; ?>
				

		</div>