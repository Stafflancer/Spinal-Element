<?php /* Template Name: News */
get_header(); 

$media_type    = get_field('media_type');
$add_overlay   = get_field('add_overlay');
if($add_overlay == 1)
{
	$overlay_color = get_field('overlay_color');
}

$parallax      = get_field('parallax');
$color         = get_field('color');
$image         = get_field('image');
$video_mp4     = get_field('video_mp4');
$video_webm    = get_field('video_webm');
$add_pattern    = get_field('add_pattern');

/* Other Settings */
$heading_color        = get_field('heading_color');
$text_color    = get_field('text_color');
$add_heading_underline  = get_field('add_heading_underline'); 
$content_width = get_field('content_width');
$custom_css_class = get_field('custom_class');

wp_enqueue_style('hero_banner_centered_styles', get_template_directory_uri() . '/static/css/modules/hero_banner_centered/hero_banner_centered.css', [], null);
wp_enqueue_script('hero_banner_centered', get_template_directory_uri() . '/static/js/modules/hero_banner_centered/hero_banner_centered.js', '', '', true);
// Setup defaults.
$args = [
	'container'       => 'section',
	'background_type' => $media_type,
	'class'           => 'hero_banner_centered AktivGrotesk-Regular '.$custom_css_class.'',
	'id'              => '',
	'attributes'      => '',
];

$background_video_markup = $background_image_markup = $background_overlay_markup = '';

// Only try to get the rest of the settings if the background type is set to anything.
if ( $args['background_type'] ) {
	if ( 'color' === $args['background_type'] && $color ) {
		$args['class'] .= ' has-background color-as-background bg-' . esc_attr( $color );
	}
	if ( $media_type == 'image' && ! empty( $image ) && $parallax ) {
		$args['class'] .= ' prallax-added';
	}
	if($add_pattern == 1)
	{ 
		$args['class'] .= ' add-pattern ';
	}
	if ( $media_type == 'none' ) {
		$args['class'] .= ' bg-default-gradient';
	}

	if ( 'image' === $args['background_type'] && $image ) {
		// Make sure images stay in their containers - relative + overflow hidden.
		$args['class']      .= ' has-background image-as-background bg-image';
		$args['attributes'] .= ' style="background-image: url(' . $image . ');"';

		if ( $parallax && $image ) {
			$args['class']      .= ' has-parallax';
			$args['attributes'] .= ' data-parallax="scroll"  data-image-src="' . $image . '"';
		}
	}

	if ( 'video' === $args['background_type'] ) {
		$video_mp4  = get_field( 'video_mp4' );
		$video_webm = get_field( 'video_webm' );

		// Make sure videos stay in their containers - relative + overflow hidden.
		$args['class'] .= ' has-background video-as-background video-bg';

		ob_start();
		?>
		<figure class="video-background">
			<video id="<?php echo esc_attr( $args['id'] ); ?>-video" autoplay muted playsinline preload="none" class="bg-video">
				<?php if ( $video_webm['url'] ) : ?>
					<source src="<?php echo esc_url( $video_webm['url'] ); ?>" type="video/webm">
				<?php endif; ?>
				<?php if ( $video_mp4['url'] ) : ?>
					<source src="<?php echo esc_url( $video_mp4['url'] ); ?>" type="video/mp4">
				<?php endif; ?>
			</video>
		</figure>
		<?php
		$background_video_markup = ob_get_clean();
	}

	if ( ( 'image' === $args['background_type'] || 'video' === $args['background_type'] ) ) {
		if ( $mobile_image_id ) {
			ob_start();
			?>
			<figure class="image-background mobile-background-figure" aria-hidden="true">
				<?php echo wp_get_attachment_image( $mobile_image_id, 'full', false, array( 'class' => 'mobile-background-image' ) ); ?>
			</figure>
			<?php
			$background_image_markup = ob_get_clean();
		}

		if ( $add_overlay == 1 && $overlay_color ) {
			$args['class'] .= ' has-overlay';
			$args['class'] .= ' has-overlay-color-' . esc_attr( $overlay_color );

			ob_start();
			?>
			<div class="overlay <?php echo $overlay_color; ?>"></div>
			<?php
			$background_overlay_markup = ob_get_clean();
		}
	}

	if ( 'none' === $args['background_type'] ) {
		$args['class'] .= ' no-background';
	}
}

// Print our block container with options.
printf( '<%s id="%s" class="%s"%s>', esc_attr( $args['container'] ), esc_attr( $args['id'] ), esc_attr( $args['class'] ), $args['attributes'] );

