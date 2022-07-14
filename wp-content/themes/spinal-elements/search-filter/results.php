<?php
/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="container">
   <div class="row">
      <div class="col-12">
<?php

if ( $query->have_posts() )
{
	?>
	<div class="filterresblock">
	<div class="toppgtxt">	
		<span class="foundres">Found <?php echo $query->found_posts; ?> Results</span>
		<span class="pgnumres">Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?></span>
	</div>
	<div class="pagination">
		
		<div class="nav-previous"><?php next_posts_link( 'Older posts', $query->max_num_pages ); ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php
			/* example code for using the wp_pagenavi plugin */
			if (function_exists('wp_pagenavi'))
			{
				echo "<br />";
				wp_pagenavi( array( 'query' => $query ) );
			}
		?>
	</div>
	<div class="resultsblocks productlist-item-block">
	<?php
	while ($query->have_posts())
	{
		$query->the_post();
		$pid = get_the_id();
		?>
		<div class="innerfoundblock cards-items">
			<h2 class="retitle cards-details-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<?php $postcontent = get_the_content($pid);
			 if($postcontent) {?>							
			<div class="rescontent"><?php echo wp_trim_words( $postcontent, 15 ); ?></div>
			<?php } ?>
			<?php 
				if ( has_post_thumbnail() ) {
					echo '<div class="rsthumbimg cards-image"> <div class="product-list-img"><a href="'.get_the_permalink($pid).'">';
					the_post_thumbnail("small");
					echo '</a></div> </div>';
				}
			?>
			<!-- <p class="rescat"><?php the_category(); ?></p>
			<p class="restag"><?php the_tags(); ?></p>
			<p class="resdate"><small><?php the_date(); ?></small></p> -->
			<div class="card-leanmore">
				<a href="<?php the_permalink(); ?>" class="btn btn-darkred learn-more">Learn More</a>
			</div>
			
		</div>
		<?php
	}
	?>
	</div>
	<div class="bottomtotal">Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?></div>
	
	<div class="pagination">
		
		<div class="nav-previous"><?php next_posts_link( 'Older posts', $query->max_num_pages ); ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php
			/* example code for using the wp_pagenavi plugin */
			if (function_exists('wp_pagenavi'))
			{
				echo "<br />";
				wp_pagenavi( array( 'query' => $query ) );
			}
		?>
	</div>
</div>	
	<?php
}
else
{
	echo "<div class='resnotfound'>No Results Found</div>";
}
?>
</div>
</div>
</div>