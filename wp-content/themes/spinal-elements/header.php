<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package spinalelements
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
		<?php if ( isset($_ENV['PANTHEON_ENVIRONMENT']) && 'live' !== $_ENV['PANTHEON_ENVIRONMENT'] ):
			$apiKey = ( 'test' !== $_ENV['PANTHEON_ENVIRONMENT'] ) ? 'bfybpo5lg4rvbs2dhrxc9w' : '8rzbkgpgp6pnu8z94gxzwaY';
			?>
		<script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=<?php echo $apiKey; ?>>" async="true"></script>
		<?php endif; ?>
		<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=62bdcb8d7b7c8200133c554b&product=sop' async='async'></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="<?php if(is_front_page()){ echo "home-page-header"; } else { echo "inner-page-header"; } ?> header-spinalelements">
	<div class="container">
		<nav class="navbar navbar-expand-xl py-0"><?php 
			$logo_white = get_field('logo_white', 'option');
			$logo_dark = get_field('logo_black', 'option');
			if($logo_white || $logo_dark)
		  	{ ?>
				<a class="navbar-brand me-0 p-0" href="<?php echo site_url(); ?>"><?php
				if($logo_white)
		  		{ ?>
				  	<img src="<?php echo $logo_white['url']; ?>" class="img-fluid logo-light" alt="<?php echo $logo_white['title']; ?>"><?php
				} 
				if($logo_dark)
				{ ?> 
				  	<img src="<?php echo $logo_dark['url']; ?>" class="img-fluid dark-logo" alt="<?php echo $logo_dark['title']; ?>"><?php
				} ?>
				</a><?php
			}
			 ?>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" >
				<span class="navbar-toggler-icon"></span>
				<span class="navbar-toggler-icon"></span>
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent"> <?php
				wp_nav_menu( array(
			        'menu' => 'Main Menu',
			        'theme_location' => 'primary',
			        'menu_class'  => 'navbar-nav align-items-center ms-auto',
			        'container' => 'ul',
			        'before'         => '',
					'after'          => '',
					'depth'          => 3,
					'link_before'    => '',
					'link_after'     => '',
			            
			   	) ); ?>
			</div>  
		</nav>
	</div>
</header><!-- #masthead -->
