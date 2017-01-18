        <?php 
		$this->load->model(array('posts', 'categories', 'post_category_relations', 'comments'));?>
        
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Admin Dashboard by Radical Design</a>
            </div>
            
            
            
            
            
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right"> 

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url('auth/edit_user').'/'.$this->ion_auth->get_user_id();?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href=<?php echo site_url('auth/logout');?>><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->












            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                           <?php echo anchor('blog/admin_dash', '<i class = "fa fa-dashboard fa-fw"></i>Dashboard'); ?>
                        </li>
                        
                        
                        
                        <li>
                           <?php echo anchor('blog/admin_dash', '<i class = "fa fa-telegram fa-fw"></i>Posts'); ?>
                        </li>
                        
                        
                        
                        <li>
                        <a href="#"><i class = "fa fa-coffee fa-fw"></i>Categories<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php $categories= Categories::find_all();?>
                                <li>
                                    <?php echo anchor('blog/add_new_category', 'View All');?>
                                </li>
                                <?php foreach($categories as $cat):?>
                                <li>
                                    <?php echo anchor('blog/category/'.$cat->slug, $cat->category_name);?>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                        
                        
                        
                        
                        
                        
                        <li>
                        <a href="#"><i class = "fa fa-picture-o fa-fw"></i>Albums<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php $albums= Albums::find_all();?>
                                <li>
                                    <?php echo anchor('photo/albums', 'View All');?>
                                </li>
                                <?php foreach($albums as $album):?>
                                <li>
                                    <?php echo anchor('photo/edit_album/'.$album->id, $album->album_title);?>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                        <li>
                        <a href="#"><i class = "fa fa-picture-o fa-fw"></i>Images<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <?php echo anchor('photo/all_imgs', 'View All');?>
                                </li>
                                <?php foreach($albums as $album):?>
                                <li>
                                    <?php echo anchor('photo/add_photo', 'Add Photo');?>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                        
                        <li>
                            <?php echo anchor('auth/index', '<i class = "fa fa-users fa-fw"></i>Users'); ?>
                        </li>
                        
                    


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
