<?php

$our_story = get_post_meta(get_the_ID(),'our_story',true);
$our_gallery = get_post_meta(get_the_ID(),'our_gallery',true);
$title_image = get_post_meta(get_the_ID(),'title_image',true);
$title_image = wp_get_attachment_image_src($title_image['ID'],'medium',false);
$home_ID = 15;
$logo = get_post_meta($home_ID,'logo',true);
$logo = wp_get_attachment_image_src($logo['ID'], 'large',false);

?>

<?php echo $our_gallery; ?>
<div id="underGallery"">
    <h1 class="title"><?php the_title(); ?><img id="titleImage" class="rsImg" src="<?php echo $title_image[0]; ?>" width="<?php echo $title_image[1]; ?>" height="<?php echo $title_image[2] ?>" data-rsw="<?php echo $title_image[1]; ?>" data-rsh="<?php echo $title_image[2] ?>" /></h1>
    <?php if (!empty($our_story)): ?>
        <div id="ourStoryDescription"><?php echo $our_story; ?></div>
    <?php endif; ?>
    <span id="logo-box" class="rsABlock" data-move-effect="bottom" data-move-offset="600"><img id="logo" class="rsImg" src="<?php echo $logo[0]; ?>" width="<?php echo $logo[1]; ?>" height="<?php echo $logo[2] ?>" data-rsw="<?php echo $logo[1]; ?>" data-rsh="<?php echo $logo[2] ?>" /></span>
</div>

