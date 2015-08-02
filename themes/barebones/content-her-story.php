<?php
$title_image = get_post_meta(get_the_ID(),'title_image',true);
$title_image = wp_get_attachment_image_src($title_image['ID'],'medium',false);
?>

<div class="outerBox">
    <?php the_title('<h1 class="title">',"<img id='titleImage' src='$title_image[0]' width='$title_image[1]' height='$title_image[2]' /></h1>"); ?>
    <?php the_post_thumbnail('full',array(
        'id' => 'herImage'
    )); ?>
    <div id="herStoryContent" class="description"><?php the_content(); ?></div>
</div>