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



wp_enqueue_style('featured_resource_style', get_template_directory_uri() . '/static/css/modules/featured_resource/featured_resource.css', [], null);

wp_enqueue_script( 'featured_resource_js', get_template_directory_uri() . '/static/js/modules/featured_resource/featured_resource.js', [], null, true );

$resource = get_sub_field('resource');
if($resource)
{
 ?>
    <section class="featured_resource <?php if($add_pattern == 1){ echo "add-pattern"; } 
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

        <div class="container <?php echo "content_width".$content_width; ?>"><?php
           // global $post; 

           //foreach ( $resource as $post )
           // {   
                
       

             //   setup_postdata( $post ); 
                $feature_resource_title = get_the_title($resource->ID);  
                $workcategory = wp_get_post_terms( $resource->ID, 'category' ); 
                $arraycatname = array(); 
                $workterm_id = array(); 
                foreach($workcategory as $thisslug) 
                {
                    $arraycatname[] = $thisslug->name;
                    $workterm_id[] = $thisslug->term_id;
                } 
                $categoryname = implode( ", ", $arraycatname );
                $term_id = implode( " ", $workterm_id );
                $$category = get_the_category();
                $firstCategory = $category[0]->cat_name;
                if($feature_resource_title)
                { ?>
                    <div class="featured-resource-form-inner">
                        <div class="featured-resource-details wow fadeInUp"><?php
                            if($categoryname)
                            { ?>
                                <span class="categoryname"><?php echo $categoryname; ?></span><?php
                            } ?>
                            <h2 class="heading-title-dark  <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; } ?>"><a href="<?php echo  get_permalink($resource->ID); ?>"><?php echo get_the_title($resource->ID); ?></a></h2><?php
                            $featured_resource_content = $resource->post_content;
                            /*if($featured_resource_content)
                            { ?>
                                <div class="content <?php echo $text_color; ?>"><?php echo wp_trim_words( $featured_resource_content, 40 ); ?></div><?php
                            }*/ ?>
                            <div class="featured-resource-button"> 
                                <a href="<?php echo get_permalink($resource->ID); ?>" class="btn btn-darkred learn-more">Learn More</a>
                            </div>
                        </div>
                        <div class="featured-resource-image">
                            <a href="<?php echo get_permalink($resource->ID); ?>"><img src="<?php echo get_the_post_thumbnail_url( $resource->ID ); ?>"></a>
                        </div>
                    </div><?php
                }
            //} 
           // wp_reset_postdata(); ?>
        </div>
    </section><?php
} ?>