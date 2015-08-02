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

function localize_slider(){
    $slider = NewRoyalSliderMain::query_slider_data(1);
    $rsSlider = $slider[0]['options'];
    $output = array();
    if(!empty($rsSlider)){
        //$rsSlider = explode(",",$rsSlider);

        $rsSlider = json_decode(json_encode(json_decode($rsSlider)), true);
        $sopts = $rsSlider['sopts'];
        unset($rsSlider['sopts']);
        $output = array_merge($sopts, $rsSlider);

        return $output;
    }
}

function gallery_script_and_styles()
{
    if( !is_admin() ) {
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
        wp_register_script('pm.functions', get_template_directory_uri() . '/photoMosaic/js/pm.functions.js', array('new-royalslider-main-js'), '', true);
        wp_localize_script('pm.functions', 'RS_DATA', localize_slider());
        wp_enqueue_script('pm.functions');
        wp_enqueue_script('classie', get_template_directory_uri() . '/js/classie.js', array(), '', true);
        wp_enqueue_script('menu-huger-overlay', get_template_directory_uri() . '/js/demo7.js', array('modernizr', 'classie'), '', true);
        wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array(), '', true);
        wp_enqueue_script('functions', get_template_directory_uri() . '/js/functions.js', array(), '', true);
        wp_enqueue_script('custom_map_functions', get_template_directory_uri() . '/js/custom_map_functions.js', array('jquery'), '', true);
        //wp_enqueue_script('scrollMagic', 'http://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', array('jquery'), '', true);
        //wp_enqueue_script('scrollMagicIndicators', 'http://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js', array('scrollMagic'), '', true);
        //wp_enqueue_script('panelScroll', get_template_directory_uri() . '/js/panelScroll.js', array('scrollMagicIndicators'), '', true);
    }
}
add_action( 'wp_enqueue_scripts', 'gallery_script_and_styles',11 );

function fix_my_gallery_wpse43558($output, $attr) {
	global $post;
	//$sw = '<script>window.innerWidth</script>';
	static $instance = 0;
	$instance++;

    if (isset($attr['type']) && $attr['type'] == 'photo_mosaic'):
        /**
         *  will remove this since we don't want an endless loop going on here
         */
        // Allow plugins/themes to override the default gallery template.
        //$output = apply_filters('post_gallery', '', $attr);

        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] ){
                unset( $attr['orderby'] );
            }
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

        //$gallery_style = $gallery_div = '';
        $output ="<div id='target'><ul>";
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
    endif;
}
add_filter("post_gallery", "fix_my_gallery_wpse43558",10,2);
//add_action( 'wp_enqueue_scripts', 'json_api_client_js',10 );
//add_filter( 'pods_json_api_access_pods_get_items', '__return_true' );



function my_nav(){
    echo '
        <div class="menu-wrap">
            <nav class="menu">
                <div class="icon-list">
                    <a href="#homeRow">
                        <span>Home</span>
                    </a>
                    <a href="#theirStorySlider">
                        <span>Their Stories</span>
                    </a>
                    <a href="#ourStory">
                        <span>Our Story</span>
                    </a>
                    <a href="#venueSlider">
                        <span>Venues</span>
                    </a>
                    <a href="#registryHeader">
                        <span>Registry</span>
                    </a>
                    <a href="#rsvpRow">
                        <span>RSVP</span>
                    </a>
                    <a href="#kidsRow">
                        <span>Kids!</span>
                    </a>
                </div>
            </nav>
            <button class="close-button" id="close-button">Close Menu</button>
        </div>
        <button class="menu-button" id="open-button">Open Menu</button>
';
}
function mg_gallery_types( $types ) {
    $types['photo_mosaic'] = __( 'Photo Mosaic', 'jetpack' );
    return $types;
}
add_filter('jetpack_gallery_types','mg_gallery_types');
