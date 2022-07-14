<?php
$heading = get_sub_field('heading');
$content = get_sub_field('content');
$cards_per_row = get_sub_field('cards_per_row');

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


wp_enqueue_style('cards_with_button_style', get_template_directory_uri() . '/static/css/modules/cards_with_button/cards_with_button.css', [], null);

wp_enqueue_script( 'cards_with_button_js', get_template_directory_uri() . '/static/js/modules/cards_with_button/cards_with_button.js', [], null, true );
if(have_rows('cards'))
{ ?>
	<section class="cards_with_button <?php if($add_pattern == 1){ echo "add-pattern"; } 
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
                <div class="cards_with_button_row"><?php 
                    if ( $heading ) 
                    { ?>
                        <h2 class="font32-bold heading-title-dark text-center <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; } ?>"><?php echo $heading; ?></h2><?php 
                    } 
                    if ( $content ) 
                    { ?>
                        <div class="content text-center <?php echo $text_color; ?>"><?php echo $content; ?></div><?php 
                    } ?>
                </div>
            </div>
            <div class="cards-with-button-block <?php echo "card-".$cards_per_row; ?>"><?php
	            while(have_rows('cards'))
	            {
	            	the_row(); 
	            	$cards_heading = get_sub_field('cards_heading');
	            	$cards_content  = get_sub_field('cards_content');
	            	$cards_button = get_sub_field('cards_button');
	            	$cards_image = get_sub_field('cards_image'); ?>

	            	<div class="cards-item">
	            		<?php if($cards_button){ ?>
	            				<a href="<?php echo $cards_button['url']; ?>">
	            		<?php } ?>
	            		<div class="cards-image"><?php
		            		if($cards_image)
		            		{ ?>
		            			<!-- <a href="<?php echo $cards_button['url']; ?>"> --><img src="<?php echo $cards_image['url']; ?>"><!-- </a> --><?php
		            		} ?>
	            		</div>
	            		<div class="card-block-bottom">
	            			<div class="cards-content"><?php
		            		if($cards_heading)
		            		{ ?>
		            			<h2 class="cards-with-button-heading"><!-- <a href="<?php echo $cards_button['url']; ?>"> --><?php echo $cards_heading; ?><!-- </a> --></h2><?php
		            		} 
		            		if($cards_content)
		            		{ ?>
		            			<div class="cards-with-button-content">
		            				<!-- <a href="<?php echo $cards_button['url']; ?>"> --><?php echo $cards_content; ?><!-- </a> -->
		            			</div><?php
		            		} ?>
		            		</div><?php
		            		if($cards_button)
		                    { ?>
		                       	<div class="cards-button">
		                           <!--  <a href="<?php echo $cards_button['url']; ?>" class="btn btn-darkred"  target="<?php echo $cards_button['target']; ?>"><?php echo $cards_button['title']; ?></a> -->
		                           <button type="button" class="btn btn-darkred" ><?php echo $cards_button['title']; ?></button>
		                        </div><?php
		                    } ?>
		            	</div>
		            	<?php if($cards_button){ ?>
		            	</a>
		            	<?php } ?>
		            </div><?php
	            } ?>
            </div>
		</div>
	</section><?php
} ?>
