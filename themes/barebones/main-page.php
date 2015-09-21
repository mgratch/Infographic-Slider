<?php
/**
 * Template Name: Main Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package barebones
 */

get_header();

?>
<?php my_nav(); ?>
<div class="content-wrap">
    <div class="content">
        <div class="container-fluid">

            <div id="mainSlider">

                <?php

                $args = array (
                    'post_type'              => 'home',
                    'post_status'            => 'publish',
                    'pagination'             => false,
                    'posts_per_page'         => '1',
                    'ignore_sticky_posts'    => false,
                    'no_found_rows'          => false,
                    'Update_post_term_cache' => false,
                    'Update_Post_meta_cache' => false
                );

                // The Query
                $home_content = new WP_Query( $args );

                ?>

                <?php //$content = get_the_content(); ?>
                <?php $the_post_ID = get_the_ID(); ?>
                <?php $post = get_post($the_post_ID); ?>
                <?php while ( $home_content->have_posts() ) : $home_content->the_post(); ?>
                    <?php get_template_part( 'content', 'home' ); ?>
                <?php endwhile; // end of the loop. ?>

                <?php if(!post_password_required($post)): ?>



                <?php

                $args = array (
                    'post_type'              => 'her_story',
                    'post_status'            => 'publish',
                    'pagination'             => false,
                    'posts_per_page'         => '1',
                    'ignore_sticky_posts'    => false,
                    'no_found_rows'          => false,
                    'Update_post_term_cache' => false,
                    'Update_Post_meta_cache' => false
                );

                // The Query
                $her_story_content = new WP_Query( $args );

                ?>

                <section class="row herstory-row scrollPanel">

                    <div id="theirStorySlider">

                        <div id="theirStory" class="row">
                                <div id="herStory" class="col col-md-3 col-md-offset-1">
                                    <div class="leftSide" >
                                        <?php while ( $her_story_content->have_posts() ) : $her_story_content->the_post(); ?>

                                            <?php get_template_part( 'content', 'her-story' ); ?>

                                        <?php endwhile; // end of the loop. ?>
                                    </div>
                                </div>
                                <div id="logoCol" class="col-md-3 col">

                                </div>

                                <?php

                                $args = array (
                                    'post_type'              => 'his_story',
                                    'post_status'            => 'publish',
                                    'pagination'             => false,
                                    'posts_per_page'         => '1',
                                    'ignore_sticky_posts'    => false,
                                    'no_found_rows'          => false,
                                    'Update_post_term_cache' => false,
                                    'Update_Post_meta_cache' => false
                                );

                                // The Query
                                $his_story_content = new WP_Query( $args );

                                ?>
                                <div id="hisStory" class="col col-md-3">
                                    <div class="rightSide">
                                        <?php while ( $his_story_content->have_posts() ) : $his_story_content->the_post(); ?>

                                            <?php get_template_part( 'content', 'his-story' ); ?>

                                        <?php endwhile; // end of the loop. ?>
                                    </div>
                                </div>

                        </div>
                    </div>
                </section>


                <?php

                $args = array (
                    'post_type'              => 'our_story',
                    'post_status'            => 'publish',
                    'name'                  => 'our-story',
                    'pagination'             => false,
                    'posts_per_page'         => '1',
                    'ignore_sticky_posts'    => false,
                    'no_found_rows'          => false,
                    'Update_post_term_cache' => false,
                    'Update_Post_meta_cache' => false
                );

                // The Query
                $our_story_content = new WP_Query( $args );

                ?>

               <section class="row our-gallery scrollPanel">
                   <div id="ourStory" class="container-fluid">
                        <?php while ( $our_story_content->have_posts() ) : $our_story_content->the_post(); ?>
                            <?php get_template_part( 'content', 'our-story' ); ?>
                        <?php endwhile; // end of the loop. ?>
                   </div>
               </section>

                <?php

                $args = array (
                    'post_type'              => 'accomadation',
                    'post_status'            => 'publish',
                    'pagination'             => false,
                    'posts_per_page'         => '-1',
                    'ignore_sticky_posts'    => false,
                    'no_found_rows'          => false,
                    'Update_post_term_cache' => false,
                    'Update_Post_meta_cache' => false
                );

                // The Query
                $accomadation_content = new WP_Query( $args );

                ?>
                <section class="row venue-row scrollPanel">

                    <div id="venueSlider">
                        <div id="venueSlideOne">
                            <div id="ourStorySlideOne" class="container-fluid">
                                <div id="ourStorySlideOne-top" class="row">

                                    <div class='venue-col' id="ourHotel">
                                        <?php while ( $accomadation_content->have_posts() ) : $accomadation_content->the_post(); ?>
                                            <?php get_template_part( 'content', 'accomodation' ); ?>
                                        <?php endwhile; // end of the loop. ?>
                                    </div>

                                    <?php

                                    $args = array (
                                        'post_type'              => 'the_wedding',
                                        'post_status'            => 'publish',
                                        'pagination'             => false,
                                        'posts_per_page'         => '1',
                                        'ignore_sticky_posts'    => false,
                                        'no_found_rows'          => false,
                                        'Update_post_term_cache' => false,
                                        'Update_Post_meta_cache' => false
                                    );

                                    // The Query
                                    $the_wedding_content = new WP_Query( $args );

                                    ?>
                                    <div class='venue-col' id="ourWedding">
                                        <?php while ( $the_wedding_content->have_posts() ) : $the_wedding_content->the_post(); ?>
                                            <?php get_template_part( 'content', 'the-wedding' ); ?>
                                        <?php endwhile; // end of the loop. ?>
                                    </div>
                                </div>
                            </div>
                            <div id="after-ourStorySlideOne" class="container-fluid">
                                <div id="map-container" class="row">
                                    <?php echo do_shortcode(get_option('venues_and_accomadations_map_shortcode')); ?>
                                </div>
                            </div>
                        </div>
                        <?php

                        $args = array (
                            'post_type'              => 'our_venue',
                            'post_status'            => 'publish',
                            'pagination'             => false,
                            'posts_per_page'         => '1',
                            'ignore_sticky_posts'    => false,
                            'no_found_rows'          => false,
                            'Update_post_term_cache' => false,
                            'Update_Post_meta_cache' => false
                        );

                        // The Query
                        $our_venue_content = new WP_Query( $args );

                        ?>

                        <div class="overlay venue-overlay-contentpush">
                            <div id="ourVenueStory">
                                <?php while ( $our_venue_content->have_posts() ) : $our_venue_content->the_post(); ?>
                                    <?php get_template_part( 'content', 'our-venue' ); ?>
                                <?php endwhile; // end of the loop. ?>
                            </div>
                        </div>
                    </div>
                </section>

                <?php // start registry section ?>

               <section class="row our-registry scrollPanel">
                   <div class="container-fluid" id="ourRegistry">
                       <div id="registryHeader" class="col-md-4 col-md-offset-1">
                           <div class="leftSide">
                               <?php $registry_head_image = get_option('our_registry_heading_image'); $registry_head_image = wp_get_attachment_image_src($registry_head_image[0],'full',false); ?>
                               <span id="description" class="line-1 line"><?php echo do_shortcode(get_option('our_registry_heading_description')); ?></span>
                               <a class="line" href="<?php echo do_shortcode(get_option('our_registry_heading_link_to_registry')); ?>" target="_blank">
                                   <img id="myRegistyImage" src="<?php echo $registry_head_image[0]; ?>" width="<?php echo $registry_head_image[1]; ?>" height="<?php echo $registry_head_image[2] ?>" />
                               </a>
                               <span id="aFewWords" class="line-2 line"><?php echo get_option('our_registry_heading_a_few_words'); ?></span>
                           </div>
                       </div>

                       <div class="col-md-2">

                       </div>
                        <?php

                        $args = array (
                            'post_type'              => 'our_registry',
                            'post_status'            => 'publish',
                            'pagination'             => false,
                            'posts_per_page'         => '-1',
                            'ignore_sticky_posts'    => false,
                            'no_found_rows'          => false,
                            'Update_post_term_cache' => false,
                            'Update_Post_meta_cache' => false
                        );

                        // The Query
                        $our_registry_content = new WP_Query( $args );

                        ?>
                        <div id="registryItems" class="col-md-4">
                            <div class="rightSide">
                                <?php while ( $our_registry_content->have_posts() ) : $our_registry_content->the_post(); ?>
                                    <?php get_template_part( 'content', 'our-registry' ); ?>
                                <?php endwhile; // end of the loop. ?>
                            </div>
                        </div>
                   </div>
               </section>

                <?php

                $args = array (
                    'post_type'              => 'rsvp_page',
                    'post_status'            => 'publish',
                    'pagination'             => false,
                    'posts_per_page'         => '1',
                    'ignore_sticky_posts'    => false,
                    'no_found_rows'          => false,
                    'Update_post_term_cache' => false,
                    'Update_Post_meta_cache' => false
                );

                // The Query
                $rsvp_page_content = new WP_Query( $args );

                ?>

                <section id="rsvpArea" class="row rsvp-row scrollPanel">
                    <div id="rsvpRow" class="container-fluid">

                        <?php while ( $rsvp_page_content->have_posts() ) : $rsvp_page_content->the_post(); ?>
                            <?php get_template_part( 'content', 'rsvp-page' ); ?>
                        <?php endwhile; // end of the loop. ?>
                    </div>
                </section>

                <?php

                $args = array (
                    'post_type'              => 'kids_page',
                    'post_status'            => 'publish',
                    'pagination'             => false,
                    'posts_per_page'         => '1',
                    'ignore_sticky_posts'    => false,
                    'no_found_rows'          => false,
                    'Update_post_term_cache' => false,
                    'Update_Post_meta_cache' => false
                );

                // The Query
                $kids_page_content = new WP_Query( $args );

                ?>
                <section class="row kids-row scrollPanel">
                    <div id="kidsRow" class="container-fluid">
                        <?php while ( $kids_page_content->have_posts() ) : $kids_page_content->the_post(); ?>
                            <?php get_template_part( 'content', 'kids-page' ); ?>
                        <?php endwhile; // end of the loop. ?>
                    </div>
                </section>

                <?php endif; ?>

            </div><!-- #main -->
        </div>
    </div>
</div>
<?php get_footer(); ?>
