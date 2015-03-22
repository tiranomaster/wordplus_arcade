<?PHP
error_reporting(E_ALL);
/*
Plugin Name: Dubu Tester
Plugin URI: http://dev.yoopd.com
Description: Dubu Filter for test
Author: DubuKiller
Author URI:  http://dev.yoopd.com
Version: 1.0.1
*/

add_filter( 'the_content', function($content) {


	$id = get_the_id();

	if ( !is_singular('post') ) {
		return $content;
	}

	// return $content . "<br> 입니다!!";

	$terms = get_the_terms( $id, 'category' );
	
	$cats = array();
	foreach ($terms as $term) {
		$cats[] = $term->cat_ID;
	}


	$loop = new WP_Query (
		array (
			'posts_per_page' => 3,
			'category__in' => $cats,
			// 'orderby' => 'rand', 
			'post__not_in' => array($id)
		)
	);

	if ( $loop->have_posts() ) {

		$content .= "<br><br><h2>You might also like ... </h2>";
		$content .= "<ul>";

		while ( $loop->have_posts() ) {
			$loop->the_post();
			$content .= "<li><a href='" . get_permalink() . "'>" . get_the_title() . "</a></li>";
		}

		$content .= "</ul>";

	}

	return $content;

	// echo "<pre>";
	// print_r($loop);	
	// echo "</pre>";	

} );
?>