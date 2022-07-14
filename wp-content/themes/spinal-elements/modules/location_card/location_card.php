<?php
$custom_id = "location_card";
$card_heading = get_sub_field('card_heading');
$location_image = get_sub_field('location_image');
$location_title = get_sub_field('location_title');
$address_line_1 = get_sub_field('address_line_1');
$address_line_2 = get_sub_field('address_line_2');

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



wp_enqueue_style('location_card_style', get_template_directory_uri() . '/static/css/modules/location_card/location_card.css', [], null);

wp_enqueue_script( 'location_card_js', get_template_directory_uri() . '/static/js/modules/location_card/location_card.js', [], null, true );
 ?>
    <section class="location_card <?php if($add_pattern == 1){ echo "add-pattern"; } 
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
                <div class="location_card_inner">
                    <div class="location_card_address wow fadeInUp">
                        <div class="location_card_block"><?php
                            if($card_heading)
                            { ?>
                                <h2 class="text-color-red heading-title-dark <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; }?>"><?php echo $card_heading; ?></h2><?php 
                            }
                            if($location_title)
                            { ?>
                                <h4 class="location_title <?php echo $text_color; ?>"><?php echo $location_title; ?></h4><?php 
                            } 
                            if($address_line_1)
                            { ?>
                                <div class="address_line_1 <?php echo $text_color; ?>">
                                    <?php echo $address_line_1; ?>      
                                </div><?php
                            }
                            if($address_line_2)
                            { ?>
                                <div class="address_line_2 <?php echo $text_color; ?>">
                                    <?php echo $address_line_2; ?>      
                                </div><?php
                            }
                            if(have_rows('phones'))
                            { ?>
                                <div class="phones-list"><?php
                                    while(have_rows('phones'))
                                    {
                                        the_row(); 
                                        $phone_number = get_sub_field('phone_number');
                                        $phone_description = get_sub_field('phone_description'); ?> 
                                        <a href="tel:<?php echo $phone_number; ?>" class="phone-numbers <?php echo $text_color; ?>"><?php echo $phone_number; ?></a> <span><?php echo $phone_description; ?></span></br><?php
                                    } ?>
                                </div><?php 
                            } ?>         
                        </div>  
                    </div><?php
                    if($location_image)
                    { ?>
                        <div class="location_card_img wow fadeInDown">
                            <div class="location_card-block-img"><img src="<?php echo $location_image['url']; ?>" class="img-fluid"></div>
                        </div><?php 
                    } ?>
                </div>
        </div>
    </section>