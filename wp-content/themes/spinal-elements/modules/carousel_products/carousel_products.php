<?php

global $post;

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


wp_enqueue_style('carousel_products_style', get_template_directory_uri() . '/static/css/modules/carousel_products/carousel_products.css', [], null);

wp_enqueue_style('slick-style', get_template_directory_uri() . '/static/css/modules/carousel_products/slick.min.css', [], null);

wp_enqueue_script('slick-script', get_template_directory_uri() . '/static/js/modules/carousel_products/slick.min.js', ['jquery'], null, true);

wp_enqueue_script( 'carousel_products_js', get_template_directory_uri() . '/static/js/modules/carousel_products/carousel_products.js', [], null, true );

$products = get_sub_field('products');
if($products)
{ ?>
    <section class="carousel_products gradient-bg-color-top <?php if($add_pattern == 1){ echo "add-pattern "; }
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
            <div class="carousel_products_main_block wow fadeInUp">
                <div class="carousel_products_row"><?php 
                    if ( $heading ) 
                    { ?>
                        <h2 class="carousel_products_heading heading-title-dark  <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; } ?>"><?php echo $heading; ?></h2><?php 
                    } 
                    if ( $content ) 
                    { ?>
                        <div class="content <?php echo $text_color; ?>"><?php echo $content; ?></div><?php 
                    } ?>
                </div>
            </div>
            <div class="carousel_products_slides carousel-products-slider"><?php
                foreach ( $products as $post )
                {
                    setup_postdata( $post ); 
                    $product_title = get_the_title();
                    if($product_title)
                    { ?>
                        <div class="carousel-product-item">
                            <div class="carousel-product-item-inner">
                                <div class="carousel-product-content-item-flex">
                                    <div class="carousel-product-left-side-content">
                                        <h2 class="carousel-product-heading <?php echo $heading_color; ?>">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php
                                        $productcontent = get_the_content();
                                        if($productcontent)
                                        { ?>
                                            <div class="carousel-product-content <?php echo $text_color; ?>">
                                                <?php echo wp_trim_words( $productcontent, 10 ); ?>
                                             </div><?php
                                        } ?>
                                    </div>
                                    <div class="carousel-img">
                                        <div class="carousel-product-image">
                                            <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url( '' ); ?>"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-leanmore"> 
                                    <a href="<?php the_permalink(); ?>" class="btn btn-darkred learn-more">Learn More</a>
                                </div>
                            </div>
                        </div><?php
                    }
                } wp_reset_postdata();  ?>
            </div><?php
            global $post; 
            if ( $post->post_parent ) 
            { ?>
                <div class="view-btn">
                    <a class="btn btn-darkred view-all" href="<?php echo get_permalink( $post->post_parent ); ?>" >View All</a>
                </div><?php 
            } ?> 
        </div>
    </section><?php
} ?>
