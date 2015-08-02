<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package barebones
 */
?>
<div id="herFullStoryRow" class="overlay overlay-contentpush">
    <div class="container" id="herFullStory">
        <a id="herStoryGoBack" class="go-back" href="#" ><?php echo __('Go Back &#9658;','barebones'); ?></a>
    </div>
</div>
<div id="hisFullStoryRow" class="overlay his-overlay-contentpush">
    <div id="hisFullStory" class="container">
        <a id="hisStoryGoBack" class="go-back" href="#" ><?php echo __('&#9668; Go Back','barebones'); ?></a>
    </div>
</div>
<?php wp_footer(); ?>

</body>
</html>
