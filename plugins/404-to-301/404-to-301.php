<?php

/*
  Plugin Name: 404 to 301
  Plugin URI: http://www.joelsays.com/plugins/404-to-301/
  Description: Automatically redirect all 404 page errors to any page using 301 redirect for SEO. No more 404 Errors in WebMaster tool.
  Author: Joel James
  Version: 1.0.8
  Author URI: http://www.joelsays.com/about/
  Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=XUVWY8HUBUXY4
  Copyright (c) 2014 Joel James
 */
?>
<?php

add_action('admin_menu', 'js_404_settings_menu');
if(!function_exists('js_404_settings_menu')) {
function js_404_settings_menu() {
    add_options_page('404 to 301', '404 to 301', 'administrator', 'js-options', 'js_404_settings');
}
}

if(!function_exists('js_404_settings')) {
function js_404_settings() {
    require_once('js-404-admin.php');
}
}

if(!function_exists('js_404_redirect')) {
function js_404_redirect(){
$type = get_option('type');
$link = get_option('link');
if(is_404() && !empty($link) && !empty($type)){
wp_redirect( $link, $type );
exit;
}
}
}
add_action('template_redirect', 'js_404_redirect');

register_activation_hook(__FILE__, 'js_404_activate');
add_action('admin_init', 'js_404_start_redirect');

if(!function_exists('js_404_activate')) {
function js_404_activate() {
    add_option('js_404_activation_redirect', true);
}
}

if(!function_exists('js_404_start_redirect')) {
function js_404_start_redirect() {
    if (get_option('js_404_activation_redirect', false)):
        delete_option('js_404_activation_redirect');
        wp_redirect('options-general.php?page=js-options');
    endif;
}
}

if(!function_exists('js_404_action_links')) {
function js_404_action_links($links, $file) {
    $plugin_file = basename(__FILE__);
    if (basename($file) == $plugin_file) :
		$settings_link = '<a href="options-general.php?page=js-options">Settings</a>';
		array_unshift($links, $settings_link);
    endif;
    return $links;
}
}

add_filter('plugin_action_links', 'js_404_action_links', 10, 2);
