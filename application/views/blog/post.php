<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<!-- Everything above will eventually be wrapped in blog header-->

<body>
    <?php //$this->load->view('blog/menu');?>
    <?php  if($query): foreach($query as $post):    ?>
    <h2><a href="<?php echo base_url().'post/'.$post->id;?>"><?php echo $post->title;?></a></h2>
        <p class="post-date"><?php echo pretty_date($post->date);?></p>
        
        <p class="post-info">Posted by: <a href="#"><?php $author = $this->ion_auth->user($post->author_id)->row(); echo ucfirst($author->username);?></a>
        | Filed under <?php $item = $this->post_category_relations->find_by('post_id', $post->id); 
       
        foreach($item as $cat): ?>
        <?php $category = Categories::find_by_id($cat->category_id);?>
        <a href="<?php echo base_url().'category/'.$category->slug;?>"><?php echo $category->category_name;?></a> <?php endforeach;?></p>
        
    <div><?php echo $post->content; ?></div>
    
    <hr>
    <p class="postmeta">
        <h3>Comments (<?php echo $total_comments;?>)</h3>
        <?php if($comments): foreach($comments as $com):?>
            <div class="comment">
                <div>
                    <strong><?php echo ucwords($com->comment_name);?> (on <?php echo pretty_date($com->comment_date);?>):</strong>
                </div>
                <div><?php echo $com->comment_body; ?></div>
            </div>
    </p>
        <?php endforeach; else:?>
            <h4>No entries yet!</h4>
        <?php endif;?>
        <?php endforeach; else:?>
        <h4>No entries yet!</h4>
        <?php endif;?>
</body>
</html>