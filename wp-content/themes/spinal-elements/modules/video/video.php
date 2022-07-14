<?php

$custom_id = "video_block";
$heading = get_sub_field('heading_video');
$content = get_sub_field('content_video');
$video_type = get_sub_field('video_type');
$viemo_video = get_sub_field('vimeo_video_id');
$youtube_video = get_sub_field('youtube_video');
$button = get_sub_field('button');

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


wp_enqueue_style('video_style', get_template_directory_uri() . '/static/css/modules/video/video.css', [], null);

wp_enqueue_script( 'video_js', get_template_directory_uri() . '/static/js/modules/video/video.js', [], null, true );

wp_enqueue_script('player-script', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/froogaloop.js', [], true);

if($viemo_video || $youtube_video)
{ ?>
<section class="<?php if($add_pattern == 1){ echo "add-pattern "; } 
if ($media_type == 'image' && !empty($image) && $parallax) { echo 'prallax-added '; } ?> video video-module <?php     
	
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
						<h2 class="heading2 heading-title-dark text-center <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; } ?>"><?php echo $heading; ?></h2>
					<?php } ?>
					<?php if ( $content ) { ?>
						<div class="content text-center <?php echo $text_color; ?>"><?php echo $content; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="video-block"><?php
				if($video_type == 'viemo')
				{
					if($viemo_video)
					{ ?>
						<div class="video-module-inner vimeo-video">
							<iframe id="projectplayer" src="https://player.vimeo.com/video/<?php echo $viemo_video; ?>?api=1&background=1&mute=0&autoplay=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						</div>
						<div class="icon-video">
							<img class="video-pause" id="play-button" src="<?php echo get_stylesheet_directory_uri()?>/static/images/Group-80580.png" />
							<img class="video-play" id="pause-button" src="<?php echo get_stylesheet_directory_uri()?>/static/images/pause.png" style="display: none;" />
						</div>
						<?php 
					}
				}
				else
				{
					if($youtube_video)
					{ ?>
						<div class="video-module-inner youtube_video">
							<iframe src="https://www.youtube.com/embed/<?php echo $youtube_video; ?>?rel=0"frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div><?php 
					}
				}
				if ($button) 
				{ ?>
					<div class="btn-video">
						<a href="<?php echo $button['url']; ?>" class="btn btn-darkred btn-videocheck" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
					</div><?php 
				} ?>
			</div>
		</div>
</section><?php
} ?>
