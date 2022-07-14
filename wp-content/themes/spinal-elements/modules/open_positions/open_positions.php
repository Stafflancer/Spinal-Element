<?php
$custom_id = "open_positions";
$heading = get_sub_field('heading');
$content = get_sub_field('content');

/* BG Settings */
$media_type    = get_sub_field('media_type');
$add_overlay   = get_sub_field('add_overlay');
if($add_overlay == 1)
{
    $overlay_color = get_sub_field('overlay_color');
}
$parallax      = get_sub_field('parallax');
$color         = get_sub_field('color');
$image         = get_sub_field('image');
$video_mp4     = get_sub_field('video_mp4');
$video_webm    = get_sub_field('video_webm');
$add_pattern    = get_sub_field('add_pattern');

/* Other Settings */
$heading_color        = get_sub_field('heading_color');
$text_color    = get_sub_field('text_color');
$add_heading_underline  = get_sub_field('add_heading_underline'); 
$content_width = get_sub_field('content_width');
$custom_css_class = get_sub_field('custom_class');



wp_enqueue_style('open_positions_style', get_template_directory_uri() . '/static/css/modules/open_positions/open_positions.css', [], null);

wp_enqueue_script( 'open_positions_js', get_template_directory_uri() . '/static/js/modules/open_positions/open_positions.js', [], null, true );

$positions = get_sub_field( 'positions' );


if ( $positions )
{ ?>
    <section class="open_positions <?php if($add_pattern == 1){ echo "add-pattern"; } 
    if ( $media_type == 'image' && ! empty( $image ) && $parallax ) {
        echo 'prallax-added ';
    }
    /* css class */
    echo ! empty( $custom_css_class ) ? $custom_css_class . ' ' : '';

    /* bg image */
    echo ( 'image' === $media_type && ! empty( $image ) ) ? 'bg-image ' : '';

    echo ( 'image' === $media_type && ! empty( $image ) ) ? 'image-as-background ' : '';
    
    /* bg color */
    echo 'color' === $media_type && ! empty( $color ) ? 'bg-' . $color : '';
    /* bg color */
   ?>"
        <?php

          echo !empty($custom_id) ? 'id="' . $custom_id . '"' : '';
        /* bg image */
        if ( 'image' === $media_type && ! empty( $image ) && $parallax ) { ?>style="background-image: url('<?php echo $image ?>')"
        <?php }
        if ( $media_type == 'image' && !empty($image) &&  $add_overlay == 1 && ! empty( $overlay_color )) 
        { ?>style="background-image: url('<?php echo $image ?>')"
        <?php }
        if ( $media_type == 'image' && !empty($image)) 
        { ?>style="background-image: url('<?php echo $image ?>')"
        <?php }
        ?>>
        <?php
        /* overlay */
        if ( ( 'image' === $media_type || 'video' === $media_type ) && $add_overlay == 1 && ! empty( $overlay_color ) ) { ?>
            <div class="overlay <?php echo $overlay_color; ?>"></div>
        <?php }
        /* video */
        if ( 'video' === $media_type && ( ! empty( $video_mp4 ) || ! empty( $video_webm ) ) ) { ?>
            <video class="bg-video" autoplay muted>
                <source src="<?php echo $video_mp4['url'] ?>" type="video/mp4">
                <source src="<?php echo $video_webm['url'] ?>" type="video/webm">
            </video>
        <?php } ?>

        <div class="container <?php echo "content_width".$content_width; ?>">
            <div class="row">
                 <div class="col-12">
                    <?php if ( $heading ) { ?>
                        <h2 class="font32-bold wow fadeInUp heading-title-dark text-center <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; } ?>"><?php echo $heading; ?></h2>
                    <?php } ?>
                    <?php if ( $content ) { ?>
                        <div class="paragraph-content wow fadeInUp text-center <?php echo $text_color; ?>"><?php echo $content; ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="open_positions_inner">
                <div class="open_positions_row accordion-container" id="accordion">
                    <script id="gnewtonjs" type="text/javascript" src="https://recruitingbypaycor.com/career/iframe.action?clientId=8a7883d07fa61986017fd2180a07129b"></script>
                    <iframe src="https://recruitingbypaycor.com/career/CareerHome.action?clientId=8a7883d07fa61986017fd2180a07129b" width="1200" height="800"></iframe>
                    <?php
                   /* $firstshow = 1; 
                    global $post; 
                    foreach ( $positions as $post )
                    {
                        setup_postdata( $post ); 
                        $position_location = get_field('position_location', $post->ID);  ?>                            
                        <article class="content-entry">
                            <div class="open-positions-details">
                                <button class="article-title"><span class="toggle-icons"><i></i></span><?php
                                    if($position_location)
                                    { ?>
                                        <span><?php echo $position_location; ?></span><?php
                                    } ?>
                                    <h2><?php the_title(); ?></h2>
                                </button>
                                <div class="accordion-content <?php if($firstshow == 1){  echo "firstactive"; } ?>" style="display: none;">
                                    <div class="pannel-in">
                                        <div class="open-positions-content">
                                            <?php the_content(); ?>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-darkred applynowbtn" target="_blank">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                        </article><?php 
                        $firstshow++; 
                    }  wp_reset_postdata();*/ ?>
                </div>
            </div>
        </div>
    </section><?php 
 } ?>
