<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
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