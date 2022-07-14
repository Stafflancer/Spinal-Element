<?php
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


wp_enqueue_style('carousel_content_with_media_style', get_template_directory_uri() . '/static/css/modules/carousel_content_with_media/carousel_content_with_media.css', [], null);

wp_enqueue_style('slick-style', get_template_directory_uri() . '/static/css/modules/carousel_content_with_media/slick.min.css', [], null);

wp_enqueue_script('player-script', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/froogaloop.js', [], true);

wp_enqueue_script('slick-script', get_template_directory_uri() . '/static/js/modules/carousel_content_with_media/slick.min.js', ['jquery'], null, true);

wp_enqueue_script( 'carousel_content_with_media_js', get_template_directory_uri() . '/static/js/modules/carousel_content_with_media/carousel_content_with_media.js', [], null, true );

if(have_rows('slides'))
{ 
?>
    <section class="carousel_content_with_media <?php if($add_pattern == 1){ echo "add-pattern "; }
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
        if ( ( 'image' === $media_type || 'video' === $media_type ) && $add_overlay==1 && ! empty( $overlay_color ) ) { ?>
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
            <div class="carousel_content_with_media_main_block wow fadeInUp">
                <div class="carousel_content_with_media_row"><?php 
                    if ( $heading ) 
                    { ?>
                        <h2 class="heading2 heading-title-dark  <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; } ?>"><?php echo $heading; ?></h2><?php 
                    } 
                    if ( $content ) 
                    { ?>
                        <div class="content <?php echo $text_color; ?>"><?php echo $content; ?></div><?php 
                    } ?>
                </div>
            </div>
            <div class="carousel_content_with_media_slides media-content-with-slider"><?php
                $i = 1;
                while(have_rows('slides'))
                {
                    the_row(); 
                    $slide_title = get_sub_field('slide_title');
                    $slide_content = get_sub_field('slide_content');
                    $slide_button = get_sub_field('slide_button');
                    $slide_media_type = get_sub_field('slide_media_type');
                    $slide_image = get_sub_field('slide_image');
                    $slide_video_id = get_sub_field('slide_video_id'); ?>
                    <div class="slides-content-item">
                        <div class="slides-content-item-flex">
                            <div class="slides-left-side-content">
                                <h3 class="slides-left-side-heading <?php echo $heading_color; ?>"><?php echo $slide_title; ?></h3><?php
                                if($slide_content)
                                { ?>
                                    <div class="slide-in-content <?php echo $text_color; ?>">
                                        <?php echo $slide_content; ?>
                                    </div><?php
                                } 
                                if($slide_button)
                                { ?>
                                    <a href="<?php echo $slide_button['url']; ?>" class="btn btn-darkred"><?php echo $slide_button['title']; ?></a><?php
                                } ?>
                            </div>
                            <div class="slides-right-side-content"><?php
                                if($slide_media_type == 'image')
                                { ?>
                                    <div class="slide-image">
                                        <img src="<?php echo $slide_image['url']; ?>">
                                    </div><?php
                                }
                                else
                                { ?>
                                    <div class="slide-video">
                                         <div class="slide-video-module-inner position-relative">
                                            <iframe id="videocontentid<?php echo $i; ?>" src="https://player.vimeo.com/video/<?php echo $slide_video_id; ?>?api=1&background=1&mute=0&autoplay=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                            <div class="icon-video">
                                                <img class="video-pause playbtn" id="play-button" src="<?php echo get_stylesheet_directory_uri()?>/static/images/Group-80580.png" />
                                                <img class="video-play pausebtn" id="pause-button" src="<?php echo get_stylesheet_directory_uri()?>/static/images/pause.png" style="display: none;" />
                                            </div>
                                        </div>
                                    </div><?php
                                } ?>
                            </div>
                        </div>
                    </div><?php
                    $i++;
                } ?>
            </div>
        </div>
    </section><?php
} ?>
