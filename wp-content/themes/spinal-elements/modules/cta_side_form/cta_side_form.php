<?php

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


wp_enqueue_style('cta_side_form_style', get_template_directory_uri() . '/static/css/modules/cta_side_form/cta_side_form.css', [], null);

wp_enqueue_script( 'cta_side_form_js', get_template_directory_uri() . '/static/js/modules/cta_side_form/cta_side_form.js', [], null, true );

?>
    <section class="cta_side_form <?php if($add_pattern == 1){ echo "add-pattern "; }
    if ( $media_type == 'image' && ! empty( $image ) && $parallax ) {
        echo 'prallax-added ';
    }
    if( $media_type == 'color' && $color != '')
    {
        echo "bg-".$color;
    }
    else
    {
        echo "default-bg-cta ";
    }

    echo ( 'image' === $media_type && ! empty( $image ) ) ? 'image-as-background ' : '';
    
    /* css class */
    echo ! empty( $custom_css_class ) ? $custom_css_class . ' ' : '';

    /* bg image */
    echo ( 'image' === $media_type && ! empty( $image ) ) ? 'bg-image ' : '';
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
            <div class="cta_side_form_main_block wow fadeInUp"><?php
                if(have_rows('content'))
                { 
                    while(have_rows('content'))
                    { 
                        the_row(); 
                        $heading = get_sub_field('heading');
                        $content = get_sub_field('content'); ?>
                        <div class="cta_side_form_row"><?php 
                            if ( $heading ) 
                            { ?>
                                <h2 class="heading-red-block heading-title-dark  <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; } ?>"><?php echo $heading; ?></h2><?php 
                            } 
                            if ( $content ) 
                            { ?>
                                <div class="content <?php echo $text_color; ?>"><?php echo $content; ?></div><?php 
                            } ?>
                        </div><?php
                    }
                }
               
                $acf_gravity_form = get_sub_field('acf_gravity_form'); 
                if($acf_gravity_form)
                { ?>
                    <div class="right-side-form">
                        <?php echo do_shortcode( '[gravityform id="' . $acf_gravity_form . '" title="false" ajax="true"]' ); ?>
                    </div><?php
                } ?>
            </div>
        </div>
    </section>
