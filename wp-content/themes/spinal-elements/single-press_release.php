<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package retrain
 */

get_header();

$postid = get_the_ID();
while ( have_posts() ) : the_post();
	$category      = get_the_category();
	$mycategory    = $category[0]->cat_name;
	$category_id   = get_cat_ID( $mycategory );
	$category_link = get_category_link( $category_id );
	$image         = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	$blogpageurl   = get_permalink( 866 );
	?>
	<section class="rightsideicons">
		<?php echo do_shortcode('[addtoany]'); ?>
	</section>
	<section class="blog-single pt-top">
		<div class="container">
			<div class="back-section">
				<div class="row">
					<div class="col-12 col-lg-12">
						<div class="breadcrumbs <?php echo $breadcrumbs_color; ?>">PRESS RELEASE /</div> <br />
					</div>
				</div>
			</div>
			<div class="single-blog-topbar">
				<div class="row">
					<div class="col-12 col-lg-12">

						<h1 class="heading-blog-single"><?php the_title(); ?></h1>
						<div class="details-meta-tab">
							<span class="posted-by"><?php echo get_the_date('M d, Y'); ?></span>
							<div class="reading"><?php echo do_shortcode('[rt_reading_time label="Reading Time:" postfix="minutes" postfix_singular="minute"]'); ?></div>
						</div>
					</div>
				</div>
			</div><?php 
			if ( $image ) { ?>
				<div class="single-blog-image">
					<div class="row">
						<div class="col-12 col-lg-12">
							<div class="blog-image-area text-center">
								<img src="<?php echo $image; ?>">
							</div>
						</div>
					</div>
				</div><?php 
			} ?>
		<div class="content-blog-single">
			<div class="blog-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	</section>
<?php endwhile; ?>
<?php
wp_enqueue_style('cta_promo_bar_style', get_template_directory_uri() . '/static/css/modules/cta_promo_bar/cta_promo_bar.css', [], null);

wp_enqueue_script( 'cta_promo_bar_js', get_template_directory_uri() . '/static/js/modules/cta_promo_bar/cta_promo_bar.js', [], null, true );
/* BG Settings */
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
$custom_css_class = get_field('custom_css_class');

if(have_rows('content_block'))
{ 
	while(have_rows('content_block'))
	{ 
	    the_row();
		$cta_promo_heading = get_sub_field('cta_promo_heading'); 
		$cta_promo_button = get_sub_field('cta_promo_button');  
		if($cta_promo_heading || $cta_promo_button)
		{ ?> 
			<section class="cta_promobar <?php echo " content_width".$content_width ; ?> <?php if($add_pattern == 1){ echo "add-pattern "; }
			    if ( $media_type == 'image' && ! empty( $image ) && $parallax ) {
			        echo 'prallax-added ';
			    }
			    if( $media_type == 'color' && $color != '')
			    {
			        echo "bg-".$color;
			    }
			    else
			    {
			        echo "default-bg-cta ";
			    }
			    /* css class */
			    echo ! empty( $custom_css_class ) ? $custom_css_class . ' ' : '';

			    /* bg image */
			    echo ( 'image' === $media_type && ! empty( $image ) ) ? 'bg-image ' : '';
			    /* bg color */
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
		        if ( ( 'image' === $media_type || 'video' === $media_type ) && $add_overlay==1 && ! empty( $overlay_color ) ) { ?>
		            <div class="overlay <?php echo $overlay_color; ?>"></div>
		        <?php }
		        /* video */
		        if ( 'video' === $media_type && ( ! empty( $video_mp4 ) || ! empty( $video_webm ) ) ) { ?>
		            <video class="bg-video" autoplay muted>
		                <source src="<?php echo $video_mp4['url'] ?>" type="video/mp4">
		                <source src="<?php echo $video_webm['url'] ?>" type="video/webm">
		            </video>
		        <?php } ?>

	    		<div class="right-content-blog">
	    			<div class="cta-block-single-right"><?php 
						if ( ! ( empty( $cta_promo_heading ) ) ): ?>
						<h2 class="heading-title-dark  <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; } ?>"><?php echo $cta_promo_heading; ?></h2><?php 
						endif;
						if ( ! ( empty( $cta_promo_button ) ) ): ?>
							<a href="<?php echo $cta_promo_button['url']; ?>" class="btn cta-promo-btn"><?php echo $cta_promo_button['title']; ?></a>
								<?php 
						endif; ?>
					</div>
				</div>
	 		</section><?php
		}
	}
} ?>
 <section class="other-bottom-section">
 	<div class="container"><?php
 		$other_description = get_field('other_description');
		if($other_description)
		{ ?> 
			<div class="othersection">
				<?php the_field('other_description'); ?>
			</div><?php
		} ?>
 	</div>
 </section>
 <div class="navigation max-width-nav">
		<div class="container">
			<div class="d-flex justify-content-between">
				<div class="per-class">
					<?php
					$prev_post = get_previous_post();
					if ( $prev_post ) {
						$prev_title = strip_tags( str_replace( '"', '', $prev_post->post_title ) );
						echo "\t" . '<a id="prev" rel="prev" href="' . get_permalink( $prev_post->ID ) . '" title="' . $prev_title . '" class="prev-arrow btn-arrow">
								<span class="btn-arrow-icon"><svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path></svg></span>
							Previous</a>' . "\n";
					} ?>
				</div>
				<div class="next-class"><?php
					$next_post = get_next_post();
					if ( $next_post ) {
						$next_title = strip_tags( str_replace( '"', '', $next_post->post_title ) );
						echo "\t" . '<a id="next" rel="next" href="' . get_permalink( $next_post->ID ) . '" title="' . $next_title . '" class="next-arrow btn-arrow">Next <span class="btn-arrow-icon"><svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path></svg></span></a>' . "\n";
					}
					?>
				</div>
			</div>
		</div>
	</div><?php
