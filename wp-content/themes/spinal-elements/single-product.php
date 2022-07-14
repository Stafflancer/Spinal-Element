<?php
get_header(); ?>
<section id="product_detail_page_id" class="product-detail-page hero_banner_centered leadership-block background-default no-background single-product-main pt-top">	
	<div class="container">
		<div class="hero-background-inner">
			<div class="row align-items-center">
				<div class="col-12">
					<div class="breadcrumbs <?php echo $breadcrumbs_color; ?>"><?php echo template_breadcrumbs(); ?></div>
					<h2 class="heading2 text-center wow fadeInUp"><?php the_title(); ?></h2><?php
					$short_description = get_field('short_description');
					if($short_description)
					{ ?>
						<div class="content text-center wow fadeInUp"><?php echo $short_description; ?></div><?php
					} ?>
				</div>
			</div>
		</div>
	</div>
</section>
<main class="main">
    <?php get_all_modules(); ?>
</main>
<?php
get_footer(); ?>