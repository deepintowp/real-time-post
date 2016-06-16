<?php
add_action( 'wp_enqueue_scripts', 'child_twty_sixtn_enqueue_styles' );
function child_twty_sixtn_enqueue_styles() {
    wp_enqueue_style( 'animate-css', get_stylesheet_directory_uri() . '/css/animate.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	
	wp_enqueue_script('auto_post', get_stylesheet_directory_uri().'/js/autoload.js', array('jquery')  );
	 wp_localize_script( 'auto_post', 'autopostload', array(
		'url'=> admin_url('admin-ajax.php')
	 
	 ) );

}

function post_atuto_publish(){
	
	// The Query
$the_query = new WP_Query( array(
	'post_type'=>'post',
	'post_status'=>'publish'

) );

// The Loop
if ( $the_query->have_posts() ) {
	
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$time_diff_in_sec = current_time( 'U' ) - get_the_time('U'); 
		$time_diff_in_mili_sec = $time_diff_in_sec  * 1000;
		if(  $time_diff_in_mili_sec <= 30000  && !is_page () && !is_single() ){
			
			get_template_part( 'template-parts/content', get_post_format() );
		}
	}
	
}
	
wp_reset_postdata();	
	die();
	
}
add_action('wp_ajax_autoload_action', 'post_atuto_publish');
add_action('wp_ajax_nopriv_autoload_action', 'post_atuto_publish');