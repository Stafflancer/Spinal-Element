<?php
$heading = get_sub_field('heading');
$content = get_sub_field('content');
$gallery_content = get_sub_field('gallery_content');
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


wp_enqueue_style('carousel_product_gallery_style', get_template_directory_uri() . '/static/css/modules/carousel_product_gallery/carousel_product_gallery.css', [], null);

//wp_enqueue_script('player-script', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/froogaloop.js', [], true);

wp_enqueue_script( 'carousel_product_gallery_js', get_template_directory_uri() . '/static/js/modules/carousel_product_gallery/carousel_product_gallery.js', [], null, true );


?>
<section class="carousel_product_gallery <?php if($add_pattern == 1){ echo "add-pattern "; }
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
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7">
                    <div class="carousel_product_gallery_main_block wow fadeInUp">
                        <div class="carousel_product_gallery_row"><?php 
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
                    <!-- <div id="product-hover-container"></div> -->
                    <div class="product-gallery-main"><?php
                        if(have_rows('gallery'))
                        { ?>
                            <div class="carousel_product_gallery_slides product-thumbnail-image"><?php
                                $smallimageindex = 1;
                                while(have_rows('gallery'))
                                {
                                    the_row(); 
                                    $media_type = get_sub_field('media_type');
                                    $thumbnail_image = get_sub_field('thumbnail_image');
                                    $video = get_sub_field('video');  ?>
                                    <div class="carousel-product-gallery-item thumbnail-view <?php if($smallimageindex == 1){ echo "activethumbnail"; } ?>" data-index="<?php echo $smallimageindex; ?>">
                                        <div class="carousel-product-gallery"><?php
                                                if($media_type == 'image')
                                                { ?>
                                                    <div class="carousel-product-gallery-image">
                                                        <img src="<?php echo $thumbnail_image['url']; ?>">
                                                    </div><?php
                                                }
                                                else
                                                { ?>
                                                    <div class="carousel-product-gallery-image">
                                                        <img src="<?php echo $thumbnail_image['url']; ?>">
                                                        <div class="icon-video">
                                                            <img class="video-pause-small" src="<?php echo get_stylesheet_directory_uri()?>/static/images/Group-80580.png" />
                                                        </div>
                                                    </div><?php
                                                } ?>
                                        </div>
                                    </div><?php
                                    $smallimageindex++;
                                } ?>
                            </div>
                            <div class="carousel_product_gallery_slides wow fadeInUp product-large-image"><?php
                                $largeimageindex = 1;
                                while(have_rows('gallery'))
                                {
                                    the_row(); 
                                    $media_type = get_sub_field('media_type');
                                    $image = get_sub_field('image');
                                    $thumbnail_image = get_sub_field('thumbnail_image');
                                    $video_type = get_sub_field('video_type'); 
                                    $video = get_sub_field('video'); 
                                    $classes = "drift-demo-trigger".$largeimageindex; ?>
                                    <div class="carousel-product-gallery-item product-large-image-item <?php if($largeimageindex == 1){ echo "activelargeimage "; } echo "showindex".$largeimageindex; ?>" data-id="<?php echo $largeimageindex; ?>" style="display: none;">
                                        <div class="carousel-product-gallery"><?php
                                                if($media_type == 'image')
                                                { ?>
                                                    <div class="carousel-product-gallery-image">
                                                        <input type="hidden" name="viemovideourl" class="viemovideourl" value="<?php echo $image['url']; ?>" product-type="image">
                                                        <img class="<?php echo $classes; ?>" src="<?php echo $image['url']; ?>" data-zoom="<?php echo $image['url']; ?>">
                                                    </div><?php
                                                }
                                                else
                                                { ?>
                                                    <div class="carousel-product-gallery-image"><?php
                                                        if($video_type == 'vimeo')
                                                        { ?>
                                                            <input type="hidden" name="viemovideourl" class="viemovideourl" value="https://player.vimeo.com/video/<?php echo $video; ?>?api=1&background=1&mute=0&autoplay=0" product-type="video"><?php
                                                        }
                                                        else
                                                        { ?>
                                                            <input type="hidden" name="viemovideourl" class="viemovideourl" value="https://www.youtube.com/embed/<?php echo $video; ?>?rel=0" product-type="video"><?php
                                                        } ?>
                                                        <img class="<?php echo $classes; ?>" src="<?php echo $thumbnail_image['url']; ?>" data-zoom="<?php echo $image['url']; ?>">
                                                        <div class="icon-video">
                                                            <img class="video-pause-small" src="<?php echo get_stylesheet_directory_uri()?>/static/images/Group-80580.png" />
                                                        </div>
                                                    </div><?php
                                                } ?>
                                               
                                        </div>
                                    </div><?php
                                    $largeimageindex++;
                                } ?>
                            </div>
                        </div>
                        <div class="product-large-image-popup popupouter" style="display: none;">
                            <div class="product-large-image-inner popuinnerblcsk">
                                <div class="crossbtn"><i class="fa fa-times"></i></div>
                                <div class="product-image-popup">
                                    <div class="image-product-popup">
                                        <a class="zoombtn"><img src="" class="popup-image target"></a>
                                        <div class="carousel-product-video-module-inner position-relative video-popup-div">
                                            <iframe id="productgalleryvideo" src="" frameborder="0"></iframe>
                                            <!-- <div class="icon-video">
                                                <img class="video-pause playbtn pauseclass" id="play-button" src="<?php echo get_stylesheet_directory_uri()?>/static/images/Group-80580.png" />
                                                <img class="video-play pausebtn playclass" id="pause-button" src="<?php echo get_stylesheet_directory_uri()?>/static/images/pause.png" style="display: none;" />
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="another-popup-products"><?php
                                        $popupsmallimageindex = 1; 
                                        while(have_rows('gallery'))
                                        {
                                            the_row(); 
                                            $media_type = get_sub_field('media_type');
                                            $image = get_sub_field('image');
                                            $thumbnail_image = get_sub_field('thumbnail_image');
                                            $video_type = get_sub_field('video_type');
                                            $video = get_sub_field('video'); ?>
                                            <div class="popup-product-items popup-thumbnail-view <?php echo "popup-thumbnail-view".$popupsmallimageindex; ?>" data-index="<?php echo $popupsmallimageindex; ?>"><?php
                                                if($media_type == 'image')
                                                { ?>
                                                    <div class="carousel-product-gallery-image">
                                                        <input type="hidden" name="viemovideourl" class="viemovideourl" value="<?php echo $image['url']; ?>" product-type="image">
                                                        <img src="<?php echo $image['url']; ?>">
                                                    </div><?php
                                                }
                                                else
                                                { ?>
                                                    <div class="carousel-product-gallery-image"><?php
                                                        if($video_type == 'vimeo')
                                                        { ?>
                                                            <input type="hidden" name="viemovideourl" class="viemovideourl" value="https://player.vimeo.com/video/<?php echo $video; ?>?api=1&background=1&mute=0&autoplay=0" product-type="video"><?php
                                                        }
                                                        else
                                                        { ?>
                                                            <input type="hidden" name="viemovideourl" class="viemovideourl" value="https://www.youtube.com/embed/<?php echo $video; ?>" product-type="video"><?php
                                                        } ?>
                                                        <img src="<?php echo $thumbnail_image['url']; ?>">
                                                        <div class="icon-video">
                                                            <img class="video-pause-small" src="<?php echo get_stylesheet_directory_uri()?>/static/images/Group-80580.png" />
                                                        </div>
                                                    </div><?php
                                                } ?>
                                            </div><?php
                                            $popupsmallimageindex++;
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div></div><?php
                        }
                    if($gallery_content)
                    { ?>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                            <div class="carousel-product-content-main">
                                <div class="carousel-product-gallery-content <?php echo $text_color; ?>">
                                    <?php echo $gallery_content; ?>
                                </div>
                            </div>
                        </div><?php

                    } ?>
                </div>
            </div>
        </div>
</section>
