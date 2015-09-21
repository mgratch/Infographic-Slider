<?php
/**
 * barebones functions and definitions
 *
 * @package barebones
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800; /* pixels */
}

if ( ! function_exists( 'barebones_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function barebones_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on barebones, use a find and replace
	 * to change 'barebones' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'barebones', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	//add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'barebones' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats

	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	*/

	/* Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'barebones_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	*/
}
endif; // barebones_setup
add_action( 'after_setup_theme', 'barebones_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 *
function barebones_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'barebones' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'barebones_widgets_init' );
*/

/**
 * Enqueue scripts and styles.
 */
function barebones_scripts() {
	wp_enqueue_style( 'barebones-style', get_stylesheet_uri() );

    /*

	wp_enqueue_script( 'barebones-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'barebones-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    */
}
add_action( 'wp_enqueue_scripts', 'barebones_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';

function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="rsNoDrag protectQuiet" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p>' . __( "Amy & Lee cherish their privacy and yours.  Please log in using the Password Provided with your Save the Date:" ) . '</p>
    <p><label for="' . $label . '">' . __( "Password:" ) . ' </label><input name="post_password" class="col-xs-12 col-sm-9 col-md-9" id="' . $label . '" type="password" placeholder="Enter your password here :)" size="24" maxlength="24" /><input class="col-xs-12 col-sm-3 col-md-3" type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" /></p>
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'my_password_form' );

if (!is_admin()){
    //add_filter( 'wp_redirect', function () { debug_print_backtrace(); exit; },999 );
}

/*
function remove_unlocal_scripts(){
    wp_dequeue_script('jquery_validate');
    wp_deregister_script('jquery_validate');
    wp_register_script('jquery.validate', get_template_directory_uri().'/js/jquery.validate.js','jquery',false,false);
    wp_enqueue_script('jquery.validate');
    wp_dequeue_script('google-maps-js-api');
    wp_deregister_script('google-maps-js-api');
    wp_register_script('google_maps_js_api', get_template_directory_uri().'/js/google-maps-js-api.js','',false,false);
    wp_enqueue_script('google_maps_js_api');


}
get_new_royalslider(1);
var_dump(NewRoyalSliderMain::$sliders_init_code);

add_action('init', 'remove_unlocal_scripts',12);
*/

add_filter( 'gform_save_field_value', 'save_field_value', 10, 4 );
function save_field_value( $value, $lead, $field, $form ) {
    $output_ids = array();
    global $files_to_sideload;
    if(!isset($files_to_sideload) || empty($files_to_sideload)){
        $files_to_sideload = array();
    }
    //if not the form with fields to encode, just return the unaltered value without checking the fields
    if ( absint( $form['id'] ) <> 1 ) {
        return $value;
    }

    //array of field ids to encode
    $encode_fields = array( 1 );

    //see if the current field id is in the array of fields to encode; encode if so, otherwise return unaltered value
    if ( in_array( $field->id, $encode_fields ) ) {
        $urls = json_decode($value);
        foreach ($urls as $url) {

            $tmp = download_url($url);
            if (is_wp_error($tmp)) {
                // download failed, handle error
            }
            $file_array = array();

            // Set variables for storage
            // fix file filename for query strings
            preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
            $file_array['name'] = basename($matches[0]);
            $file_array['tmp_name'] = $tmp;

            // If error storing temporarily, unlink
            if (is_wp_error($tmp)) {
                @unlink($file_array['tmp_name']);
                $file_array['tmp_name'] = '';
            }

            // do the validation and storage stuff
            $files_to_sideload[] = $file_array;

        }
        return $value;
    } else {
        if (isset($field->id) && $field->id == 3){
            $post_id = array(38,183);
            $desc = "";
            $i = 0;
            $image_meta_array = json_decode($value);
            foreach ($files_to_sideload as $file){
                $file_name = $image_meta_array[$i]->id;
                if (strpos($file['name'],$file_name) !== false){
                    $new_title = $image_meta_array[$i]->title;
                    $desc = $image_meta_array[$i]->desc;

                }

                if (empty($new_title)){
                    $new_title = $file_name;
                }

                $post_data = array(
                    'post_content' => $desc
                );

                $id = media_handle_sideload($file, $post_id, $new_title, $post_data);

                // If error storing permanently, unlink
                if (is_wp_error($id)) {
                    @unlink($file['tmp_name']);
                    return $id;
                }

                $output_ids[] = $id;
                $src = wp_get_attachment_url($id);
                $i++;

            }
            foreach ($post_id as $single_post) {
                $new_content = get_post_field('post_content', $single_post);

                $pattern = get_shortcode_regex();

                if (   preg_match_all( '/'. $pattern .'/s', $new_content, $matches )
                    && array_key_exists( 2, $matches )
                    && in_array( 'gallery', $matches[2] ) )
                {
                    $short_code = $matches[0];


                    $re1='((?:[a-z][a-z0-9_]*))';	# Variable Name 1
                    $re2='(=)';	# Any Single Character 1
                    $re3='(".*?")';	# Double Quote String 1

                    /*
                     * for some reason short_code_ids doesn't seem to want to grab the last attribute,
                     * so I am going to build my own array of shortcode attributes so I can update the ids
                     * before loading.
                     */

                    preg_match_all ("/".$re1.$re2.$re3."/is", $short_code[0], $short_code_atts);

                    $short_code_atts_aray = array();

                    for($i = 0; $i < count($short_code_atts[0]); $i++){
                        $short_code_atts_aray[$short_code_atts[1][$i]] = $short_code_atts[3][$i];
                    }

                    //$short_code_atts = shortcode_parse_atts($short_code[0]);
                    $short_code_atts_aray['ids'] = str_replace('"', '', $short_code_atts_aray['ids']);
                    $id_array = explode(",",$short_code_atts_aray['ids']);
                    foreach($output_ids as $an_id){
                        $id_array[] = $an_id;
                    }
                    $new_id_str = implode(",",$id_array);
                    //$short_code_atts['ids'] = $new_id_str;
                    $new_shortcode = str_replace($short_code_atts_aray['ids'], $new_id_str, $short_code);
                    $new_content = str_replace($short_code,$new_shortcode,$new_content);
                }

                $curr_post = array(
                    'ID' => $single_post,
                    'post_content' => $new_content
                );
                wp_update_post($curr_post);
            }
        }
        return $value;
    }
}

add_filter( 'gform_field_content', 'subsection_field', 10, 5 );
function subsection_field( $content, $field, $value, $lead_id, $form_id ) {
    if($field->type == 'fileupload' && $form_id == 1){
        $content = str_replace('Drop files here or ',"Drop Your Favorite Pictures of Amy & Lee Here or ",$content);
        $content = str_replace("button gform_button_select_files","button gform_button btn btn-default", $content);

    }
    return $content;
}

add_filter("gform_submit_button", "bootstrap_styles_for_gravityforms_buttons", 10, 5);
function bootstrap_styles_for_gravityforms_buttons($button, $form){

    $button = str_replace('class=\'gform_button', 'class=\'gform_button btn btn-default', $button);

    return $button;

} // End bootstrap_styles_for_gravityforms_buttons()

function add_referring_pic_data_query( $vars ){
    $vars[] = "title";
    $vars[] = 'description';
    $vars[] = 'caption';
    return $vars;
}
//add_filter( 'query_vars', 'add_referring_pic_data_query' );

add_filter( 'gform_confirmation', 'custom_confirmation', 10, 4 );
function custom_confirmation( $confirmation, $form, $entry, $ajax ) {

    return $confirmation;
}

