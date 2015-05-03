<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package barebones
 */


/*
 * Gallery Scripts Start here
 */
function gallery_script_and_styles()
{
	wp_enqueue_style('prettyPhotoStyles', get_template_directory_uri() . '/photoMosaic/includes/prettyphoto/prettyphoto.css');
    wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css');
    wp_enqueue_style('royalsliderDefault', get_template_directory_uri() . '/css/default/rs-default.css');
	wp_enqueue_style('photoMosaicStyles', get_template_directory_uri() . '/photoMosaic/css/photomosaic.css');
    wp_enqueue_style('navStyle', get_template_directory_uri() . '/assets/css/menu.css');
    //wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.css');
    //wp_enqueue_style('google_font', "'http://fonts.googleapis.com/css?family=Dosis");
    wp_enqueue_style('royalsliderStyle', get_template_directory_uri() . '/css/royalslider.css');
    wp_enqueue_style('royalsliderDefault', get_template_directory_uri() . '/css/default/rs-default.css');    wp_enqueue_script('prettyPhoto', get_template_directory_uri() . '/photoMosaic/includes/prettyphoto/jquery.prettyPhoto.js', array('jquery'), FALSE, FALSE);
	wp_enqueue_script('photomosaic', get_template_directory_uri() . '/photoMosaic/js/photomosaic.min.js', array('jquery'), FALSE, FALSE);
	wp_enqueue_script('functions', get_template_directory_uri() . '/photoMosaic/js/functions.js', array('photomosaic','royalSliderJS'), FALSE, FALSE);
	wp_enqueue_script('royalSliderJS', get_template_directory_uri() . '/js/jquery.royalslider.custom.min.js', array('jquery'), FALSE, FALSE);
    //wp_enqueue_script('rsDeepLinking', get_template_directory_uri() . '/js/jquery.royalslider.deeplinking.js', array('jquery','royalSliderJS'), FALSE, FALSE);
    //wp_enqueue_script('jquery-mousewheel', get_template_directory_uri() . '/js/jquery-mousewheel.js', array('jquery'), FALSE, FALSE);
}
add_action( 'wp_enqueue_scripts', 'gallery_script_and_styles',11 );

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

        $linkStart = "<a href='";
        $linkStart .= $link_full[0];
        $linkStart .= "'>";
        $linkEnd = "</a>";

		$output .= '<li>';
		$output .= $linkStart;
		$output .= "<img class='rsImg' src='".$link[0]."'";
		$output .= 'title="'.$attachment->post_title.'" ';
		$output .= 'alt="'.$alt_tag.'" />';
		//$output .= $alt_tag;
        $output .= $linkEnd;
		$output .= '</li>'. "\n" ;

	}

	$output .= '</ul></div>';
	return $output;
}
add_filter("post_gallery", "fix_my_gallery_wpse43558",10,2);
//add_action( 'wp_enqueue_scripts', 'json_api_client_js',10 );
//add_filter( 'pods_json_api_access_pods_get_items', '__return_true' );


function my_nav(){
    echo '
	<nav>
		<ul>
			<li>
				<a href="#slide-1">
					<span>Home</span>
				</a>
			</li>
			<li>
				<a href="#slide-2">
					<span>Their Stories</span>
				</a>
			</li>
			<li>
				<a href="#slide-3">
					<span>Our Story</span>
				</a>
			</li>
			<li>
				<a href="#slide-4">
					<span>Venues</span>
				</a>
			</li>
			<li>
				<a href="#slide-5">
					<span>Registry</span>
				</a>
			</li>
			<li>
				<a href="#slide-6">
					<span>RSVP</span>
				</a>
			</li>
			<li>
				<a href="#slide-7">
					<span>Bring Your Kids!</span>
				</a>
			</li>
		</ul>
	</nav>
';
}