// If we have a background overlay, echo our background overlay markup inside the block container.
if ( $background_overlay_markup ) {
	echo $background_overlay_markup; // WPCS XSS OK.
}

// If we have a background video, echo our background video markup inside the block container.
if ( $background_video_markup ) {
	echo $background_video_markup; // WPCS XSS OK.
}

// If we have a background image, echo our background image markup inside the block container.
if ( $background_image_markup ) {
	echo $background_image_markup; // WPCS XSS OK.
}
?>
	<div class="container">
		<div class="hero-background-inner">
			<div class="row align-items-center">
				<div class="col-12">
					<div class="breadcrumbs <?php echo $breadcrumbs_color; ?>"><?php echo template_breadcrumbs(); ?></div><?php
					$s_heading = get_field('s_heading');
					$s_content = get_field('s_content');
					$button   = get_field('button'); 
					if ( $s_heading ) 
					{ ?>
					 	<h2 class="heading2 text-center wow fadeInUp <?php echo $heading_color; ?> <?php if($add_heading_underline == 1)
						{ echo "addunderline"; } ?>"><?php echo $s_heading; ?></h2><?php 
					} 
					if($s_content)
		    		{ ?>
		        		<div class="content text-center wow fadeInUp <?php echo $text_color; ?>">
		            		<?php echo $s_content; ?>
		            	</div><?php
		            } 
		            if ($button) 
					{ ?>
						<div class="btn-about">
							<a href="<?php echo $button['url']; ?>" class="btn btn-darkred" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
						</div><?php 
					} 
					$hero_banner_centered_form = get_field('hero_banner_centered_form');
					if($hero_banner_centered_form)
					{  ?>
						<div class="grivity-form">
							<?php echo do_shortcode( '[gravityform id="' . $hero_banner_centered_form . '" title="false" ajax="true"]' ); ?>
						</div><?php
					} ?>
				</div>
			</div>
		</div>
	</div>
</<?php echo $args['container']; ?>>
<section class="featured_resources news-list search-filter-resource">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="form-group mb-0">
					<?php echo do_shortcode( '[searchandfilter id="816"]' ); ?>
				</div>
			</div>
		</div>
		<?php
		$paged = ! empty( $_GET['sf_paged'] ) ? $_GET['sf_paged'] : 1;
		$news = new WP_Query( [
			'post_status'      => 'publish',
			'search_filter_id' => 816,
			'paged'            => $paged,
		] );

		if ( $news->have_posts() ) {
			?>
			<div id="news" class="news-list-block">
				<?php
				while ( $news->have_posts() ): $news->the_post();
					$post_id  = get_the_ID(); ?>
					<div class="news-list-items">
						<a href="<?php the_permalink( $post_id ); ?>">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="news_img">
								<!-- <a href="<?php the_permalink( $post_id ); ?>"> -->
									<?php the_post_thumbnail( ' ' ); ?>
								<!-- </a> -->
							</div>
						<?php } ?>
						<div class="news-block-bottom">
							<div class="news_content">
								<!-- <a href="<?php the_permalink( $post_id ); ?>" class="featured_heading"> --><h2 class="featured_heading"><?php echo get_the_title( $post_id ); ?></h2><!-- </a> -->
								<div class="news-para-block">
									<?php
									$postcontent = get_the_content(); 
									echo wp_trim_words( $postcontent, 17 ); ?>
								</div>
							</div>
							<div class="bottom-date-btn text-right">
								<span class="date-left"><?php echo get_the_date('M d, Y'); ?></span>
								<!-- <a href="<?php the_permalink( $post_id ); ?>" class="btn btn-darkred btn-view">View <span class="right-arrow"></span></a> -->
								<button type="button" class="btn btn-darkred btn-view" >View</button>
							</div>
							</div>
					</a>
					</div>
				<?php endwhile; ?>
				<div class="pagination-set">
					<div class="pagination-bottom d-flex justify-content-center pagination">
						<?php
						echo paginate_links( [
							'prev_text' => "<span class='icon-left'><img src='https://dev-spinal-elements.pantheonsite.io/wp-content/uploads/2022/05/Group-80726.png' /></span>",
							'next_text' => "<span class='icon-right'><img src='https://dev-spinal-elements.pantheonsite.io/wp-content/uploads/2022/05/Icon.png' /></span>",
							'base'      => site_url() . '%_%',
							'format'    => "?paged=%#%",
							'total'     => $news->max_num_pages,
							'current'   => $paged,
							'mid_size'  => 1,
							'end_size'  => 0,
						] );
						?>
					</div>
				</div>
				<?php wp_reset_postdata(); ?>
			</div>
		<?php } ?>
	</div>
</section>
<?php


