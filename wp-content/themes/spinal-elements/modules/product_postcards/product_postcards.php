<?php

$heading = get_sub_field('heading');
$content = get_sub_field('content');
$add_hover_effect = get_sub_field('add_hover_effect');


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


wp_enqueue_style('product_postcards_style', get_template_directory_uri() . '/static/css/modules/product_postcards/product_postcards.css', [], null);

wp_enqueue_script( 'product_postcards_js', get_template_directory_uri() . '/static/js/modules/product_postcards/product_postcards.js', [], null, true );

if(have_rows('postcards'))
{  ?>
	<section class="product_postcards <?php if($add_pattern == 1){ echo "add-pattern"; } 
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
			<div class="product_postcards_block"><?php				
                while(have_rows('postcards'))
                {
                    the_row(); 
                    $resting_image = get_sub_field('resting_image');
                    $hover_image = get_sub_field('hover_image');
                    $podcastheading = get_sub_field('heading');
                    $podcastcontent = get_sub_field('content');
                    $podcastbutton = get_sub_field('button'); 
                    $product_id = str_ireplace (' ', '_', $podcastheading); ?>
                    <div class="product_postcards_item wow fadeInUp" id="<?php echo $product_id; ?>">
                        <div class="postcards-content-item-flex">
                            <div class="postcards-left-side-content">
                            	<div class="main-card-image <?php if($add_hover_effect == 1)
									{ echo "preserve-3d" ; } ?>">
	                                <div class="product-main-image thefront"><?php
										echo wp_get_attachment_image( $resting_image, $size = 'large'); ?>
									</div><?php
									if($add_hover_effect == 1)
									{ 
										if($hover_image)
										{ ?>
											<div class="product-hover-image theback">
												<img src="<?php echo $hover_image; ?>">
											</div><?php
										}
									} ?>
								</div>
                            </div>
                            <div class="postcards-right-side-content">
                            	<div class="postcards-details">
                            		<h2 class="text-color-red postcard-heading"><?php
                            		if($podcastbutton)
                            		{ ?>
                            			<a href="<?php echo $podcastbutton['url']; ?>"><?php
                            		} ?><?php echo $podcastheading; ?><?php
                            		if($podcastbutton)
                            		{ ?></a><?php
                            		} ?>
                            		</h2>
                            		<div class="postcards-content">
                            			<?php echo $podcastcontent; ?>
                            		</div>
                            	</div><?php
                            	if($podcastbutton)
                            	{ ?>
                            		<a href="<?php echo $podcastbutton['url']; ?>" class="btn btn-darkred view-product"><?php echo $podcastbutton['title']; ?></a><?php
                            	} ?>
                            </div>
                        </div>
                    </div><?php
                } ?>
            </div>
		</div>
	</section><?php
} ?>
