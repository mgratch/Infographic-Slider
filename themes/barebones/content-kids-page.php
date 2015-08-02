<?php
$description = get_the_content();
$show_title = get_post_meta(get_the_ID(),'show_title',true);
?>
<div class="col-xs-3 col-sm-3 col-md-3 col">
    <?php if(has_post_thumbnail()): ?>
        <div class="comicStyle"><?php the_post_thumbnail('large',array(
                'id' => 'kidsImg',
            )); ?></div>
    <?php endif; ?>
</div>
<div class="col-xs-7 col-xs-offset-1 col-sm-7 col-sm-offset-1 col-md-7 col-md-offset-1 col">
    <?php if($show_title === '1'): ?>
        <span class="line line-1"><?php the_title('<h1 class="title">','</h1>'); ?>
    <?php else: ?>
        <span class="line line-1">
    <?php endif; ?>
    <?php if(!empty($description)): ?>
        <?php the_content(); ?></span>
    <?php endif; ?>
</div>