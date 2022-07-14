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



wp_enqueue_style('carousel_testimonials_styles', get_template_directory_uri() . '/static/css/modules/carousel_testimonials/carousel_testimonials.css', [], null);

wp_enqueue_style('slick-style', get_template_directory_uri() . '/static/css/modules/carousel_testimonials/slick.min.css', [], null);

wp_enqueue_script('slick-script', get_template_directory_uri() . '/static/js/modules/carousel_testimonials/slick.min.js', ['jquery'], null, true);

wp_enqueue_script( 'carousel_testimonials_js', get_template_directory_uri() . '/static/js/modules/carousel_testimonials/carousel_testimonials.js', [], null, true );




$testimonials = get_sub_field( 'testimonials' );
if ( $testimonials )
{  ?>
<section class="carousel_testimonials <?php if($add_pattern == 1){ echo "add-pattern "; }
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
		<div class="container <?php echo "content_width".$content_width; ?>">
			<div class="team_block_header-wrap">
				<div class="testimonials_wrap">
					<div class="row justify-content-center testimonials-slider"><?php 
						global $post; 
						foreach ( $testimonials as $post )
						{
							setup_postdata( $post ); 
							$testimonial_member_role = get_field('testimonial_member_role', $post->ID); ?>
							<div class="col-12 col-sm-6 col-md-4 col-lg-4">
								<div class="testimonial-item-blog text-center">
									<div class="thumbnail_ava">
										<img src="<?php the_post_thumbnail_url( '' ); ?>" class="img-fluid">
									</div>
									<div class="item_blog-info">
										<div class="testimonial-content">
											<?php the_content(); ?>
										</div>
										<div class="testimonial-other-details">
											<h4><?php the_title(); ?></h4><?php
											if($testimonial_member_role)
											{ ?>
												<span class="testimonial_role"><?php echo $testimonial_member_role; ?></span><?php
											} ?>
										</div>
									</div>
								</div>
							</div><?php
						}
						wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
</section><?php
} ?>
