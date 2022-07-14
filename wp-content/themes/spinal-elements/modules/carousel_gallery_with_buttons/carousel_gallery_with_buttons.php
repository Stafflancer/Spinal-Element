<?php
$custom_id = "carousel_gallery_with_buttons";

$custom_inner_id = "carousel_gallery_with_buttons_inner";

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



wp_enqueue_style('carousel_gallery_with_buttons_styles', get_template_directory_uri() . '/static/css/modules/carousel_gallery_with_buttons/carousel_gallery_with_buttons.css', [], null);

wp_enqueue_style('slick-style', get_template_directory_uri() . '/static/css/modules/carousel_gallery_with_buttons/slick.min.css', [], null);

wp_enqueue_script('slick-script', get_template_directory_uri() . '/static/js/modules/carousel_gallery_with_buttons/slick.min.js', ['jquery'], null, true);

wp_enqueue_script( 'carousel_gallery_with_buttons_js', get_template_directory_uri() . '/static/js/modules/carousel_gallery_with_buttons/carousel_gallery_with_buttons.js', [], null, true );


?>

<section class="carousel_gallery_with_buttons <?php if($add_pattern == 1){ echo "add-pattern "; }
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
    <div class="carousel_gallery_with_buttons_inner"><?php
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
	    if(have_rows('gallery'))
	    { 
	    	$tabcounter = 0; ?>
	        <div class="gallery_button_carousel" id="<?php echo $custom_inner_id; ?>"><?php 
		        while (have_rows('gallery')) 
		        { 
		        	the_row();
		            $image = get_sub_field('image'); 
		            $button = get_sub_field('button');?>
		            <div class="item tab-<?php echo $tabcounter; ?>">
		                <div class="gallery-image">
		                   	<img src="<?php echo $image['url']; ?>" alt="image">
		                </div>
		                <div class="gallery-button text-center"><?php 
			                if( $button )
			                { ?>
			                	<a class="btn btn-darkred" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a><?php 
			               	} ?>
		                </div>
		           	</div><?php
		           	$tabcounter++; 
		        } ?>
	        </div><?php
	    } ?>
    </div>
</div>
</section>
