<?php
$title_image = get_post_meta(get_the_ID(),'title_image',true);
$title_image = wp_get_attachment_image_src($title_image['ID'],'medium',false);
?>

<div class="outerBox">
    <?php the_title('<h1 class="title">','</h1>'); ?>
    <img id="titleImage" class="rsImg" src="<?php echo $title_image[0]; ?>" width="<?php echo $title_image[1]; ?>" height="<?php echo $title_image[2] ?>" data-rsw="<?php echo $title_image[1]; ?>" data-rsh="<?php echo $title_image[2] ?>" />
    <?php the_post_thumbnail('full',array(
        'id' => 'hisImage',
        'class' => 'rsImg'
    )); ?>
    <div id="hisStoryContent" class="description"><?php the_content(); ?></div>
</div>