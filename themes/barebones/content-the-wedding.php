<?php
$title_image = get_post_meta(get_the_ID(),'image',true);
$title_image = wp_get_attachment_image_src($title_image['ID'],'medium',false);
$description = get_post_meta(get_the_ID(),'description',true);
$biz_name = get_post_meta(get_the_ID(),'business_name',true);
$address = get_post_meta(get_the_ID(),'address',true);
$city = get_post_meta(get_the_ID(),'city',true);
$state = get_post_meta(get_the_ID(),'state',true);
$zip_code = get_post_meta(get_the_ID(),'zip_code',true);
$phone_number = get_post_meta(get_the_ID(),'phone_number',true);
$show_title = get_post_meta(get_the_ID(),'show_title',true);
$website = get_post_meta(get_the_ID(),'website',true);
?>
<div id="imageWrap" class="col-sp-3">
    <?php if(!empty($title_image)): ?>
        <img id="venueImage" src="<?php echo $title_image[0]; ?>" width="<?php echo $title_image[1]; ?>" height="<?php echo $title_image[2] ?>" />
    <?php endif; ?>
</div>
<div id="contentWrap" class="col-sp-9">
    <div id="innerWrap">
        <?php if($show_title === '1'): ?>
            <?php the_title('<h1 class="title">','</h1>'); ?>
        <?php endif; ?>
        <?php if(!empty($description)): ?>
            <span class="line line-1"><?php echo $description; ?></span>
        <?php endif; ?>
        <?php if(!empty($biz_name)): ?>
            <span class="line line-2"><?php echo $biz_name; ?></span>
        <?php endif; ?>
        <?php if(!empty($address)): ?>
            <span class="line line-3"><?php echo $address; ?></span>
        <?php endif; ?>
        <?php if(!empty($city)): ?>
            <span class="line line-4"><?php echo $city; ?></span>
        <?php endif; ?>
        <?php if(!empty($state)): ?>
            <span class="line line-5"><?php echo $state; ?></span>
        <?php endif; ?>
        <?php if(!empty($zip_code)): ?>
            <span class="line line-6"><?php echo $zip_code; ?></span>
        <?php endif; ?>
        <?php if(!empty($phone_number)): ?>
            <span class="line line-7"><?php echo '<a href="tel:'.$phone_number.'">'.$phone_number.'</a>'; ?></span>
        <?php endif; ?>
        <?php if(!empty($website)): ?>
            <a href="<?php echo $website; ?>" tagert="_blank"><?php echo $biz_name; ?></a>
        <?php endif; ?>
    </div>
    <p><a class="more-link" href="#" ><?php echo __('Learn More &#9658;','barebones'); ?></a></p>
</div>
