<?php

$our_registry = get_the_title();
$registry_link = get_post_meta(get_the_ID(),'link_to_registry',true);
$registry_image = get_post_meta(get_the_ID(),'image',true);
$registry_image = wp_get_attachment_image_src($registry_image['ID'],'medium',false);
$sani_title = sanitize_title($our_registry);

?>
<div id="<?php echo $sani_title; ?>" class="a-fourth">
    <a href="<?php echo $registry_link; ?>" target="_blank">
        <img id="<?php echo $sani_title."-img"; ?>" class="registryImg" src="<?php echo $registry_image[0]; ?>" width="<?php echo $registry_image[1]; ?>" height="<?php echo $registry_image[2] ?>" />
    </a>
</div>
