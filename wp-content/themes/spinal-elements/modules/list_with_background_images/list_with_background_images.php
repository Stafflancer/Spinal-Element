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


wp_enqueue_style('list_with_background_images_style', get_template_directory_uri() . '/static/css/modules/list_with_background_images/list_with_background_images.css', [], null);

wp_enqueue_script( 'list_with_background_images_js', get_template_directory_uri() . '/static/js/modules/list_with_background_images/list_with_background_images.js', [], null, true );

?>
	<section class="list_with_background_images <?php if($add_pattern == 1){ echo "add-pattern"; } 
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
	echo 'gradient' === $media_type && ! empty( $gradient ) ? 'gradient-' . $gradient : ''; ?>"
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
			<div class="row wow fadeInUp">
				<div class="col-12">
					<?php if ( $heading ) { ?>
						<h2 class="heading2 heading-title-dark <?php echo $heading_color; ?> <?php if($add_heading_underline == 1)
{ echo "addunderline"; } ?>"><?php echo $heading; ?></h2>
					<?php } ?>
					<?php if ( $content ) { ?>
						<div class="list_with_background_images <?php echo $text_color; ?>"><?php echo $content; ?></div>
					<?php } ?>
				</div>
			</div><?php 
			if(have_rows('list'))
			{  	
				$activeclass = 1; ?>
				<div class="list-block">
					<div class="list-row"><?php
						while(have_rows('list'))
						{ 	
							the_row();
							$list_title = get_sub_field('list_title');
							$list_content = get_sub_field('list_content'); 
							$list_button = get_sub_field('list_button'); 
							$list_image = get_sub_field('list_image');  ?>
							<div class="item hover-item wow fadeInDown" data-no="<?php echo $activeclass; ?>" >
								<div class="list">
									<div class="list-details"><?php
										if($list_title)
										{ ?>
											<div class="list-title">
												<h3><?php echo $list_title; ?></h3>
											</div><?php
										} 
										if($list_content)
										{ ?>
											<div class="list-content">
												<?php echo $list_content; ?>
											</div><?php
										} 
										if($list_button)
										{ ?>
											<a class="btn btn-darkred" href="<?php echo $list_button['url']; ?>" target="<?php echo $list_button['target']; ?>"><?php echo $list_button['title']; ?></a><?php
										} ?>
									</div>
								</div>
							</div>
							<div class="list-view-image list-bg-main <?php echo "nodata".$activeclass; ?> <?php if($activeclass == 1){ echo "activeimage"; } ?>" data-index="<?php echo $activeclass; ?>" >
								<img class="list-bg-image" src="<?php echo $list_image['url']; ?>">
							</div><?php 
							$activeclass++; 
						} ?>
					</div>
				</div><?php 
			} ?>
		</div>
	</section>