/* BG Settings */
$cta_media_type    = get_field('cta_media_type');
$cta_add_overlay   = get_field('cta_add_overlay');
if($cta_add_overlay == 1)
{
    $cta_overlay_color = get_field('cta_overlay_color');
}
$cta_parallax      = get_field('cta_parallax');
$cta_color         = get_field('cta_color');
$cta_image         = get_field('cta_image');
$cta_video_mp4     = get_field('cta_video_mp4');
$cta_video_webm    = get_field('cta_video_webm');
$cta_add_pattern    = get_field('cta_add_pattern');

/* Other Settings */
$cta_heading_color        = get_field('cta_heading_color');
$cta_text_color    = get_field('cta_text_color');
$cta_add_heading_underline  = get_field('cta_add_heading_underline'); 
$cta_content_width = get_field('cta_content_width');
$cta_custom_class = get_field('cta_custom_class');


wp_enqueue_style('cta_side_form_style', get_template_directory_uri() . '/static/css/modules/cta_side_form/cta_side_form.css', [], null);

wp_enqueue_script( 'cta_side_form_js', get_template_directory_uri() . '/static/js/modules/cta_side_form/cta_side_form.js', [], null, true );

?>
<section class="cta_side_form <?php if($cta_add_pattern == 1){ echo "add-pattern "; }
    if ( $cta_media_type == 'image' && ! empty( $cta_image ) && $cta_parallax ) {
        echo 'prallax-added ';
    }
    if( $cta_media_type == 'color' && $cta_color != '')
    {
        echo "bg-".$cta_color;
    }
    else
    {
        echo "default-bg-cta ";
    }
    /* css class */
    echo ! empty( $cta_custom_class ) ? $cta_custom_class . ' ' : '';

    /* bg image */
    echo ( 'image' === $cta_media_type && ! empty( $cta_image ) ) ? 'bg-image ' : '';
    /* bg color */
    ?>"
        <?php
       
        /* bg image */
        if ( 'image' === $cta_media_type && ! empty( $cta_image ) && $cta_parallax ) { ?>style="background-image: url('<?php echo $cta_image ?>')"
        <?php }
         if ( $cta_media_type == 'image' && !empty($cta_image) &&  $cta_add_overlay == 1 && ! empty( $cta_overlay_color )) 
        { ?>style="background-image: url('<?php echo $cta_image ?>')"
        <?php }
        if ( $cta_media_type == 'image' && !empty($cta_image)) 
        { ?>style="background-image: url('<?php echo $cta_image ?>')"
        <?php }
        ?>>
        <?php
        /* overlay */
        if ( ( 'image' === $cta_media_type || 'video' === $cta_media_type ) && $cta_add_overlay==1 && ! empty( $cta_overlay_color ) ) { ?>
            <div class="overlay <?php echo $cta_overlay_color; ?>"></div>
        <?php }
        /* video */
        if ( 'video' === $cta_media_type && ( ! empty( $cta_video_mp4 ) || ! empty( $cta_video_webm ) ) ) { ?>
            <video class="bg-video" autoplay muted>
                <source src="<?php echo $cta_video_mp4['url'] ?>" type="video/mp4">
                <source src="<?php echo $cta_video_webm['url'] ?>" type="video/webm">
            </video>
        <?php } ?>

        <div class="container <?php echo "content_width".$cta_content_width; ?>">
            <div class="cta_side_form_main_block wow fadeInUp"><?php
                if(have_rows('cta_side_image_content'))
                { 
                    while(have_rows('cta_side_image_content'))
                    { 
                        the_row(); 
                        $cta_heading = get_sub_field('cta_heading');
                        $cta_side_image_content = get_sub_field('cta_side_image_content'); ?>
                        <div class="cta_side_form_row"><?php 
                            if ( $cta_heading ) 
                            { ?>
                                <h2 class="heading-red-block heading-title-dark  <?php echo $cta_heading_color; ?> <?php if($cta_add_heading_underline == 1){ echo "addunderline"; } ?>"><?php echo $cta_heading; ?></h2><?php 
                            } 
                            if ( $cta_side_image_content ) 
                            { ?>
                                <div class="content <?php echo $cta_text_color; ?>"><?php echo $cta_side_image_content; ?></div><?php 
                            } ?>
                        </div><?php
                    }
                }
               
                $cta_form = get_field('cta_form'); 
                if($cta_form)
                { ?>
                    <div class="right-side-form">
                        <?php echo do_shortcode( '[gravityform id="' . $cta_form . '" title="false" ajax="true"]' ); ?>
                    </div><?php
                } ?>
            </div>
        </div>
 </section>
<?php 
get_footer(); 
?>
