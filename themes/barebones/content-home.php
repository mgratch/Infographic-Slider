<?php
$line_1 = get_post_meta(get_the_ID(),'line_1',true);
$line_2 = get_post_meta(get_the_ID(),'line_2',true);
$line_3 = get_post_meta(get_the_ID(),'line_3',true);
$wedding_date = get_post_meta(get_the_ID(),'wedding_date',true);
$left_image = get_post_meta(get_the_ID(),'left_image',true);
$left_image = wp_get_attachment_image_src($left_image['ID'],'large',false);
$right_image = get_post_meta(get_the_ID(),'right_image',true);
$right_image = wp_get_attachment_image_src($right_image['ID'],'large',false);
$logo = get_post_meta(get_the_ID(),'logo',true);
$logo = wp_get_attachment_image_src($logo['ID'], 'large',false);
global $the_post_ID;

?>
<div id="homeRow">
    <?php $post = get_post($the_post_ID); ?>
    <?php if(post_password_required($post)): ?>
        <?php echo get_the_password_form($post); ?>
    <?php else: ?>
        <div class="left a-third">
            <img id="leftImage" class="rsImg" src="<?php echo $left_image[0]; ?>" width="<?php echo $left_image[1]; ?>" height="<?php echo $left_image[2] ?>" data-rsw="<?php echo $left_image[1]; ?>" data-rsh="<?php echo $left_image[2] ?>"	/>
        </div>
        <div class="middle a-third">
            <span class="rsABlock" data-move-effect="top" data-move-offset="600"><img id="logo" class="rsImg" src="<?php echo $logo[0]; ?>" width="<?php echo $logo[1]; ?>" height="<?php echo $logo[2] ?>" data-rsw="<?php echo $left_image[1]; ?>" data-rsh="<?php echo $left_image[2] ?>" /></span>
            <span class="line-1"><?php echo $line_1; ?></span>
            <span class="line-2"><?php echo $line_2; ?></span>
            <span class="line-3"><?php echo $line_3; ?></span>
            <span class="wedding-date"><?php echo $wedding_date; ?></span>
        </div>
        <div class="left a-third">
            <img id="rightImage" class="rsImg" src="<?php echo $right_image[0]; ?>" width="<?php echo $right_image[1]; ?>" height="<?php echo $right_image[2] ?>" data-rsw="<?php echo $left_image[1]; ?>" data-rsh="<?php echo $left_image[2] ?>" />
        </div>
    <?php endif; ?>
</div>
