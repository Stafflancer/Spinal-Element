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



wp_enqueue_style('meet_the_team_styles', get_template_directory_uri() . '/static/css/modules/meet_the_team/meet_the_team.css', [], null);


wp_enqueue_script( 'meet_the_team_js', get_template_directory_uri() . '/static/js/modules/meet_the_team/meet_the_team.js', [], null, true );

$teams = get_sub_field( 'team' ); 

if ( $teams )
{ 
			
?>

<section class="meet_the_team <?php if($add_pattern == 1){ echo "add-pattern "; }
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
		<div class="team_block_header-wrap">
			<div class="team_block_header text-center row">
				<div class="col-12 col-sm-6 col-md-4 col-lg-4"><?php
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
				    } ?>
				</div>
			</div>
			<div class="meet_the_team_wrap">
				<div class="row justify-content-center"><?php 
					global $post; 
					foreach ( $teams as $post )
					{
						setup_postdata( $post ); ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-4 wow fadeInUp" data-wow-duration="1.4s">
							<div class="item_blog text-center">
								<div class="thumbnail_ava">
									<a href="<?php the_permalink(); ?>">
										<img src="<?php the_post_thumbnail_url( '' ); ?>" class="img-fluid">
									</a><?php
									$member_quote = get_field('member_quote');
									if($member_quote)
									{ ?>
										<div class="short-quote">
											<?php
											echo wp_trim_words( $member_quote, 10 );
											 ?>
										</div><?php
									} ?>
								</div>
								<div class="item_blog-info">
									<div class="item_blog-info-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</div><?php
									$position = get_field('member_position'); 
									if($position)
									{ ?>
										<div class="item_blog-info-position">
											<?php echo $position; ?>
										</div><?php
									} 
									$linkedin_url = get_field('linkedin_url');
									if($linkedin_url)
									{  ?>
										<div class="member-social-icons">
											<a href="<?php echo $linkedin_url; ?>" target="_blank" class="icon-gradient"><img src="<?php echo get_stylesheet_directory_uri()?>/static/images/linked-in.png" class="img-fluid"></a>
										</div><?php
									} ?>
								</div>
							</div>
						</div><?php
					}
					wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section><?php
} ?>
