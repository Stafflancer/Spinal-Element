<?php

$heading = get_sub_field('heading');
$content = get_sub_field('content');
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
$custom_id = "content_with_gallery";
$heading_color        = get_sub_field('heading_color');
$text_color    = get_sub_field('text_color');
$add_heading_underline  = get_sub_field('add_heading_underline'); 
$content_width = get_sub_field('content_width');
$custom_css_class = get_sub_field('custom_class');



wp_enqueue_style('content_with_gallery_styles', get_template_directory_uri() . '/static/css/modules/content_with_gallery/content_with_gallery.css', [], null);

wp_enqueue_script( 'content_with_gallery_js', get_template_directory_uri() . '/static/js/modules/content_with_gallery/content_with_gallery.js', [], null, true );



?>

<section class="content_with_gallery <?php if($add_pattern == 1){ echo "add-pattern "; }
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
  		<div class="row">
            <div class="col-12 col-md-12 col-lg-6 content-order">
                <div class="block-layout-content pt-top-gallerycontent"><?php
               	 	if($heading)
                    { ?>
                       <h2 class="font32-bold wow fadeInUp heading-title-dark <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; }?>"><?php echo $heading; ?></h2><?php 
                   	} 
                    if($content)
                    { ?>
                        <div class="paragraph-content wow fadeInUp <?php echo $text_color; ?>">
                            <?php echo $content; ?>      
                        </div><?php
                    }
                    if ($button) 
                    { ?>         
                         <a href="<?php echo $button['url']; ?>" class="btn btn-darkred get-involved" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a><?php 
                    } ?>      
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6">
            	<div class="gallery-item-masonry-inner"><?php
		            $gallery_layout = get_sub_field('gallery_layout');
		            $gallery_images = get_sub_field('gallery');
		            if($gallery_layout == 'masonry')
		            { 
		            	if( $gallery_images )
		            	{ 
		            		$itemindex = 1; 
		            		foreach( $gallery_images as $image )
		            		{ ?>
				            	<div class="gallery-item-masonry <?php echo "itemindex-".$itemindex; ?>">
				            		<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				            	</div><?php
				            	$itemindex++;
				            }
			            }
		            }
		            else
		            { ?>
		            	<div class="gallery-item-stacked"><?php
			            	if( $gallery_images )
			            	{ 
			            		$itemindex = 1; 
			            		foreach( $gallery_images as $image )
			            		{ ?>
					            	<div class="gallery-item-masonry <?php echo "itemindex-".$itemindex; ?>">
					            		<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					            	</div><?php
					            	$itemindex++;
					            }
				            } ?>
		            	</div><?php
		            } ?>
	            </div>
	        </div>
        </div>
	</div>
</section>
