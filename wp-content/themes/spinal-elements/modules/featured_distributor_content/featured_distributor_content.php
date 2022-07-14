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


wp_enqueue_style('featured_distributor_content_style', get_template_directory_uri() . '/static/css/modules/featured_distributor_content/featured_distributor_content.css', [], null);

wp_enqueue_style('slick-style', get_template_directory_uri() . '/static/css/modules/featured_distributor_content/slick.min.css', [], null);

wp_enqueue_script('slick-script', get_template_directory_uri() . '/static/js/modules/featured_distributor_content/slick.min.js', ['jquery'], null, true);

wp_enqueue_script( 'featured_distributor_content_js', get_template_directory_uri() . '/static/js/modules/featured_distributor_content/featured_distributor_content.js', [], null, true );

$featured_resources = get_sub_field('featured_resources');
if($featured_resources)
{ 
?>
    <section class="featured_distributor_content <?php if($add_pattern == 1){ echo "add-pattern "; }
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
            <div class="featured_distributor_content_main_block wow fadeInUp">
                <div class="featured_distributor_content_row"><?php 
                    if ( $heading ) 
                    { ?>
                        <h2 class="heading2 heading-title-dark <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; } ?>"><?php echo $heading; ?></h2><?php 
                    } 
                    if ( $content ) 
                    { ?>
                        <div class="content <?php echo $text_color; ?>"><?php echo $content; ?></div><?php 
                    } ?>
                </div>
            </div>
            <div class="featured_distributor_content_slides featured-distributor-slider"><?php
                global $post; 
                foreach ( $featured_resources as $post )
                {
                    setup_postdata( $post ); 
                    $feature_resource_title = get_the_title();
                    $upload_pdf = get_field('upload_pdf', $post->ID);
                    $category = get_the_category();
                    $firstCategory = $category[0]->cat_name;
                    $category = wp_get_post_terms( get_the_ID(), 'distributor_content_type' ); 
                    $maincategoryname = array(); 
                    foreach($category as $categorynew) 
                    {
                        $maincategoryname[] = $categorynew->name;
                    } 
                    $terms_string = implode( ", ", $maincategoryname ); ?>
                    <div class="featured-distributor-content-item">
                        <div class="featured-distributor-content-imgbox" style="background-image: url(<?php the_post_thumbnail_url( '' ); ?>);"></div>
                        <div class="featured-distributor-content-item-flex">
                            <div class="featured-distributor-left-side-content">
                                
                            </div>
                            <div class="featured-distributor-right-side-content"><?php
                                if($terms_string)
                                { ?>
                                    <strong class="heading-featured"><?php echo $terms_string; ?></strong><?php
                                }
                                if($firstCategory)
                                { ?>
                                    <span class="categoryname"><?php echo $firstCategory; ?></span><?php
                                } ?>
                                <h2 class="featured-distributor-right-side-heading <?php echo $heading_color; ?>"><?php the_title(); ?></h2><?php
                                $featured_distributor_content = get_the_content();
                                if($featured_distributor_content)
                                { ?>
                                    <div class="content <?php echo $text_color; ?>"><?php echo wp_trim_words( $featured_distributor_content, 20 ); ?></div><?php
                                } ?>
                               <div class="featured-distributor-button"><?php
                                    if($upload_pdf)
                                    { ?>
                                        <a href="<?php echo $upload_pdf['url']; ?>"  download="<?php echo $upload_pdf['url']; ?>" class="btn download-more">Download</a>
                                        <a href="<?php echo $upload_pdf['url']; ?>" target="_blank" class="btn btn-darkred viewbtn">View</a><?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div><?php
                } wp_reset_postdata(); ?>
            </div>
        </div>
    </section><?php
} ?>
