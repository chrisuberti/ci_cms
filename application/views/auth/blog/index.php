<?php $this->load->view('dressings/header');?>
<?php $this->load->view('dressings/navbar');?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class = "page-header"><?php echo lang('index_heading');?></h1>
            <p><?php echo lang('index_subheading');?></p>
        </div>
        
    <h2>This is the blog</h2>
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