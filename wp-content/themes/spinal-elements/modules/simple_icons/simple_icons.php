<?php
$custom_id = "simple_icons";
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



wp_enqueue_style('simple_icons_style', get_template_directory_uri() . '/static/css/modules/simple_icons/simple_icons.css', [], null);

wp_enqueue_script( 'simple_icons_js', get_template_directory_uri() . '/static/js/modules/simple_icons/simple_icons.js', [], null, true );

if(have_rows('columns'))
{ ?>
    <section class="simple_icons <?php if($add_pattern == 1){ echo "add-pattern"; } 
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
            <div class="simple_icons_inner">
                <div class="simple_icons_grid row"><?php 
                    while (have_rows('columns')) 
                    {
                        the_row();
                        $column_heading    = get_sub_field('heading');
                        $column_icon = get_sub_field('icon');
                        $column_content = get_sub_field('content');  ?>                            
                        <div class="col-12 col-sm-6 col-lg-4 text-center"><div class="simple-icons-block"><?php
                            if($column_icon)
                            { ?>
                                <div class="simple_icons_image">
                                    <img src="<?php echo $column_icon['url']; ?>">
                                </div><?php 
                            } 
                            if($column_heading)
                            { ?>
                                <h3 class="simple_icons_heading"><?php echo $column_heading; ?></h3><?php 
                            }
                            if($column_content)
                            { ?>
                                <div class="simple_icons_content">
                                    <?php echo $column_content; ?>
                                </div><?php
                            } ?>
                        </div></div><?php 
                    } ?>
                </div>
            </div>
        </div>
    </section><?php 
 } ?>
