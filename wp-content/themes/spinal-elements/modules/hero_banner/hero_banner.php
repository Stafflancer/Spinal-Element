<?php
// Create id attribute allowing for custom "anchor" value.
$id = get_sub_field('custom_id') ? : 'hero-banner';

// Create class attribute allowing for custom "className".
$sectionClassName = 'hero_banner hero-background hero-banner ';
$sectionClassName .= !empty($custom_css_class) ? ' ' . $custom_css_class : '';
$sectionClassName .= !empty($heading_color) ? ' ' . $heading_color : '';
$sectionClassName .= !empty($text_color) ? ' ' . $text_color : '';


$heading_color        = get_sub_field('heading_color');
$text_color    = get_sub_field('text_color');
$add_heading_underline  = get_sub_field('add_heading_underline'); 
$content_width = get_sub_field('content_width');
$custom_css_class = get_sub_field('custom_class');

$is_home_banner = get_sub_field('is_home_banner');

?>
<?php //if ($heading || $tagline || $content || $button) {
	wp_enqueue_style('hero_banner_home_styles', get_template_directory_uri() . '/static/css/modules/hero_banner/hero_banner.css', [], null);

	wp_enqueue_script( 'hero_banner_js', get_template_directory_uri() . '/static/js/modules/hero_banner/hero_banner.js', [], null, true );

	// Start a <container> with possible block options.
	spinalelements_display_block_background_options([
		'container' => 'section', // Any HTML5 container: section, div, etc...
		'class'     => $sectionClassName, // Container class.
		'id'        => $id, // Container id.
	]);
	 ?>
	<div class="hero-background-positinate">
		<div class="container <?php echo "content_width".$content_width; ?>">
			<div class="hero-background-inner">
				<div class="row">
					<div class="col-12 col-lg-8 pr-0"><?php
						if($is_home_banner == 'no')
						{ ?>
							<div class="breadcrumbs <?php echo $breadcrumbs_color; ?>"><?php echo template_breadcrumbs(); ?></div><?php
						} ?>
						<div class="hero_content-inner wow fadeInUp"><?php 	
							$heading = get_sub_field('heading');
							$content = get_sub_field('content');
							$button   = get_sub_field('about_button'); 
							if($heading)
							{ ?>

								<h1 class="text-white <?php echo $heading_color; ?> <?php if($is_home_banner == 'no')
								{ echo "font42 "; } else{ echo " heading-1 "; } if($add_heading_underline == 1)
								{ echo "addunderline"; } ?>"><?php echo $heading; ?></h1><?php 
							} ?>
							<div class="text-white <?php if($is_home_banner == 'no')
								{ echo "font20-para "; } else{ echo " hero-banner-content "; } ?> <?php echo $text_color; ?>"><?php echo $content; ?></div><?php if ($button) 
							{ ?>
								<div class="btn-about">
									<a href="<?php echo $button['url']; ?>" class="btn btn-darkred" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
								</div><?php 
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php //} ?>
