<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package barebones
 */

    global $is_winIE;
    if($is_winIE == TRUE ){
        $ie_ID = 'iexp';
    }
    else{
        $ie_ID = '';
    }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
    <![endif]-->
    <script>(function(){document.documentElement.className='js'})();</script>
<?php wp_head(); ?>
</head>

<body <?php body_class(array($ie_ID)); ?>>
