<?php

$heading = get_sub_field('heading');
$content = get_sub_field('content');
$block_layout = get_sub_field('block_layout');
$left_side_image = get_sub_field('left_side_image');
$right_side_image = get_sub_field('right_side_image');
$secondary_heading = get_sub_field('secondary_heading');
$secondary_content = get_sub_field('secondary_content');
$seondary_button = get_sub_field('seondary_button');
$text_heading = get_sub_field('text_heading');
$text_content = get_sub_field('text_content');
$text_button = get_sub_field('text_button');

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


wp_enqueue_style('fiftyfifty_style', get_template_directory_uri() . '/static/css/modules/fiftyfifty/fiftyfifty.css', [], null);

wp_enqueue_script( 'fiftyfifty_js', get_template_directory_uri() . '/static/js/modules/fiftyfifty/fiftyfifty.js', [], null, true );

?>
    <section class="fiftyfifty <?php if($add_pattern == 1){ echo "add-pattern"; } 
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
            <!-- <div class="row wow fadeInUp">
                <div class="col-12 col-lg-12"><?php 
                    if($heading)
                    { ?>
                        <h2 class="heading2 heading-title-dark text-center <?php echo $heading_color; ?>"><?php echo $heading; ?></h2><?php
                    } 
                    if($content)
                    { ?>
                        <div class="content <?php echo $text_color; ?>"><?php echo $content; ?></div><?php 
                    } ?>
                </div>
            </div> --><?php 
            if($block_layout == 'text-media')
            { ?>
                <div class="row align-items-center">
                    <div class="col-12 col-md-12 col-lg-6 content-order wow fadeInUp">
                        <div class="block-layout-content pr-block"><?php
                            if($secondary_heading)
                            { ?>
                                <h2 class="font32-bold heading-title-dark <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; }?>"><?php echo $secondary_heading; ?></h2><?php 
                             } 
                            if($secondary_content)
                            { ?>
                                <div class="paragraph-content <?php echo $text_color; ?>">
                                    <?php echo $secondary_content; ?>      
                                </div><?php
                            }
                            if ($seondary_button) 
                            { ?>         
                                <a href="<?php echo $seondary_button['url']; ?>" class="btn btn-darkred leadership-team" target="<?php echo $seondary_button['target']; ?>"><?php echo $seondary_button['title']; ?></a><?php 
                            } ?>         
                        </div>  
                    </div><?php
                    if($right_side_image)
                    { ?>
                        <div class="col-12 col-md-12 col-lg-6">
                            <div class="fiftyfifty-block-img"><img src="<?php echo $right_side_image['url']; ?>" class="img-fluid"></div>
                        </div><?php 
                    } ?>
                </div><?php 
            }
            else if ($block_layout == 'media-text') 
            { ?>
                <div class="row align-items-center"><?php
                    if($left_side_image)
                    { ?>
                        <div class="col-12 col-md-12 col-lg-6">
                            <div class="fiftyfifty-block-img"><img src="<?php echo $left_side_image['url']; ?>" class="img-fluid"></div>
                        </div><?php
                    }
                    if (have_rows('left_side_content')) 
                    { ?>
                        <div class="col-12 col-md-12 col-lg-6 wow fadeInUp"><?php 
                            while (have_rows('left_side_content')) 
                            {
                                the_row();
                                $left_side_heading = get_sub_field('left_side_heading');
                                $left_side_content = get_sub_field('left_side_content');
                                $left_side_button   = get_sub_field('left_side_button'); ?>
                                <div class="block-layout-content pl-block"><?php 
                                    if($left_side_heading)
                                    { ?>
                                        <h2 class="font32-bold heading-title-dark <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; }?>"><?php echo $left_side_heading ; ?></h2><?php 
                                    } 
                                    if($left_side_content)
                                    { ?>
                                        <div class="paragraph-content <?php echo $text_color; ?>"><?php echo $left_side_content; ?></div><?php
                                    }
                                    if ($left_side_button) 
                                    { ?>         
                                        <a href="<?php echo $left_side_button['url']; ?>" class="btn btn-darkred careers" target="<?php echo $left_side_button['target']; ?>"><?php echo $left_side_button['title']; ?></a><?php 
                                    } ?>
                                </div><?php
                            } ?>
                        </div><?php
                    } ?>
                </div><?php 
            }
            else
            {  ?>
                <div class="row align-items-center wow fadeInUp">
                    <div class="col-12 col-md-12 col-lg-6 content-order wow fadeInUp">
                        <div class="block-layout-content"><?php 
                            if($text_heading)
                            { ?>
                                <h2 class="font32-bold heading-title-dark <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; }?>"><?php echo $text_heading; ?></h2><?php 
                            } 
                            if ($text_button) 
                            { ?>            
                                <a href="<?php echo $text_button['url']; ?>" class="btn btn-darkred" target="<?php echo $text_button['target']; ?>"><?php echo $text_button['title']; ?></a><?php 
                            } ?>
                        </div>
                    </div><?php
                    if($text_content)
                    { ?>
                        <div class="col-12 col-md-12 col-lg-6">
                            <div class="paragraph-content <?php echo $text_color; ?>"><?php echo $text_content; ?></div>
                        </div><?php
                    } ?>
                </div><?php       
            } ?> 
        </div>
</section>
