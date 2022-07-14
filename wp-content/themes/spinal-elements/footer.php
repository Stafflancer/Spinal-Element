<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package retrain
 */
?>

<footer id="footer-retrain">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8">
					<div class="footer-links"><?php
						wp_nav_menu( array(
					        'menu' => 'Footer Menu',
					        'theme_location' => 'footer',
					        'menu_class'  => 'footer-link-style',
					        'container' => 'ul',
					        'before'         => '',
							'after'          => '',
							'depth'          => 3,
							'link_before'    => '',
							'link_after'     => '',
					            
					   	) ); ?>
					</div>
					<div class="footer-addres-quarter"><?php
					if ( have_rows( 'contact_group', 'option' ) ) 
					{
						while ( have_rows( 'contact_group', 'option' ) ) 
						{
							the_row();
							$logo    = get_sub_field( 'logo' );
							$addresses = get_sub_field( 'addresses' );
							$phone    = get_sub_field( 'phone' );
							if ( $logo ) 
							{ ?>
								<div class="footer-logo">
									<a href="<?php echo site_url(); ?>">
									<img src="<?php echo $logo; ?>" class="img-fluid"></a>
								</div><?php 
							}
							if ( have_rows( 'addresses', 'option' ) ) 
							{
								while ( have_rows( 'addresses', 'option' ) ) 
								{
									the_row();
									$add_title      = get_sub_field( 'title' );
									$address_line_1 = get_sub_field( 'address_line_1' );
									$address_line_2 = get_sub_field( 'address_line_2' ); ?>
									<div class="headquarters"><?php
									if ( $add_title ) 
									{ ?>
										<h4 class="heading-footer"><?php echo $add_title; ?></h4></br><?php
									}
									if ( $address_line_1 )
									{ ?>
										<div class="address"><?php echo $address_line_1; ?></br>
											<?php echo $address_line_2; ?>	
										</div><?php
									}
								}
							}
							if ($phone) 
							{ ?>
								<a href="<?php echo $phone['url']; ?>"><?php echo $phone['title']; ?></a><?php 	
							}	
						}
					} 
					if ( have_rows( 'copyright_group', 'option' ) ) 
					{ ?>
						<div class="copyright-text"><?php
							while ( have_rows( 'copyright_group', 'option' ) ) 
							{
								the_row();
								$copyright = get_sub_field( 'copyright'); ?>
								<div class="col-12 col-lg-12">
									<div class="copyright-footer">&copy; <?php echo gmdate('Y') . ' ' . $copyright; ?> | <?php
										if (have_rows( 'links', 'option' ) ) 
										{
											while ( have_rows( 'links', 'option' ) ) 
											{
												the_row();
												$link = get_sub_field( 'link' ); ?>
												<a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
												<?php
											}
										} ?>
									</div>
								</div><?php
							} ?>
						</div><?php
					} ?>
				</div>
			</div>
		</div>
			<div class="col-lg-4"><?php
					$footer_badges = get_field('footer_badges', 'option');
					if($footer_badges)
					{ ?>
						<div class="footer-gallery"><?php
						foreach( $footer_badges as $footergallery )
						{ ?>
							<div class="footer-gallery-item">
								<img src="<?php echo esc_url($footergallery['url']); ?>">
							</div><?php
						} ?>
						</div><?php
					}
					if ( have_rows( 'social_media', 'option' ) )
					{ ?>
						<div class="social-links">
							<ul class="list-unstyled d-flex mb-0 social-icons-footer justify-content-end"><?php
								while ( have_rows( 'social_media', 'option' ) )
								{
									the_row();
									$linkedin = get_sub_field( 'linkedin' );
									$facebook = get_sub_field( 'facebook' );
									$twitter  = get_sub_field( 'twitter' );
									$youtube  = get_sub_field( 'youtube' );

									if ($linkedin ) { ?>
										<li>
											<a href="<?php echo $linkedin; ?>" target="_blank">
												<img src="<?php echo get_stylesheet_directory_uri() ?>/static/images/linked-in.png" class="img-fluid">
											</a>
										</li><?php
									}
									if ( $facebook ) { ?>
										<li>
											<a href="<?php echo $facebook; ?>" target="_blank">
												<img src="<?php echo get_stylesheet_directory_uri() ?>/static/images/facebook.png" class="img-fluid">
											</a>
										</li><?php
									}
									if ( $twitter ) { ?>
										<li>
											<a href="<?php echo $twitter; ?>" target="_blank">
												<img src="<?php echo get_stylesheet_directory_uri() ?>/static/images/twitter.png" class="img-fluid">
											</a>
										</li><?php
									}

									if ( $youtube ) { ?>
										<li>
											<a href="<?php echo $youtube; ?>" target="_blank">
												<img src="<?php echo get_stylesheet_directory_uri() ?>/static/images/youtube.png" class="img-fluid">
											</a>
										</li><?php
									} 
								} ?>
							</ul>
						</div><?php
					} ?>
				</div>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>