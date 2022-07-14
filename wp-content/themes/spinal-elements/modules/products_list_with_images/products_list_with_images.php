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


wp_enqueue_style('products_list_with_images_style', get_template_directory_uri() . '/static/css/modules/products_list_with_images/products_list_with_images.css', [], null);

wp_enqueue_script( 'products_list_with_images_js', get_template_directory_uri() . '/static/js/modules/products_list_with_images/products_list_with_images.js', [], null, true );
if(have_rows('products'))
{
?>
	<section class="products_list_with_images <?php if($add_pattern == 1){ echo "add-pattern"; } 
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
		if ( ( 'image' === $media_type || 'video' === $media_type ) && $add_overlay && ! empty( $overlay_color ) ) { ?>
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
			<div class="row wow fadeInUp">
				<div class="col-12">
					<?php if ( $heading ) { ?>
						<h2 class="heading2 heading-title-dark text-center <?php echo $heading_color; ?> <?php if($add_heading_underline == 1)
{ echo "addunderline"; } ?>"><?php echo $heading; ?></h2>
					<?php } ?>
					<?php if ( $content ) { ?>
						<div class="content text-center <?php echo $text_color; ?>"><?php echo $content; ?></div>
					<?php } ?>
				</div>
			</div>
				<div class="products-block">
					<div class="products-row"><?php
						while(have_rows('products'))
						{
							the_row();
							$product = get_sub_field('product');

							$regular_image = get_sub_field('regular_image');
							$hover_image = get_sub_field('hover_image');
							 ?>
							<div class="item wow fadeInDown">
								<div class="products">
									<div class="products-details">
										<div class="main-card-image">
											<div class="product-main-image thefront">
												<a href="<?php echo get_permalink($product->ID); ?>"><img src="<?php echo $regular_image['url']; ?>"></a>
											</div>
											<div class="product-hover-image theback">
												<a href="<?php echo get_permalink($product->ID); ?>"><img src="<?php echo $hover_image['url']; ?>"></a>
											</div>
										</div><?php
										if( $product )
										{ 
											//global $post; 

											/*foreach( $product as $spost )
											{ 


												setup_postdata( $spost );*/
												$selectedproduct = get_the_title($product->ID);
												if($selectedproduct)
												{ ?>
													<div class="product-title">
														<a href="<?php echo get_permalink($product->ID); ?>"><?php echo $selectedproduct; ?></a>
													</div><?php
												}
											/*} wp_reset_postdata();*/  
										} ?>
									</div>
								</div>
							</div><?php
						} ?>
					</div>
				</div>
		</div>
	</section><?php
} ?>
