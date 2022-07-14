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


wp_enqueue_style('upcoming_courses_style', get_template_directory_uri() . '/static/css/modules/upcoming_courses/upcoming_courses.css', [], null);

wp_enqueue_style('slick-style', get_template_directory_uri() . '/static/css/modules/carousel_content_with_media/slick.min.css', [], null);

wp_enqueue_script('slick-script', get_template_directory_uri() . '/static/js/modules/carousel_content_with_media/slick.min.js', ['jquery'], null, true);

wp_enqueue_script( 'upcoming_courses_js', get_template_directory_uri() . '/static/js/modules/upcoming_courses/upcoming_courses.js', [], null, true );
if(have_rows('courses'))
{ ?>
	<section class="upcoming_courses gradient-bg-color-top <?php if($add_pattern == 1){ echo "add-pattern"; } 
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
                <div class="upcoming_courses_row"><?php 
                    if ( $heading ) 
                    { ?>
                        <h2 class="font32-bold heading-title-dark <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; } ?>"><?php echo $heading; ?></h2><?php 
                    } 
                    if ( $content ) 
                    { ?>
                        <div class="content <?php echo $text_color; ?>"><?php echo $content; ?></div><?php 
                    } ?>
                </div>
            </div>
            <div class="upcoming-courses-block upcoming-courses-slider"><?php
	            while(have_rows('courses'))
	            {
	            	the_row(); 
	            	$course_image = get_sub_field('course_image');
	            	$course_heading  = get_sub_field('course_heading');
	            	$course_content = get_sub_field('course_content');
	            	$course_date = get_sub_field('course_date');
	            	$course_button = get_sub_field('course_button'); ?>
	            	<div class="upcoming-courses-item">

	            		<?php if($course_button){ ?>
			                        <a href="<?php echo $course_button['url']; ?>" target="<?php echo $course_button['target']; ?>"><?php
			                    } ?>

	            		<div class="upcoming-courses-image"><?php
		            		if($course_image)
		            		{ ?>
		            			<img src="<?php echo $course_image['url']; ?>"><?php
		            		} ?>
	            		</div>
	            		<div class="upcoming-courses-content-block">
	            			<div class="upcoming-courses-detail"><?php
			            		if($course_heading)
			            		{ ?>
			            			<h2 class="upcoming-courses-heading"><?php echo $course_heading; ?></h2><?php
			            		} 
			            		if($course_content)
			            		{ ?>
			            			<div class="upcoming-courses-content">
			            				<?php echo $course_content; ?>
			            			</div><?php
			            		} ?>
			            	</div>
			            	<div class="upcoming-courses-bottom-block"><?php
			            		if($course_date)
			            		{ ?>
			            			<span class="date-left"><?php echo $course_date; ?></span><?php
			            		}
			            		if($course_button)
			                    { ?>
			                       	<div class="upcoming-courses-button">
			                            <button type="button" class="btn btn-darkred" ><?php echo $course_button['title']; ?></button>
			                        </div><?php
			                    } ?>
			                </div>
	            		</div>
	            		<?php if($course_button){ ?>
			                        </a><?php
			                    } ?>
	            	</div><?php
	            } ?>
            </div>
		</div>
	</section><?php
} ?>
