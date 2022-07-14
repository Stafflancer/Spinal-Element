<?php

$heading = get_sub_field("heading");
$content = get_sub_field("content");

$custom_id = "timeline_block";



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


wp_enqueue_style('timeline_style', get_template_directory_uri() . '/static/css/modules/timeline/timeline.css', [], null);

wp_enqueue_script( 'timeline_js', get_template_directory_uri() . '/static/js/modules/timeline/timeline.js', [], null, true );

wp_enqueue_style('slick-style', get_template_directory_uri() . '/static/css/modules/carousel_gallery_with_buttons/slick.min.css', [], null);

wp_enqueue_script('slick-script', get_template_directory_uri() . '/static/js/modules/carousel_gallery_with_buttons/slick.min.js', ['jquery'], null, true);

if(have_rows('timeline'))
{ ?>
<section class="timeline <?php if($add_pattern == 1){ echo "add-pattern "; } 
if ($media_type == 'image' && !empty($image) && $parallax) { echo 'prallax-added '; } ?> <?php     
	
	echo !empty($custom_css_class) ?  $custom_css_class . ' ' : '';
	/* bg image */
	echo ($media_type == 'image' && !empty($image)) ? 'bg-image ' : '';

	echo ( 'image' === $media_type && ! empty( $image ) ) ? 'image-as-background ' : '';
	
	/* bg color */
	echo $media_type == 'color' && !empty($color) ? 'bg-' . $color : '';
	/* bg color */
	?>"
	<?php
	/* custom id */
	echo !empty($custom_id) ? 'id="' . $custom_id . '"' : '';	
	/* bg image */
	if ($media_type == 'image' && !empty($image) && $parallax) { ?>style="background-image: url('<?php echo $image ?>')"
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
	if (($media_type == 'image' || $media_type == 'video') && $add_overlay == 1 && !empty($overlay_color)) { ?>
		<div class="overlay <?php echo $overlay_color; ?>"></div>
	<?php }

	/* video */
	if ($media_type == 'video' && !empty($video_mp4) || $media_type == 'video' && !empty($video_webm)) { ?>
		<video class="bg-video" autoplay muted>
			<source src="<?php echo $video_mp4['url'] ?>" type="video/mp4">
			<source src="<?php echo $video_webm['url'] ?>" type="video/webm">
		</video>
	<?php } ?>
	
	<div class="container <?php echo "content_width".$content_width; ?>">
			<div class="row wow fadeInUp">
				<div class="col-12">
					<?php if ( $heading ) { ?>
						<h2 class="font32-bold heading-title-dark text-center <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; } ?>"><?php echo $heading; ?></h2>
					<?php } ?>
					<?php if ( $content ) { ?>
						<div class="content text-center <?php echo $text_color; ?>"><?php echo $content; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="timeline-inner-block timeline-slider wow fadeInUp"><?php
				while(have_rows('timeline'))
				{
					the_row();
					$year = get_sub_field('year');
					$description = get_sub_field('description'); ?> 
					<div class="timeline-item">
						<div class="timeline-details"><?php
							if($year)
							{ ?>
								<span class="year-timeline"><?php echo $year; ?></span><?php
							} 
							echo $description; ?>
						</div>
					</div><?php
				} ?>
			</div>
		</div>
</section><?php
} ?>
