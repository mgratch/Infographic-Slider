<?php
$description = get_the_content();
$show_title = get_post_meta(get_the_ID(),'show_title',true);
?>
<?php if(has_post_thumbnail()): ?>
    <div class="comicStyle"><?php the_post_thumbnail('large',array(
            'id' => 'kidsImg',
            'class' => 'rsImg'
        )); ?></div>
<?php endif; ?>
<?php if($show_title === '1'): ?>
    <span class="line line-1"><?php the_title('<h1 class="title">','</h1>'); ?>
<?php else: ?>
    <span class="line line-1">
<?php endif; ?>
<?php if(!empty($description)): ?>
    <?php the_content(); ?></span>
<?php endif; ?>