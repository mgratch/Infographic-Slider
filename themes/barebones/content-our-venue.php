<?php
$description = get_the_content();
$show_title = get_post_meta(get_the_ID(),'show_title',true);
?>
<div class="col-md-10 col-md-offset-1">
    <?php if(has_post_thumbnail()): ?>
        <div class="comicStyle"><?php the_post_thumbnail('full',array(
            'id' => 'venueImage',
            'class' => 'rsImg'
        )); ?></div>
    <?php endif; ?>
    <?php if($show_title === '1'): ?>
        <span class="line"><?php the_title('<h1 class="title">','</h1>'); ?>
    <?php else: ?>
        <span class="line">
    <?php endif; ?>
    <?php if(!empty($description)): ?>
        <?php the_content(); ?></span>
    <?php endif; ?>
</div>
<a class="go-back" href="#" ><?php echo __('&#9668; Go Back','barebones'); ?></a>

