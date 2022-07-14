<?php
get_header();

$postid = get_the_ID();
while ( have_posts() ) 
{ 	
	the_post();
	$category      = get_the_category();
	$mycategory    = $category[0]->cat_name;
	$category_id   = get_cat_ID( $mycategory );
	$category_link = get_category_link( $category_id );
	$image         = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	$leadership_page   = get_permalink( 533 ); 
	$company_page = get_permalink( 367 ); ?>
	<section class="team-single pt-top">
		<div class="single-team-container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumbs">
						<ul class="team-detail-breadcrumb">
							<li class="addunderline"><a href="<?php echo $company_page; ?>">Company</a></li>
							<li class="separator"></li>
							<li><a href="<?php echo $leadership_page; ?>">Leadership</a></li>
							<li class="separator"></li>
							<li><strong><?php the_title(); ?></strong></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="single-team-main wow fadeInUp"><?php 
				if ( $image ) { ?>
					<div class="single-team-image">
						<div class="single-team-inner">
						<div class="team-image-area text-center">
							<img src="<?php echo $image; ?>">
						</div><?php 
						$linkedin_url = get_field('linkedin_url');
						if($linkedin_url)
						{ ?> 
							<div class="member-social-icons">
								<a href="<?php echo $linkedin_url; ?>" target="_blank" class="icon-gradient"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/images/linked-in.png" class="img-fluid"></a>
							</div><?php
						} ?>
					</div></div><?php 
				} ?>
				<div class="single-team-data">
					<div class="single-team-topbar">
						<div class="row">
							<div class="col-12 col-lg-12">
								<h1 class="heading-team-single"><?php the_title(); ?></h1><?php
								$member_position = get_field('member_position');
								if($member_position)
								{ ?> 
									<div class="single-team-position"><?php the_field('member_position'); ?>
									</div><?php
								} ?>
							</div>
						</div>
					</div>
					<div class="content-team-single">
						<div class="team-content">
							<?php the_content(); ?>
						</div>						
					</div>
					<div class="back-btn">
						<a href="<?php echo $leadership_page; ?>" class="backbtn d-flex align-items-center">
							<span class="arrow-prev">
								<svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
								</svg>
							</span> Back to Leadership
						</a>
					</div>					
				</div>
			</div>
		</div>
	</section><?php
} ?>
<main class="main">
    <?php get_all_modules(); ?>
</main>
<?php
get_footer();