/* BG Settings */
$cta_subscribe_media_type    = get_field('cta_subscribe_media_type');
$cta_subscribe_add_overlay   = get_field('cta_subscribe_add_overlay');
if($cta_subscribe_add_overlay == 1)
{
    $cta_subscribe_overlay_color = get_field('cta_subscribe_overlay_color');
}
$cta_subscribe_parallax      = get_field('cta_subscribe_parallax');
$cta_subscribe_color         = get_field('cta_subscribe_color');
$cta_subscribe_image         = get_field('cta_subscribe_image');
$cta_subscribe_video_mp4     = get_field('cta_subscribe_video_mp4');
$cta_subscribe_video_webm    = get_field('cta_subscribe_video_webm');
$cta_subscribe_add_pattern    = get_field('cta_subscribe_add_pattern');

/* Other Settings */
$cta_subscribe_heading_color        = get_field('cta_subscribe_heading_color');
$cta_subscribe_text_color    = get_field('cta_subscribe_text_color');
$cta_subscribe_add_underline  = get_field('cta_subscribe_add_underline'); 
$cta_subscribe_content_width = get_field('cta_subscribe_content_width');
$cta_subscribe_custom_class = get_field('cta_subscribe_custom_class');


wp_enqueue_style('cta_subscribe_style', get_template_directory_uri() . '/static/css/modules/cta_subscribe/cta_subscribe.css', [], null);

wp_enqueue_script( 'cta_subscribe_js', get_template_directory_uri() . '/static/js/modules/cta_subscribe/cta_subscribe.js', [], null, true );

