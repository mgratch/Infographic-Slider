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

get_header(); ?>

    <div id="mainSlider" class="royalSlider rsDefault">

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

        <div class="rsContent">
            <?php while ( $home_content->have_posts() ) : $home_content->the_post(); ?>
                <?php get_template_part( 'content', 'home' ); ?>
            <?php endwhile; // end of the loop. ?>
        </div>

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

        <div class="rsContent">
            <script>
                jQuery(window).load(function() {
                    var $ = jQuery;
                    var slider = $("#mainSlider").data('royalSlider');
                    slider.ev.on('rsAfterSlideChange', function(event) {
                        $("#theirStorySlider").royalSlider({
                            // options go here
                            // as an example, enable keyboard arrows nav
                            slidesOrientation: 'horizontal',
                            autoScaleSlider: false,
                            autoHeight: false,
                            imageScaleMode: 'none',
                            imageAlignCenter: !1,
                            navigateByClick: false,
                            startSlideId:1
                        });
                        var theirSlider = $("#theirStorySlider").data('royalSlider');
                        $("#herStory a.more-link").on('click',function(e){
                            e.preventDefault();
                            theirSlider.prev();
                        });
                        $("#hisStory a.more-link").on('click',function(e){
                            e.preventDefault();
                            theirSlider.next();
                        });
                    });
                });
            </script>
            <div id="theirStorySlider" class="royalSlider rsDefault">
                <div class="rsContent">
                    <div id="herFullStoryRow">
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
                        $his_story_content = new WP_Query( $args );

                        ?>
                        <?php while ( $his_story_content->have_posts() ) : $his_story_content->the_post(); ?>
                        <?php global $more; $more = -1; ?>

                            <div id="herFullStory"><?php the_content(); ?></div>

                        <?php endwhile; // end of the loop. ?>
                    </div>
                </div>
                <div class="rsContent">
                    <div id="theirStory">
                        <div id="herStory" class="a-half">
                            <?php while ( $her_story_content->have_posts() ) : $her_story_content->the_post(); ?>

                                <?php get_template_part( 'content', 'her-story' ); ?>

                            <?php endwhile; // end of the loop. ?>
                        </div>
                        <div class="middle-half"></div>

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
                        <div id="hisStory" class="a-half">
                            <?php while ( $his_story_content->have_posts() ) : $his_story_content->the_post(); ?>

                                <?php get_template_part( 'content', 'his-story' ); ?>

                            <?php endwhile; // end of the loop. ?>
                        </div>
                    </div>
                </div>
                <div class="rsContent">
                    <div id="hisFullStoryRow">
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
                        <?php while ( $his_story_content->have_posts() ) : $his_story_content->the_post(); ?>
                            <?php global $more; $more = -1; ?>

                            <div id="hisFullStory"><?php the_content(); ?></div>

                        <?php endwhile; // end of the loop. ?>
                    </div>
                </div>
            </div>
        </div>


        <?php

        $args = array (
            'post_type'              => 'our_story',
            'post_status'            => 'publish',
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

       <div class="rsContent">
           <script>
               jQuery(window).load(function() {
                   var $ = jQuery;
                   var slider = $("#mainSlider").data('royalSlider');
                   slider.ev.on('rsAfterSlideChange', function(event) {
                       $(window).trigger('resize');
                   });
               });
           </script>

           <div id="ourStory">
                <?php while ( $our_story_content->have_posts() ) : $our_story_content->the_post(); ?>
                    <?php get_template_part( 'content', 'our-story' ); ?>
                <?php endwhile; // end of the loop. ?>
           </div>
       </div>

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
        <div class="rsContent">
            <script>
                jQuery(window).load(function() {
                    var $ = jQuery;
                    var slider = $("#mainSlider").data('royalSlider');
                    slider.ev.on('rsAfterSlideChange', function(event) {
                        $("#venueSlider").royalSlider({
                            // options go here
                            // as an example, enable keyboard arrows nav
                            slidesOrientation: 'horizontal',
                            autoScaleSlider: false,
                            autoHeight: false,
                            imageScaleMode: 'none',
                            imageAlignCenter: !1,
                            navigateByClick: false
                        });
                    });
                });
            </script>
            <div id="venueSlider" class="royalSlider rsDefault">
                <div class="rsContent">
                    <div id="ourStorySlideOne">
                        <div class='a-third' id="ourHotel">
                            <?php while ( $accomadation_content->have_posts() ) : $accomadation_content->the_post(); ?>
                                <?php get_template_part( 'content', 'accomodation' ); ?>
                            <?php endwhile; // end of the loop. ?>
                        </div>

                        <?php

                        $args = array (
                            'post_type'              => 'rehearsal_dinner',
                            'post_status'            => 'publish',
                            'pagination'             => false,
                            'posts_per_page'         => '1',
                            'ignore_sticky_posts'    => false,
                            'no_found_rows'          => false,
                            'Update_post_term_cache' => false,
                            'Update_Post_meta_cache' => false
                        );

                        // The Query
                        $rehearsal_dinner_content = new WP_Query( $args );

                        ?>
                        <div class='a-third' id="ourDinner">
                            <?php while ( $rehearsal_dinner_content->have_posts() ) : $rehearsal_dinner_content->the_post(); ?>
                                <?php get_template_part( 'content', 'rehearsal-dinner' ); ?>
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
                        <div class='a-third' id="ourWedding">
                            <?php while ( $the_wedding_content->have_posts() ) : $the_wedding_content->the_post(); ?>
                                <?php get_template_part( 'content', 'the-wedding' ); ?>
                            <?php endwhile; // end of the loop. ?>
                        </div>
                    </div>
                    <?php echo do_shortcode(get_option('venues_and_accomadations_map_shortcode')); ?>
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
                <div class="rsContent">
                    <div id="ourVenueStory">
                        <?php while ( $our_venue_content->have_posts() ) : $our_venue_content->the_post(); ?>
                            <?php get_template_part( 'content', 'our-venue' ); ?>
                        <?php endwhile; // end of the loop. ?>
                    </div>
                </div>
            </div>
        </div>

        <?php // start registry section ?>

       <div class="rsContent">
           <div id="ourRegistry">
               <div id="registryHeader" class="a-half">
                   <?php $registry_head_image = get_option('our_registry_heading_image'); $registry_head_image = wp_get_attachment_image_src($registry_head_image[0],'full',false); ?>
                   <span id="description" class="line-1"><?php echo do_shortcode(get_option('our_registry_heading_description')); ?></span>
                   <a href="<?php echo do_shortcode(get_option('our_registry_heading_link_to_registry')); ?>" target="_blank">
                       <img id="myRegistyImage" class="rsImg" src="<?php echo $registry_head_image[0]; ?>" width="<?php echo $registry_head_image[1]; ?>" height="<?php echo $registry_head_image[2] ?>" data-rsw="<?php echo $registry_head_image[1]; ?>" data-rsh="<?php echo $registry_head_image[2] ?>" />
                   </a>
                   <span id="aFewWords" class="line-2"><?php echo get_option('our_registry_heading_a_few_words'); ?></span>
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
                <div id="registryItems" class="a-half">
                    <?php while ( $our_registry_content->have_posts() ) : $our_registry_content->the_post(); ?>
                        <?php get_template_part( 'content', 'our-registry' ); ?>
                    <?php endwhile; // end of the loop. ?>
                </div>
           </div>
       </div>

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

        <div class="rsContent">
            <div id="rsvpRow">
                <?php while ( $rsvp_page_content->have_posts() ) : $rsvp_page_content->the_post(); ?>
                    <?php get_template_part( 'content', 'rsvp-page' ); ?>
                <?php endwhile; // end of the loop. ?>
            </div>
        </div>

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
        <div class="rsContent">
            <div id="kidsRow">
                <?php while ( $kids_page_content->have_posts() ) : $kids_page_content->the_post(); ?>
                    <?php get_template_part( 'content', 'kids-page' ); ?>
                <?php endwhile; // end of the loop. ?>
            </div>
        </div>

    </div><!-- #main -->

<?php get_footer(); ?>
