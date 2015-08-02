<?php

$our_story = get_post_meta(get_the_ID(),'our_story',true);
$our_gallery = get_post_meta(get_the_ID(),'our_gallery',true);
$title_image = get_post_meta(get_the_ID(),'title_image',true);
if ($title_image){
    $title_image = wp_get_attachment_image_src($title_image['ID'],'medium',false);
}

?>

<div id="gallery-container" class="row"><div id="target"><?php the_content(); ?></div></div>
<div id="underGallery" class="row">
    <div class="col-md-offset-0 col-md-6 col-sm-offset-0 col-sm-6">
        <h1 class="title"><?php the_title(); ?><img id="titleImage" src="<?php echo $title_image[0]; ?>" width="<?php echo $title_image[1]; ?>" height="<?php echo $title_image[2] ?>" /></h1>
    </div>
    <div class="col-md-5 col-sm-5">

        <?php if (!empty($our_story)): ?>
            <div id="ourStoryDescription"><?php echo $our_story; ?></div>
        <?php endif; ?>
    </div>
</div>