if(have_rows('cta_subscribe_content_block'))
{	
	while(have_rows('cta_subscribe_content_block'))
	{
		the_row();
		$cta_subscribe_heading = get_sub_field('cta_subscribe_heading');
		$cta_subscribe_content = get_sub_field('cta_subscribe_content');
		$cta_subscribe_form = get_sub_field('cta_subscribe_form');
		if($cta_subscribe_heading || $cta_subscribe_heading)
		{  ?>
			<section class="cta_subscribe <?php if($cta_subscribe_add_pattern == 1){ echo "add-pattern "; }
			    if ( $cta_subscribe_media_type == 'image' && ! empty( $cta_subscribe_image ) && $cta_subscribe_parallax ) {
			        echo 'prallax-added ';
			    }
			    if( $cta_subscribe_media_type == 'color' && $cta_subscribe_color != '')
			    {
			        echo "bg-".$cta_subscribe_color;
			    }
			    else
			    {
			        echo "default-bg-cta ";
			    }
			    /* css class */
			    echo ! empty( $cta_subscribe_custom_class ) ? $cta_subscribe_custom_class . ' ' : '';

			    /* bg image */
			    echo ( 'image' === $cta_subscribe_media_type && ! empty( $cta_subscribe_image ) ) ? 'bg-image ' : '';
			    /* bg color */
			    ?>"
		        <?php
		       
		        /* bg image */
		        if ( 'image' === $cta_subscribe_media_type && ! empty( $cta_subscribe_image ) && $cta_subscribe_parallax ) { ?>style="background-image: url('<?php echo $cta_subscribe_image ?>')"
		        <?php }
		         if ( $cta_subscribe_media_type == 'image' && !empty($cta_subscribe_image) &&  $cta_subscribe_add_overlay == 1 && ! empty( $cta_subscribe_overlay_color )) 
		        { ?>style="background-image: url('<?php echo $cta_subscribe_image ?>')"
		        <?php }
		        if ( $cta_subscribe_media_type == 'image' && !empty($cta_subscribe_image)) 
		        { ?>style="background-image: url('<?php echo $cta_subscribe_image ?>')"
		        <?php }
		        ?>>
		        <?php
		        /* overlay */
		        if ( ( 'image' === $cta_subscribe_media_type || 'video' === $cta_subscribe_media_type ) && $cta_subscribe_add_overlay==1 && ! empty( $cta_subscribe_overlay_color ) ) { ?>
		            <div class="overlay <?php echo $cta_subscribe_overlay_color; ?>"></div>
		        <?php }
		        /* video */
		        if ( 'video' === $cta_subscribe_media_type && ( ! empty( $cta_subscribe_video_mp4 ) || ! empty( $cta_subscribe_video_webm ) ) ) { ?>
		            <video class="bg-video" autoplay muted>
		                <source src="<?php echo $cta_subscribe_video_mp4['url'] ?>" type="video/mp4">
		                <source src="<?php echo $cta_subscribe_video_webm['url'] ?>" type="video/webm">
		            </video>
		        <?php } ?>

	        		<div class="container <?php echo "content_width".$cta_subscribe_content_width; ?>">
			          	<div class="CTA-subscribe-form-inner">
			          			<div class="CTA-subscribe-details"><?php
				          			if($cta_subscribe_heading)
				          			{ ?>
										<h2 class="heading-title-dark  <?php echo $heading_color; ?> <?php if($add_heading_underline == 1){ echo "addunderline"; } ?>"><?php echo $cta_subscribe_heading; ?></h2><?php
									}
									if($cta_subscribe_content)
									{ ?>
										<div class="content <?php echo $cta_subscribe_text_color; ?>"><?php echo $cta_subscribe_content; ?></div><?php
									} ?>
								</div><?php
								if($cta_subscribe_form)
								{ ?>
									<div class="form-now-cta">
										<?php echo do_shortcode('[gravityform id="'.$cta_subscribe_form.'" title="false" ajax="true"]'); ?> 
									</div><?php
								} ?>
						</div>
	        		</div>
			 </section><?php
		}
	}
}
wp_enqueue_style('slick-style', get_template_directory_uri() . '/static/css/modules/carousel_gallery_with_buttons/slick.min.css', [], null);

wp_enqueue_script('slick-script', get_template_directory_uri() . '/static/js/modules/carousel_gallery_with_buttons/slick.min.js', ['jquery'], null, true);

$related_posts = get_field('related_posts');
if($related_posts)
{ ?>
	<section class="featured_resource related-reads">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="form-group mb-0"><?php
						$related_heading = get_field('related_heading');
						if($related_heading)
						{ ?>
							<h2 class="text-center wow fadeInUp related-reads-heading"><?php echo $related_heading; ?></h2><?php
						}
						if($related_content)
					    { ?>
					        <div class="content text-center wow fadeInUp">
					            <?php echo $related_content;?>  
					        </div><?php
					    } ?>
					</div>
				</div>
			</div>
			<div class="news-list-block related-post-slider"><?php 
					global $post; 
					foreach ( $related_posts as $post )
					{
						setup_postdata( $post ); ?>
						<div class="news-list-items">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="news_img">
									<a href="<?php the_permalink( $item ); ?>">
										<?php the_post_thumbnail($item, 's_243'); ?>
									</a>
								</div>
							<?php } ?>
							<div class="news-block-bottom">
								<div class="news_content">
									<a href="<?php the_permalink( $item ); ?>" class="featured_heading"><?php echo get_the_title( $item ); ?></a>
									<div class="news-para-block">
										<?php
										$postcontent = get_the_content($item); 
										echo wp_trim_words( $postcontent, 15 ); ?>
									</div>
								</div>
								<div class="bottom-date-btn text-right">
									<span class="date-left"><?php echo get_the_date('M d, Y'); ?></span>
									<a href="<?php the_permalink( $item ); ?>" class="btn btn-darkred btn-view">View <span class="right-arrow"></span></a>
								</div>
							</div>
						</div><?php
				} wp_reset_postdata(); ?>
				
			</div>		
		</div>
	</section><?php
} ?>
<script>
jQuery(document).ready(function($) 
{
	$('.related-post-slider').slick({
        dots: false,
        arrows: true, 
        adaptiveHeight: true,
        slidesToShow: 3, 
        slidesToScroll: 1, 
        prevArrow: '<div class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/></svg></div>',
        nextArrow: '<div class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/></svg></div>', 
        responsive: [
        	{ 
	        	breakpoint: 1199,
	        	settings: { 
	            	slidesToShow: 2 
	            } 
	        },
	        { 
	        	breakpoint: 768,
	        	adaptiveHeight: true,
	        	settings: { 
	            	slidesToShow: 1 
	            } 
	        }

        ] 
    });
});
</script><?php
get_footer();