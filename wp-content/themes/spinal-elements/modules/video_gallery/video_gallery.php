<?php
$custom_id = "video_gallery_id";

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



wp_enqueue_style('video_gallery_styles', get_template_directory_uri() . '/static/css/modules/video_gallery/video_gallery.css', [], null);

wp_enqueue_style('slick-style', get_template_directory_uri() . '/static/css/modules/video_gallery/slick.min.css', [], null);

wp_enqueue_script('player-script', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/froogaloop.js', [], true);


wp_enqueue_script('slick-script', get_template_directory_uri() . '/static/js/modules/video_gallery/slick.min.js', ['jquery'], null, true);

wp_enqueue_script( 'video_gallery_js', get_template_directory_uri() . '/static/js/modules/video_gallery/video_gallery.js', [], null, true );



?>

<section class="video_gallery <?php if($add_pattern == 1){ echo "add-pattern "; }
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
		echo !empty($custom_id) ? 'id="' . $custom_id . '"' : '';
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
	    <div class="video_gallery_inner"><?php
	    	if($heading)
	    	{ ?>
		        <h2 class="heading2 text-center wow fadeInUp <?php echo $heading_color; ?> <?php if($add_heading_underline == 1)
					{ echo "addunderline"; } ?>"><?php echo $heading; ?></h2>
		        <?php
		    } 
		    if($content)
		    { ?>
		        <div class="content text-center wow fadeInUp <?php echo $text_color; ?>">
		            <?php echo $content;?>  
		        </div><?php
		    } 
		    if(have_rows('videos'))
		    {   
		    	$i = 1; ?>
		        <div class="videos-block-slider"><?php 
			        while (have_rows('videos')) 
			        { 
			        	the_row();
			            $video_id = get_sub_field('video_id'); 
			            $video_description = get_sub_field('video_description');?>
			            <div class="item video-gallery-new">
			                <div class="video-gallery-module-inner gallery-video position-relative">
								<iframe id="videogalleryid<?php echo $i; ?>" src="https://www.youtube.com/embed/<?php echo $video_id; ?>?rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								<!--<div class="icon-video">
									<img class="video-pause playbtn" id="play-button" src="<?php echo get_stylesheet_directory_uri()?>/static/images/Group-80580.png" />
									<img class="video-play pausebtn" id="pause-button" src="<?php echo get_stylesheet_directory_uri()?>/static/images/pause.png" style="display: none;" />
								</div>-->
							</div>
							<?php
							if($video_description)
							{ ?>
								<div class="video-description">
									<?php echo $video_description; ?>
								</div><?php
							} ?>
			           	</div><?php
			           	$i++;
			        } ?>
		        </div><?php
		    } ?>
	    </div>
	</div>
</section>
