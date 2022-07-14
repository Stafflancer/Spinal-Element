<?php /**
 * Custom ACF functions.
 *
 * A place to custom functionality related to Advanced Custom Fields.
 *
 * @package Pyramid
 */
// If ACF isn't activated, then bail.
if (!class_exists('ACF')) {
	return false;
}
/**
 * Load ACF modules in the theme template files.
 *
 * @return void
 */
function get_all_modules()
{
	if (have_rows('modules')):
		while (have_rows('modules')) : the_row();
			$module = get_row_layout();

			include get_template_directory() . "/modules/$module/$module.php"; // Template part name MUST match layout ID.
		endwhile;
	endif;
}
/**
 * ACF theme options page - Setting up ACF options pages
 * Enables "Options" pages in Advanced Custom Fields
 */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title'  => __('Theme Settings'),
		'menu_title'  => __('Theme Settings'),
		'menu_slug'  => 'theme-settings',
		'capability' => 'edit_posts',
		'redirect'    => true,
		'position'   => 3.1,
	));

	acf_add_options_page(array(
		'page_title'  => __('Header Settings'),
		'menu_title'  => __('Header Settings'),
		'parent_slug' => 'theme-settings',
	));

	acf_add_options_page(array(
		'page_title'  => __('Footer Settings'),
		'menu_title'  => __('Footer Settings'),
		'parent_slug' => 'theme-settings',
	));

	acf_add_options_page(array(
		'page_title'  => __('General Settings'),
		'menu_title'  => __('General Settings'),
		'parent_slug' => 'theme-settings',
	));
}

function spinalelements_display_block_background_options($args = [])
{
	//	$post_id = is_home() ? get_option('page_for_posts', true) : get_the_ID();
	// Background Settings.
	$media_type      = get_sub_field('media_type');
	$add_overlay     = get_sub_field('add_overlay');
	$overlay_color   = get_sub_field('overlay_color');
	$parallax        = get_sub_field('parallax');
	$color           = get_sub_field('color');
	$add_pattern = get_sub_field('add_pattern');
	$image_url       = get_sub_field('image');
	$custom_class       = get_sub_field('custom_class');

	// $mobile_image_id = get_sub_field('mobile_background_image');
	// Setup defaults.
	$defaults = [
		'background_type' => $media_type,
		'container'       => 'section',
		'class'           => 'content-block',
		'id'              => '',
		'attributes'      => '',
	];

	// Parse args.
	$args                    = wp_parse_args($args, $defaults);
	$background_video_markup = $background_image_markup = $background_overlay_markup = '';

	// Only try to get the rest of the settings if the background type is set to anything.
	if ($args['background_type']) {
		if ('color' === $args['background_type'] && $color) {
			$args['class'] .= ' has-background color-as-background bg-' . esc_attr($color);
		}
		// if ('gradient' === $args['background_type'] && $gradient) {
		// 	$args['class'] .= ' has-background color-as-background gradient-' . esc_attr($gradient);
		// }
		if ($media_type == 'image' && !empty($image_url) && $parallax) 
		{
			$args['class'] .= ' prallax-added ';
		}
		if($media_type == 'none')
		{ 
			$args['class'] .= ' bg-default-gradient ';
		}
		$args['class'] = $custom_class;
		if ('image' === $args['background_type'] && $image_url) {
			// Make sure images stay in their containers - relative + overflow hidden.
			$args['class'] .= ' has-background image-as-background bg-image';
			$args['attributes'] .= ' style="background-image: url(' . $image_url . ');"';

			if ($parallax && $image_url) {
				$args['class']      .= ' has-parallax';
				$args['attributes'] .= ' data-parallax="scroll"  data-image-src="' . $image_url . '"';
			}
		}
		if(is_front_page())
		{
			$args['class'] .= ' home-page-banner ';
		}
		else
		{
			$args['class'] .= ' inner-page-banner ';
		}
		if($add_pattern == 1)
		{
			$args['class'] .= ' add-pattern ';
		}

		if ('video' === $args['background_type']) {
			$video_mp4     = get_sub_field('video_mp4');
			$video_webm    = get_sub_field('video_webm');

			// Make sure videos stay in their containers - relative + overflow hidden.
			$args['class'] .= ' has-background video-as-background video-bg ';

			ob_start();
			?>
			<figure class="video-background">
				<video id="<?php echo esc_attr($args['id']); ?>-video" autoplay="autoplay" loop="loop" muted="muted" class="bg-video">
					<?php if ($video_mp4['url'] || $video_webm['url']) : ?>
						<source src="<?php echo esc_url($video_mp4['url']); ?>" type="video/mp4">
						<source src="<?php echo esc_url($video_webm['url']); ?>" type="video/webm">
					<?php endif; ?>
				</video>
			</figure>
			<?php
			$background_video_markup = ob_get_clean();
		}

		if ( ('image' === $args['background_type'] || 'video' === $args['background_type']) ) {
			if ($mobile_image_id) {
				ob_start();
				?>
				<figure class="image-background mobile-background-figure" aria-hidden="true">
					<?php echo wp_get_attachment_image($mobile_image_id, 'full', false, array('class' => 'mobile-background-image')); ?>
				</figure>
				<?php
				$background_image_markup = ob_get_clean();
			}

			if ($add_overlay == 1 && $overlay_color) {
				$args['class'] .= ' has-overlay ';
				$args['class'] .= ' has-overlay-color-' . esc_attr($overlay_color);

				ob_start();
				?>
				<div class="overlay <?php echo $overlay_color; ?>"></div>
				<?php
				$background_overlay_markup = ob_get_clean();
			}
		}

		if ('none' === $args['background_type']) {
			$args['class'] .= ' no-background';
		}
	}

	// Print our block container with options.
	printf('<%s id="%s" class="%s"%s>', esc_attr($args['container']), esc_attr($args['id']), esc_attr($args['class']), $args['attributes']);

	// If we have a background overlay, echo our background overlay markup inside the block container.
	if ($background_overlay_markup) {
		echo $background_overlay_markup; // WPCS XSS OK.
	}

	// If we have a background video, echo our background video markup inside the block container.
	if ($background_video_markup) {
		echo $background_video_markup; // WPCS XSS OK.
	}

	// If we have a background image, echo our background image markup inside the block container.
	if ($background_image_markup) {
		echo $background_image_markup; // WPCS XSS OK.
	}
}