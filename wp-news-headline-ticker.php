<?php
/*
Plugin Name: News Headline Ticker
Plugin URI: https://www.e2softsolution.com/news-headline-ticker/
Description: News Headline Ticker is best wordpress plugin to display breaking news in your website!  Use this shortcode <strong>[WPNHT-Ticker]</strong> in the post/page" where you want to display breaking news.
Version: 1.0.5
Author: Hasibul Islam Badsha
Author URI: https://www.e2softsolution.com/
Copyright: 2020
License URI: license.txt
Text Domain: wpnhtp
*/


#######################	News Headline Ticker ###############################

/**
	Register Admin Stylesheet and Javascript.
**/
function register_wpnhtp_admin_style()
{
	wp_enqueue_style( 'wpnhtp-admin', plugins_url('/css/wpnhtp-admin.css', __FILE__) );
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
	wp_enqueue_script( 'cp-active', plugins_url('/js/cp-active.js', __FILE__), array('jquery'), '', true );
}
add_action( 'admin_enqueue_scripts', 'register_wpnhtp_admin_style' ); 

/**
	Register Stylesheet and Javascript.
**/
function register_wpnhtp_style()
{
	wp_enqueue_script( 'wpnhtp-js', plugins_url('/js/wpnhtp.js', __FILE__), array('jquery') );
	wp_enqueue_style( 'wpnhtp-style', plugins_url('/css/wpnhtp.css', __FILE__) );
}
add_action('wp_enqueue_scripts', 'register_wpnhtp_style');

/**
	Get post for create breaking news.
**/
function wpnhtp_post_loop() 
{ ?>

<div class="wpnhtp_body">
<div class="label">
  <?php 
	  	$wpnhtp_label = get_option('wpnhtp_label'); 
	  	if(!empty($wpnhtp_label)) {echo $wpnhtp_label;} else {echo "Breaking News:";}
	  ?>
</div>
<ul class="<?php $wpnhtp_effect = get_option('wpnhtp_effect');
				 if(!empty($wpnhtp_effect)) {echo $wpnhtp_effect;} else {echo "typing";}?>">
<?php    
	/**
		Get post data.
	**/	
	$wpnhtp_post_category = get_option('wpnhtp_post_category');
	$wpnhtp_number_post = get_option('wpnhtp_number_post'); 
	$wpnhtp_order = get_option('wpnhtp_order');
	
	/**
		Post query.
	**/		
	$wpnhtp_args = array(
							'post_type' => 'post',
							'category_name' => $wpnhtp_post_category,
							'showposts' => $wpnhtp_number_post,
							'orderby' => 'date',
							'order' => $wpnhtp_order
						  );
	$wpnhtp_query = new WP_Query($wpnhtp_args);
	while ($wpnhtp_query->have_posts()) : $wpnhtp_query->the_post(); 
	?>
<li><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>">
  <?php the_title(); ?>
  </a></li>
<?php
	endwhile; 
	wp_reset_query();
	echo '</ul></div>';
}

/**
	Define breaking news style type.
**/
function wpnhtp_slide_script(){?>
<script>
jQuery(document).ready(function() {
    jQuery('.fade').inewsticker({
		speed       : 3000,
		effect      : 'fade',
		dir         : 'ltr',
		font_size   : 13,
		color       : '#fff',
		font_family : 'arial',
		delay_after : 1000		
	});
	jQuery('.slide').inewsticker({
		speed       : 2500,
		effect      : 'slide',
		dir         : 'ltr',
		font_size   : 13,
		color       : '#fff',
		font_family : 'arial',
		delay_after : 1000						
	});
	jQuery('.typing').inewsticker({
		speed           : 100,
		effect          : 'typing',
		dir             : 'ltr',
		font_size       : 13,
		color           : '#fff',
		font_family     : 'arial',
		delay_after : 1000,

				
	});
});	
</script>
<?php }
add_action('wp_footer', 'wpnhtp_slide_script');

/**
	Create breaking news loop.
**/
function wp_news_headline_ticker()
{
	return wpnhtp_post_loop();
}
add_shortcode('WPNHT-Ticker', 'wpnhtp_post_loop');

/**
	Get all php file.
**/
foreach ( glob( plugin_dir_path( __FILE__ )."lib/*.php" ) as $php_file )
    include_once $php_file;

/**
	Redirect to plugin settings page.
**/
register_activation_hook(__FILE__, 'wpnhtp_plugin_activate');
add_action('admin_init', 'wpnhtp_plugin_redirect');

function wpnhtp_plugin_activate() {
    add_option('wpnhtp_plugin_do_activation_redirect', true);
}

function wpnhtp_plugin_redirect() {
    if (get_option('wpnhtp_plugin_do_activation_redirect', false)) {
        delete_option('wpnhtp_plugin_do_activation_redirect');
        if(!isset($_GET['activate-multi']))
        {
            wp_redirect("options-general.php?page=wp-news-headline-ticker");
        }
    }
}