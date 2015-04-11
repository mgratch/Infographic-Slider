<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package barebones
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function barebones_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'barebones_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function barebones_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'barebones' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'barebones_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function barebones_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'barebones_render_title' );
endif;

/*
 * Gallery Scripts Start here
 */
function gallery_script_and_styles()
{
	wp_enqueue_style('prettyPhotoStyles', get_template_directory_uri() . '/photoMosaic/includes/prettyphoto/prettyphoto.css');
	wp_enqueue_script('prettyPhoto', get_template_directory_uri() . '/photoMosaic/includes/prettyphoto/jquery.prettyPhoto.js', array('jquery'), FALSE, FALSE);
	wp_enqueue_style('photoMosaicStyles', get_template_directory_uri() . '/photoMosaic/css/photomosaic.css');
	wp_enqueue_script('photomosaic', get_template_directory_uri() . '/photoMosaic/js/photomosaic.min.js', array('jquery'), FALSE, FALSE);
	wp_enqueue_script('functions', get_template_directory_uri() . '/photoMosaic/js/functions.js', array('jquery-mousewheel','photomosaic','royalSliderJS'), FALSE, FALSE);
	wp_enqueue_style('royalsliderStyle', get_template_directory_uri() . '/css/royalslider.css');
	wp_enqueue_style('royalsliderDefault', get_template_directory_uri() . '/css/default/rs-default.css');
	wp_enqueue_script('royalSliderJS', get_template_directory_uri() . '/js/jquery.royalslider.custom.min.js', array('jquery'), FALSE, FALSE);
    wp_enqueue_script('jquery-mousewheel', get_template_directory_uri() . '/js/jquery-mousewheel.js', array('jquery'), FALSE, FALSE);
}
add_action( 'wp_enqueue_scripts', 'gallery_script_and_styles' );

function fix_my_gallery_wpse43558($output, $attr) {
	global $post;
	//$sw = '<script>window.innerWidth</script>';
	static $instance = 0;
	$instance++;


	/**
	 *  will remove this since we don't want an endless loop going on here
	 */
	// Allow plugins/themes to override the default gallery template.
	//$output = apply_filters('post_gallery', '', $attr);

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		//print_r($attr);
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}
	if ( !isset( $attr['size'] ) ) {
		$attr['size'] = 'thumbnail';
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => '',
		'icontag'    => '',
		'captiontag' => '',
		'size'       => $attr['size'],
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $attr['size'], true) . "\n";
		return $output;
	}

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )

		$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t");
	$output .="<div id='target'><ul>";
	foreach ( $attachments as $id => $attachment ) {
		$link = wp_get_attachment_image_src($id, $attr['size'], false);
		$link_full = wp_get_attachment_image_src($id, 'full', false);

		$alt_tag = get_post_meta($id,'_wp_attachment_image_alt', TRUE);
		if (!$alt_tag){
			$alt_tag = $attachment->post_title;
		}
		if (isset($attr['link']) && $attr['link'] != 'none'){
			$linkStart = "<a href='";
			$linkStart .= $link_full[0];
			$linkStart .= "'>";
			$linkEnd = "</a>";

		}
		else{
			$linkStart ='';
			$linkEnd = '';
		}
		$output .= '<li>';
		$output .= $linkStart;
		$output .= "<a class='rsImg' href='".$link[0]."'";
		$output .= 'title="'.$attachment->post_title.'" ';
		$output .= 'alt="'.$alt_tag.'" >'.$alt_tag.'</a>';
		//$output .= $alt_tag;
		$output .= '</li>'. "\n" ;

	}

	$output .= '</ul></div>';
	return $output;
}
add_filter("post_gallery", "fix_my_gallery_wpse43558",10,2);
add_filter( 'pods_json_api_access_pods_get_items', '__return_true' );

