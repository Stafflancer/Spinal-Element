 <?php
function template_breadcrumbs() {
	$separator         = ' ';
	$breadcrumbs_id    = 'tsh_breadcrumbs';
	$breadcrumbs_class = 'tsh_breadcrumbs';
	$home_title        = esc_html__( 'Home', 'outlast' );

	// Add here you custom post taxonomies
	$tsh_custom_taxonomy = 'product_cat';

	global $post, $wp_query;

	ob_start();

	// Hide from front page
	if ( ! is_front_page() ) {

		echo '<ul id="' . $breadcrumbs_id . '" class="' . $breadcrumbs_class . '">';

		// Home
		//echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
		// echo '<li class="separator separator-home"> ' . $separator . ' </li>';

		if ( is_archive() && ! is_tax() && ! is_category() && ! is_tag() ) {

			echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title( '', false ) . '</strong></li>';

		} else {
			if ( is_archive() && is_tax() && ! is_category() && ! is_tag() ) {

				// For Custom post type
				$post_type = get_post_type();

				// Custom post type name and link
				if ( $post_type != 'post' ) {

					$post_type_object  = get_post_type_object( $post_type );
					$post_type_archive = get_post_type_archive_link( $post_type );

					echo '<li class="1 item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
					echo '<li class="separator"> ' . $separator . ' </li>';

				}

				$custom_tax_name = get_queried_object()->name;
				echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';

			} else {
				if ( is_single() ) {

					$post_type = get_post_type();

					if ( $post_type != 'post' && $post_type != 'team_member' ) {

						$post_type_object  = get_post_type_object( $post_type );
						$post_type_archive = get_post_type_archive_link( $post_type );

						$breadcrumbs_parent = get_field('breadcrumbs_parent');


						if($breadcrumbs_parent){

							$p1title = $breadcrumbs_parent->post_title;
							$p1id = $breadcrumbs_parent->ID;
							$p1link = get_permalink( $p1id );
							$p1parent = $breadcrumbs_parent->post_parent;

							if($p1parent){
								$superprnt = get_post($p1parent);
								$p2title = $superprnt->post_title;
								$p2id = $superprnt->ID;
								$p2link = get_permalink( $p2id );
								
								echo '<li class="supparent item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $p2link . '" title="' . $p2title . '">' . $p2title . '</a></li>';

								echo '<li class="separator"> ' . $separator . ' </li>';

							}

							echo '<li class="2 item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $p1link . '" title="' . $p1title . '">' . $p1title . '</a></li>';
						}else{
							echo '<li class="2 item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
						}
						echo '<li class="separator"> ' . $separator . ' </li>';

					}
					if ( $post_type == 'team_member' ) {
						$aboutpageurl  = get_permalink( 22 );
						$team_page_url = get_permalink( 1100 );
						echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $aboutpageurl . '" title="About">About</a></li>';
						echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $team_page_url . '" title="Meet the Team">Meet the Team</a></li>';
					}
					// Get post category
					$category = get_the_category();

					if ( ! empty( $category ) ) {

						// Last category post is in
						$last_category = $category[ count( $category ) - 1 ];

						// Parent any categories and create array
						$get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
						$cat_parents     = explode( ',', $get_cat_parents );

						// Loop through parent categories and store in variable $cat_display
						$cat_display = '';
						foreach ( $cat_parents as $parents ) {
							$cat_display .= '<li class="item-cat">' . $parents . '</li>';
							$cat_display .= '<li class="separator"> ' . $separator . ' </li>';
						}

					}

					$taxonomy_exists = taxonomy_exists( $tsh_custom_taxonomy );
					if ( empty( $last_category ) && ! empty( $tsh_custom_taxonomy ) && $taxonomy_exists ) {

						$taxonomy_terms = get_the_terms( $post->ID, $tsh_custom_taxonomy );
						$cat_id         = $taxonomy_terms[0]->term_id;
						$cat_nicename   = $taxonomy_terms[0]->slug;
						$cat_link       = get_term_link( $taxonomy_terms[0]->term_id, $tsh_custom_taxonomy );
						$cat_name       = $taxonomy_terms[0]->name;

					}

					// If the post is in a category
					if ( ! empty( $last_category ) ) {
						echo $cat_display;
						echo '<li class="item-current addunderline item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

						// Post is in a custom taxonomy
					} else {
						if ( ! empty( $cat_id ) ) {

							echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
							echo '<li class="separator"> ' . $separator . ' </li>';
							echo '<li class="item-current addunderline item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

						} else {
							if ( $post_type != 'team_member' ) {
								echo '<li class="item-current addunderline item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
							} else {
								echo '<li class="item-current addunderline item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="Leadership">Leadership</strong></li>';
							}

						}
					}

				} else {
					if ( is_category() ) {

						// Category page
						echo '<li class="item-current item-cat"><strong class="bread-current addunderline bread-cat">' . single_cat_title( '', false ) . '</strong></li>';

					} else {
						if ( is_page() ) {

							// Standard page
							if ( $post->post_parent ) {

								// Get parents
								$anc = get_post_ancestors( $post->ID );

								// Get parents order
								$anc = array_reverse( $anc );

								// Parent pages
								if ( ! isset( $parents ) ) {
									$parents = null;
								}
								foreach ( $anc as $ancestor ) {
									$parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent addunderline bread-parent-' . $ancestor . '" href="' . get_permalink( $ancestor ) . '" title="' . get_the_title( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li>';
									$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
								}

								// Render parent pages
								echo $parents;

								// Active page
								echo '<li class="item-current addunderline item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';

							} else {

								// Just display active page if not parents pages
								echo '<li class="item-current addunderline item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';

							}

						} else {
							if ( is_tag() ) { // Tag page

								// Tag information
								$term_id       = get_query_var( 'tag_id' );
								$taxonomy      = 'post_tag';
								$args          = 'include=' . $term_id;
								$terms         = get_terms( $taxonomy, $args );
								$get_term_id   = $terms[0]->term_id;
								$get_term_slug = $terms[0]->slug;
								$get_term_name = $terms[0]->name;

								// Return tag name
								echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';

							} elseif ( is_day() ) { // Day archive page

								// Year link
								echo '<li class="item-year item-year-' . get_the_time( 'Y' ) . '"><a class="bread-year bread-year-' . get_the_time( 'Y' ) . '" href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( 'Y' ) . '">' . get_the_time( 'Y' ) . ' Archives</a></li>';
								echo '<li class="separator separator-' . get_the_time( 'Y' ) . '"> ' . $separator . ' </li>';

								// Month link
								echo '<li class="item-month item-month-' . get_the_time( 'm' ) . '"><a class="bread-month bread-month-' . get_the_time( 'm' ) . '" href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . get_the_time( 'M' ) . '">' . get_the_time( 'M' ) . ' Archives</a></li>';
								echo '<li class="separator separator-' . get_the_time( 'm' ) . '"> ' . $separator . ' </li>';

								// Day display
								echo '<li class="item-current item-' . get_the_time( 'j' ) . '"><strong class="bread-current bread-' . get_the_time( 'j' ) . '"> ' . get_the_time( 'jS' ) . ' ' . get_the_time( 'M' ) . ' Archives</strong></li>';

							} else {
								if ( is_month() ) { // Month Archive

									// Year link
									echo '<li class="item-year item-year-' . get_the_time( 'Y' ) . '"><a class="bread-year bread-year-' . get_the_time( 'Y' ) . '" href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( 'Y' ) . '">' . get_the_time( 'Y' ) . ' Archives</a></li>';
									echo '<li class="separator separator-' . get_the_time( 'Y' ) . '"> ' . $separator . ' </li>';

									// Month display
									echo '<li class="item-month item-month-' . get_the_time( 'm' ) . '"><strong class="bread-month bread-month-' . get_the_time( 'm' ) . '" title="' . get_the_time( 'M' ) . '">' . get_the_time( 'M' ) . ' Archives</strong></li>';

								} else {
									if ( is_year() ) { // Display year archive

										echo '<li class="item-current item-current-' . get_the_time( 'Y' ) . '"><strong class="bread-current bread-current-' . get_the_time( 'Y' ) . '" title="' . get_the_time( 'Y' ) . '">' . get_the_time( 'Y' ) . ' Archives</strong></li>';

									} else {
										if ( is_author() ) { // Author archive

											// Get the author information
											global $author;
											$userdata = get_userdata( $author );

											// Display author name
											echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';

										} else {
											if ( get_query_var( 'paged' ) ) {

												// Paginated archives
												echo '<li class="item-current item-current-' . get_query_var( 'paged' ) . '"><strong class="bread-current bread-current-' . get_query_var( 'paged' ) . '" title="Page ' . get_query_var( 'paged' ) . '">' . __( 'Page' ) . ' ' . get_query_var( 'paged' ) . '</strong></li>';

											} else {
												if ( is_search() ) {

													// Search results page
													echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';

												} elseif ( is_404() ) {

													// 404 page
													echo '<li>' . 'Error 404' . '</li>';
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}

		echo '</ul>';

		$output_string = ob_get_contents();
		ob_end_clean();

		return $output_string;
	}
}

add_filter( 'gform_file_upload_markup', 'change_upload_markup', 10, 4 );


function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function my_plugin_body_class($classes) 
{
	if(is_front_page())
	{ 
    	$classes[] = 'home-page-body';
    }
    else
    {
    	$classes[] = 'inner-page-body';
    }
    return $classes;
}

add_filter('body_class', 'my_plugin_body_class');

function resource_list()
{ ?>
    <section class="featured_resources resource-page-list search-filter-resource">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="form-group mb-0">
						<?php echo do_shortcode( '[searchandfilter id="931"]' ); ?>
					</div>
				</div>
			</div>
			<?php
			$paged = ! empty( $_GET['sf_paged'] ) ? $_GET['sf_paged'] : 1;
			$news = new WP_Query( [
				'post_status'      => 'publish',
				'search_filter_id' => 931,
				'paged'            => $paged,
			] );

			if ( $news->have_posts() ) {
				?>
				<div id="resourcelist" class="news-list-block">
					<?php
					while ( $news->have_posts() ): $news->the_post();
						$post_id           = get_the_ID(); ?>
						<div class="news-list-items">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="news_img">
								<a href="<?php the_permalink( $post_id ); ?>">
									<?php the_post_thumbnail( ' ' ); ?>
								</a>
							</div>
						<?php } ?>
						<div class="news-block-bottom">
							<div class="news_content">
								<a href="<?php the_permalink( $post_id ); ?>" class="featured_heading"><?php echo get_the_title( $post_id ); ?></a>
								<div class="news-para-block">
									<?php
									$postcontent = get_the_content(); 
									echo wp_trim_words( $postcontent, 17 ); ?>
								</div>
							</div>
							<div class="bottom-date-btn text-right">
								<!-- <span class="date-left"><?php echo get_the_date('M d, Y'); ?></span> -->
								<a href="<?php the_permalink( $post_id ); ?>" class="btn btn-darkred btn-view">View <span class="right-arrow"></span></a>
							</div>
							</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>

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
				</div>
			<?php } ?>
		</div>
	</section><?php
} 
add_shortcode('resourcelist','resource_list'); 


function product_list()
{ ?>
    <section class="featured_resources resource-page-list cervical-block search-filter-resource">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="form-group mb-0">
						<?php //echo do_shortcode( '[searchandfilter id="1302"]' ); ?>

					<form action="#" method="post" class="searchandfilter" id="search-filter-form-1302" autocomplete="off" data-instance-count="1">
					   <ul>
					      <li class="sf-field-post_type" data-sf-field-name="_sf_post_type" data-sf-field-type="post_type" data-sf-field-input-type="select">
					         <label>
					            <span class="screen-reader-text">Product Type</span>		
					            <select name="producttypes" id="producttypesfilter" class="sf-input-select" title="Product Type">
					            <option class="" value="">Product Type</option>
					            <?php global $post;
					            	$currentpageid = $post->ID;
					            	$postparent = $post->post_parent;
					            	$args = array(
									    'post_type'      => 'page', //write slug of post type
									    'posts_per_page' => -1,
									    'post_parent'    => $postparent, //place here id of your parent page
									    'order'          => 'ASC',
									    'orderby'        => 'menu_order'
									 );
									 
									 
									$childrens = new WP_Query( $args );
									$childrens = new WP_Query( $args );
 
									if ( $childrens->have_posts() ) : ?>
									 
									    <?php while ( $childrens->have_posts() ) : $childrens->the_post(); ?>
									 		<?php if($currentpageid == get_the_ID()){ ?>
									 		<option class="" data-pageid="<?php the_ID(); ?>" value="<?php the_permalink(); ?>" selected="selected"><?php the_title(); ?></option>
									 		<?php }else{ ?>
									 		<option class="" data-pageid="<?php the_ID(); ?>" value="<?php the_permalink(); ?>"><?php the_title(); ?></option>
									       <?php } ?>
									 
									    <?php    endwhile; 
									            endif; 
									        wp_reset_query(); 
									    ?>
					             ?>	

					            </select>
					         </label>
					      </li>
					   </ul>
					</form>

					</div>
				</div>
			</div>
			<?php
			$paged = ! empty( $_GET['sf_paged'] ) ? $_GET['sf_paged'] : 1;
			global $post;
			$news = new WP_Query( [
				'post_type'        => 'pages',
				'post_status'      => 'publish',
				'search_filter_id' => 1302,
				'paged'            => $paged,
				'post_parent'      => $post->ID
			] );

			if ( $news->have_posts() ) {
				?>
				<div id="productlist" class="productlist-item-block">
					<?php
					while ( $news->have_posts() ): $news->the_post();
						$post_id  = get_the_ID(); ?>
						<div class="cards-items wow fadeInUp">
	                    	<div class="cards-content-item-flex">
	                    		<div class="cards-content">
		                            <div class="cards-details">
		                            	<h2 class="cards-details-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php
		                            	$productcontent = get_the_content();
		                            	if($productcontent)
		                            	{ ?>
			                            	<div class="cards-content">
			                            		<?php echo wp_trim_words( $productcontent, 10 ); ?>
			                            	</div><?php
			                            } ?>
		                            </div>
		                        </div>
		                        <div class="cards-image">
		                            <div class="main-card-image">
			                            <div class="product-main-image thefront"><a href="<?php the_permalink(); ?>"><?php 
				                            if ( has_post_thumbnail() ) { ?>
												<div class="product-list-img">
													<a href="<?php the_permalink( $post_id ); ?>">
														<?php the_post_thumbnail( ' ' ); ?>
													</a>
												</div><?php 
											} ?>
										</div>
									</div>
	                        	</div>
	                    	</div>
	                    	<div class="card-leanmore">
                        		<a href="<?php the_permalink(); ?>" class="btn btn-darkred learn-more">Learn More</a>
                        	</div>
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
				</div>
				<?php wp_reset_postdata(); ?>
			<?php } ?>
		</div>
	</section><?php
} 
add_shortcode('productlist','product_list'); 


function distributor_resource_list()
{ ?> <section class="featured_resources resource-page-list distributor-portal search-filter-resource">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="form-group mb-0">
						<?php echo do_shortcode( '[searchandfilter id="1392"]' ); ?>
					</div>
				</div>
			</div>
			<?php
			$paged = ! empty( $_GET['sf_paged'] ) ? $_GET['sf_paged'] : 1;
			$news = new WP_Query( [
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'search_filter_id' => 1392,
				'paged'            => $paged,
			] );

			if ( $news->have_posts() ) 
			{	?>
				<div id="distributor_resource_list" class="news-list-block"><?php
					while ( $news->have_posts() ): $news->the_post();
						$post_id  = get_the_ID();
						$select_upload_type = get_field('select_upload_type', $post_id); 
						$upload_pdf = get_field('upload_pdf', $post_id);
						$upload_video = get_field('upload_video', $post_id);
						$upload_image = get_field('upload_image', $post_id);
						$workcategory = wp_get_post_terms( get_the_ID(), 'distributor_content_type' ); 
						$arraycatname = array(); 
		                $workterm_id = array(); 
		                foreach($workcategory as $thisslug) 
		                {
		                  $arraycatname[] = $thisslug->name;
		                  $workterm_id[] = $thisslug->term_id;
		                } 
		                $content_type_category = implode( ", ", $arraycatname );
		                $content_type_term_id = implode( " ", $workterm_id ); 

		                $category = wp_get_post_terms( get_the_ID(), 'category' ); 
						$maincategoryname = array(); 
		                foreach($category as $categorynew) 
		                {
		                  $maincategoryname[] = $categorynew->name;
		                } 
		                $main_category = implode( ", ", $maincategoryname ); 
		                $upload_icon = get_field('upload_icon', 'distributor_content_type' . '_' .$content_type_term_id); ?>
						<div class="distributor-items wow fadeInUp">
	                    	<div class="distributor-content-item-flex">
	                    		<div class="podcast-info"><?php
	                    			if($content_type_category)
		                    		{ ?>
			                    		<div class="distributor_content_type">
			                    			<span><?php echo $content_type_category; ?></span>
			                    		</div><?php
			                    	} 
			                    	if($upload_icon)
			                    	{ ?>
			                    		<div class="distributor-image">
				                            <img src="<?php echo $upload_icon['url']; ?>">
			                        	</div><?php
			                        } ?>
		                        </div>
		                        <div class="category-min"><?php
		                        	if($main_category)
		                    		{ ?>
			                    		<div class="category-inner-nm">
			                    			<?php echo $main_category; ?>
			                    		</div><?php
			                    	} ?>
		                        </div>
	                    		<div class="distributor-content">
		                            <div class="distributor-details">
		                            	<h2 class="distributor-details-heading"><?php the_title(); ?></h2>
		                            </div>
		                        </div>
	                    	</div>
	                    	<div class="distributor-leanmore"><?php
		                    	if($select_upload_type == 'file')
								{
									if($upload_pdf)
	                                { ?>
	                                    <a href="<?php echo $upload_pdf['url']; ?>" download="<?php echo $upload_pdf['url']; ?>" class="btn download-more">Download</a><?php
	                                } ?>
	                        		<a href="<?php echo $upload_pdf['url']; ?>" target="_blank" class="btn btn-darkred view-btn">View</a><?php
								}
								else if($select_upload_type == 'image')
								{
									if($upload_image)
	                                { ?>
	                                    <a href="<?php echo $upload_image['url']; ?>" download="<?php echo $upload_image['url']; ?>" class="btn download-more">Download</a><?php
	                                } ?>
	                        		<a href="<?php echo $upload_image['url']; ?>" target="_blank" class="btn btn-darkred view-btn">View</a><?php
								}
								else
								{
									if($upload_video)
	                                { ?>
	                                    &nbsp; <?php
	                                } ?>
	                        		<a href="<?php echo $upload_video; ?>" target="_blank" class="btn btn-darkred view-btn viewvideo">View</a><?php
								} ?>                             
                        	</div>
	                    </div>
					<?php endwhile; 
					wp_reset_postdata(); ?>
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
				</div>
				<?php 
				 
			} ?>
		</div>
	</section>
    <?php
} 
add_shortcode('distributor_resource_list','distributor_resource_list'); 