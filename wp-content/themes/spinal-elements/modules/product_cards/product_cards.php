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


wp_enqueue_style('product_cards_style', get_template_directory_uri() . '/static/css/modules/product_cards/product_cards.css', [], null);

wp_enqueue_script( 'product_cards_js', get_template_directory_uri() . '/static/js/modules/product_cards/product_cards.js', [], null, true );
if(have_rows('cards'))
{ ?>
	<section class="product_cards <?php if($add_pattern == 1){ echo "add-pattern"; } 
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
			<div class="product_cards_block"><?php
				while(have_rows('cards'))
				{
					the_row();
					$product = get_sub_field('product');
					
					$image = get_sub_field('image'); ?>
					 <div class="cards-items wow fadeInUp">

	            		<a href="<?php echo get_permalink($product->ID); ?>">
	            		
	                    <div class="cards-content-item-flex"><?php				
			                //global $post; 
							//foreach ( $product as $post )
							//{
							//	setup_postdata( $post ); 
								$cardtitle = get_the_title($product->ID);
								if($cardtitle)
								{ ?>
		                        	<div class="cards-content">
		                            	<div class="cards-details">
		                            		<h2 class="cards-details-heading"><?php echo $cardtitle; ?></h2><?php
		                            		$productcontent = get_post_field('post_content', $product->ID);
		                            		if($productcontent)
		                            		{ ?>
			                            		<div class="cards-content">
			                            			<?php echo wp_trim_words( $productcontent, 10 ); ?>
			                            		</div><?php
			                            	} ?>
		                            	</div>
		                            </div><?php
		                        }
	                		//} wp_reset_postdata(); ?>
	                		<div class="cards-image">
	                            <div class="main-card-image">
		                            <div class="product-main-image thefront"><?php
											echo wp_get_attachment_image( $image, $size = 'large'); ?>
									</div>
								</div>
	                        </div>
	                    </div>
	                    <div class="card-leanmore">
	                    	<button type="button" class="btn btn-darkred learn-more" >Learn More</button>
                        	<!-- <a href="<?php //echo get_permalink($product->ID); ?>" class="btn btn-darkred learn-more">Learn More</a> -->
                        </div>

                    </a>
	                </div><?php
	            }  ?>
            </div>
		</div>
	</section><?php
} ?>
