<?php
if (!defined('SPINAL_VERSION')) {
	define( 'SPINAL_VERSION', '1.0.7' );
}

function spinalelements_enque_scripts()
{
	
	wp_enqueue_style('responsive-style', get_template_directory_uri() . '/static/css/responsive.css', [], null);
	wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/static/css/bootstrap.min.css', [], null);
	wp_enqueue_style('animate-style', get_template_directory_uri() . '/static/css/animate.min.css', [], null);
	wp_enqueue_style('main-style', get_template_directory_uri() . '/static/css/main.css', [], null);

	// Register scripts.
	//wp_enqueue_script('jquery-script', get_template_directory_uri() . '/js/jquery.min.js', [], true);
	wp_enqueue_script('popper-script', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', [], true);
	wp_enqueue_script('bootstrap-bundel-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js', [], true);
	
	wp_enqueue_script('wow_script',  get_template_directory_uri() . '/js/wow.min.js', [], true);
	wp_register_script('ajax_script', get_template_directory_uri() . '/js/custom.js', ['jquery'], null, true);
	
	wp_localize_script( 'ajax_script', 'ajax_call', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ) );
	 wp_enqueue_script( 'ajax_script' );
}

add_action('wp_enqueue_scripts', 'spinalelements_enque_scripts');

/**
 * Preload styles and scripts.
 */
function spinalelements_preload_scripts()
{
	?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
	<?php
}
add_action('wp_head', 'spinalelements_preload_scripts', 1);