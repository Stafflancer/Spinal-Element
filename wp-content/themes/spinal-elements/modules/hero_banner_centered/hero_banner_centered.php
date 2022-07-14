<?php

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

wp_enqueue_style('hero_banner_centered_styles', get_template_directory_uri() . '/static/css/modules/hero_banner_centered/hero_banner_centered.css', [], null);
wp_enqueue_script('hero_banner_centered', get_template_directory_uri() . '/static/js/modules/hero_banner_centered/hero_banner_centered.js', '', '', true);
// Setup defaults.
$args = [
	'container'       => 'section',
	'background_type' => $media_type,
	'class'           => 'hero_banner_centered '.$custom_css_class.'',
	'id'              => '',
	'attributes'      => '',
];

$background_video_markup = $background_image_markup = $background_overlay_markup = '';

// Only try to get the rest of the settings if the background type is set to anything.
if ( $args['background_type'] ) {
	if ( 'color' === $args['background_type'] && $color ) {
		$args['class'] .= ' has-background color-as-background bg-' . esc_attr( $color );
	}
	if ( $media_type == 'image' && ! empty( $image ) && $parallax ) {
		$args['class'] .= ' prallax-added';
	}
	if($add_pattern == 1)
	{ 
		$args['class'] .= ' add-pattern ';
	}
	if ( $media_type == 'none' ) {
		$args['class'] .= ' background-default';
	}

	if ( 'image' === $args['background_type'] && $image ) {
		// Make sure images stay in their containers - relative + overflow hidden.
		$args['class']      .= ' has-background image-as-background bg-image';
		$args['attributes'] .= ' style="background-image: url(' . $image . ');"';

		if ( $parallax && $image ) {
			$args['class']      .= ' has-parallax';
			$args['attributes'] .= ' data-parallax="scroll"  data-image-src="' . $image . '"';
		}
	}

	if ( 'video' === $args['background_type'] ) {
		$video_mp4  = get_sub_field( 'video_mp4' );
		$video_webm = get_sub_field( 'video_webm' );

		// Make sure videos stay in their containers - relative + overflow hidden.
		$args['class'] .= ' has-background video-as-background video-bg';

		ob_start();
		?>
		<figure class="video-background">
			<video id="<?php echo esc_attr( $args['id'] ); ?>-video" autoplay muted playsinline preload="none" class="bg-video">
				<?php if ( $video_webm['url'] ) : ?>
					<source src="<?php echo esc_url( $video_webm['url'] ); ?>" type="video/webm">
				<?php endif; ?>
				<?php if ( $video_mp4['url'] ) : ?>
					<source src="<?php echo esc_url( $video_mp4['url'] ); ?>" type="video/mp4">
				<?php endif; ?>
			</video>
		</figure>
		<?php
		$background_video_markup = ob_get_clean();
	}

	if ( ( 'image' === $args['background_type'] || 'video' === $args['background_type'] ) ) {
		if ( $mobile_image_id ) {
			ob_start();
			?>
			<figure class="image-background mobile-background-figure" aria-hidden="true">
				<?php echo wp_get_attachment_image( $mobile_image_id, 'full', false, array( 'class' => 'mobile-background-image' ) ); ?>
			</figure>
			<?php
			$background_image_markup = ob_get_clean();
		}

		if ( $add_overlay == 1 && $overlay_color ) {
			$args['class'] .= ' has-overlay';
			$args['class'] .= ' has-overlay-color-' . esc_attr( $overlay_color );

			ob_start();
			?>
			<div class="overlay <?php echo $overlay_color; ?>"></div>
			<?php
			$background_overlay_markup = ob_get_clean();
		}
	}

	if ( 'none' === $args['background_type'] ) {
		$args['class'] .= ' no-background';
	}
}

// Print our block container with options.
printf( '<%s id="%s" class="%s"%s>', esc_attr( $args['container'] ), esc_attr( $args['id'] ), esc_attr( $args['class'] ), $args['attributes'] );

// If we have a background overlay, echo our background overlay markup inside the block container.
if ( $background_overlay_markup ) {
	echo $background_overlay_markup; // WPCS XSS OK.
}

// If we have a background video, echo our background video markup inside the block container.
if ( $background_video_markup ) {
	echo $background_video_markup; // WPCS XSS OK.
}

// If we have a background image, echo our background image markup inside the block container.
if ( $background_image_markup ) {
	echo $background_image_markup; // WPCS XSS OK.
}
?>
	<div class="container">
		<div class="hero-background-inner">
			<div class="row align-items-center">
				<div class="col-12">
					<div class="breadcrumbs <?php echo $breadcrumbs_color; ?>"><?php echo template_breadcrumbs(); ?></div><?php
					$heading = get_sub_field('heading');
					$content = get_sub_field('content');
					$button   = get_sub_field('button'); 
					if ( $heading ) 
					{ ?>
					 	<h2 class="heading2 text-center wow fadeInUp <?php echo $heading_color; ?> <?php if($add_heading_underline == 1)
						{ echo "addunderline"; } ?>"><?php echo $heading; ?></h2><?php 
					} 
					if($content)
		    		{ ?>
		        		<div class="content text-center wow fadeInUp <?php echo $text_color; ?>">
		            		<?php echo $content; ?>
		            	</div><?php
		            } 
		            if ($button) 
					{ ?>
						<div class="btn-about">
							<a href="<?php echo $button['url']; ?>" class="btn btn-darkred" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
						</div><?php 
					} 
					$hero_banner_centered_form = get_sub_field('hero_banner_centered_form');
					if($hero_banner_centered_form)
					{  ?>
						<div class="grivity-form contact-form-div">
							<?php echo do_shortcode( '[gravityform id="' . $hero_banner_centered_form . '" title="false" ajax="true"]' ); ?>
						</div><?php
					} ?>
				</div>
			</div>
		</div>
	</div>
</<?php echo $args['container']; ?>>

<?php //} ?>
