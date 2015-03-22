<?php
// apply stylesheet from parent theme following on http://codex.wordpress.org/Child_Themes
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

// add wordplus news to dashboard for administrator
function my_dashboard_widgets() {

     global $wp_meta_boxes;  

     unset(  
          $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],  
          $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
          $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']    
          // $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']  
     );  
     // add a custom dashboard widget
     add_meta_box( 'wordplus_widget', '::: 워드플러스 대쉬보드 뉴스 :::', 'dashboard_custom_feed_output', 'dashboard', 'side', 'high' );

}  

function dashboard_custom_feed_output() {  

     echo '<div class="rss-widget">';  
     wp_widget_rss_output(array(  
          'url' => 'http://wordplus.yoopd.com/category/dashboard_news/feed/',  //put your feed URL here  
          'title' => '워드플러스 뉴스',  
          'items' => 5, //how many posts to show  
          'show_summary' => 1,  
          'show_author' => 0,  
          'show_date' => 1  
     ));
     echo "</div>";  

} 

add_action ( 'wp_dashboard_setup', 'my_dashboard_widgets' );

// load korean language font.
function load_fonts() {

	wp_enqueue_style( 'jejugothic', 'http://fonts.googleapis.com/earlyaccess/jejugothic.css', array(), null );

}

add_action( 'wp_enqueue_scripts', 'load_fonts', PHP_INT_MAX);














function dubu_add_page() {

	$dubu_pages = array (

		array(
		  'post_author' 	=> 0,
		  'post_content' 	=> 'product page from code',
		  'post_name' 		=> 'PRODUCT',
		  'post_status' 	=> 'publish',
		  'post_title' 	    => 'PRODUCT',
		  'post_type' 		=> 'page',
		  'post_parent'		=> 0,
		  'menu_order' 		=> 0,
		  'to_ping' 		=> '',
		  'pinged' 			=> '',
		),
		array(
		  'post_author' 	=> 0,
		  'post_content' 	=> 'contact page from code',
		  'post_name' 		=> 'CONTACT',
		  'post_status' 	=> 'publish',
		  'post_title' 	    => 'CONTACT',
		  'post_type' 		=> 'page',
		  'post_parent'		=> 0,
		  'menu_order' 		=> 0,
		  'to_ping' 		=> '',
		  'pinged' 			=> '',
		),
		array(
		  'post_author' 	=> 0,
		  'post_content' 	=> 'aboutus page from code',
		  'post_name' 		=> 'ABOUTUS',
		  'post_status' 	=> 'publish',
		  'post_title' 	    => 'ABOUTUS',
		  'post_type' 		=> 'page',
		  'post_parent'		=> 0,
		  'menu_order' 		=> 0,
		  'to_ping' 		=> '',
		  'pinged' 			=> '',
		),
		
	);

	// 전면 포스트 출력용 페이지 입력
	// foreach ($dubu_pages as $dubu_page) {
	// 	wp_insert_post( $dubu_page );
	// }
	




	$mymenu = wp_get_nav_menu_object('main_menu');
	$menuID = (int) $mymenu->term_id;
	
	$dubu_input_page = array();

	$dubu_input_page[] = get_page_by_title('PRODUCT');
	$dubu_input_page[] = get_page_by_title('CONTACT');
	$dubu_input_page[] = get_page_by_title('ABOUTUS');
	 
	// echo "<pre>";
	// print_r($dubu_input_page[0]);
	// echo "</pre><br>";

	$dubu_page_items = array (
		array(
		    'menu-item-object-id' => $dubu_input_page[0]->ID,
		    'menu-item-parent-id' => 0,
		    'menu-item-position'  => 2,
		    'menu-item-object' => 'page',
		    'menu-item-type'      => 'post_type',
		    'menu-item-status'    => 'publish'
		),
		array(
		    'menu-item-object-id' => $dubu_input_page[1]->ID,
		    'menu-item-parent-id' => 0,
		    'menu-item-position'  => 6,
		    'menu-item-object' => 'page',
		    'menu-item-type'      => 'post_type',
		    'menu-item-status'    => 'publish'
		),
		array(
		    'menu-item-object-id' => $dubu_input_page[2]->ID,
		    'menu-item-parent-id' => 0,
		    'menu-item-position'  => 7,
		    'menu-item-object' => 'page',
		    'menu-item-type'      => 'post_type',
		    'menu-item-status'    => 'publish'
		),
	);

	// echo "<pre>";
	// print_r($itemDatas[0]);
	// echo "</pre>";

	// foreach ($dubu_page_items as $dubu_page_item) {

	// 	wp_update_nav_menu_item($menuID, 0, $dubu_page_item);

	// }

	// update_option( 'widget_search', array ( 2 => array ( 'title' => '' ), '_multiwidget' => 1 ) );

	// $widget_array = get_option('widget_search');
	// print_r($widget_array);

  //   add_option( 'widget_categories',
		// array( 'title' => 'My Categories' ));

  //  	add_option("sidebars_widgets",
		// array("sidebar-1" => array("tag_cloud"),
		// 	 "sidebar-2" => array("pages", "categories", "links")));


	// $add_to_sidebar 	= 'sidebar';
 //    $widget_name 		= 'search';
 //    $sidebar_options 	= get_option('sidebars_widgets');

 //    if(!isset($sidebar_options[$add_to_sidebar])){
 //        $sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
 //    }

 //    $homepagewidget = get_option('widget_'.$widget_name);

    // echo "<pre>";
    // print_r($sidebar_options);
    // echo "</pre>";

 //    if(!is_array($homepagewidget))$homepagewidget = array();
 //    $count = max(array_keys($homepagewidget)) + 1;

 //    $sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
 //    $homepagewidget[$count] = array(
 //        'title' 		=> '검색',
 //    );

 //    $count++;

 //    update_option('sidebars_widgets',$sidebar_options);
 //    update_option('widget_'.$widget_name,$homepagewidget);




}

add_action( 'init', 'dubu_add_page' );














function add_post_auto() {

	// $cat_01 = array('description' => "FREEBOARD7", 	'parent' => "cat_ID", 'slug' => 'freeboard7');
	// $new_cat_id_00 = wp_insert_term("FREEBOARD7", 		"category", $cat_01);
	
	// print_r($new_cat_id_00);
	// echo "<br>" . $new_cat_id_00['term_id'] . "<==";

	// $target_category = get_term_by( 'name', 'notice', 'post' );
	// print_r($target_category);

	// $cat_ID = get_cat_ID( 'FREEBOARD7' );

	$term   = get_term_by('name','NEWS','category');
	$term_id = $term->term_id;
	// echo $cat_ID . "<===<br>";

	// echo $target_category->term_id . "<=====";

	$first_post = array(
	  'post_title'    	=> '공지사항입니다6.',
	  'post_content'  	=> '이것은 첫번째 공지사항입니다6. 감사합니다!!',
	  'post_status'   	=> 'publish',
	  'post_author'   	=> 0,
	  'tax_input' 		=> array( 'category' => $term_id )	// notice
	  // 'post_category' 	=> array($new_cat_id_00)	
	);

	// 포스트 입력
	$post_id = wp_insert_post( $first_post );

///////////////////

	// $add_to_sidebar 	= 'jumbo-headline';
 //    $widget_name 		= 'text';
 //    $sidebar_options 	= get_option('sidebars_widgets');

 //    if(!isset($sidebar_options[$add_to_sidebar])){
 //        $sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
 //    }

 //    $homepagewidget = get_option('widget_'.$widget_name);

 //    if(!is_array($homepagewidget))$homepagewidget = array();
 //    $count = max(array_keys($homepagewidget)) + 1;

 //    $sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
 //    $homepagewidget[$count] = array(
 //        'title' 		=> '워드플러스 점보 헤드라인',
 //        'text' 			=> '나라말이 중국과 달라, 한문・한자와 서로 통하지 아니하므로, 어리석은 백성들이 말하고자 하는 바가 있어도, 끝내 제 뜻을 펴지 못하는 사람이 많다. 내가 이를 불쌍히 여겨, 새로 스물 여덟 글자를 만드니, 사람마다 하여금 쉽게 익혀, 날마다 씀에 편하게 하고자 할 따름이다.',
 //        'filter'		=> '1'
 //    );

 //    $count++;

 //    update_option('sidebars_widgets',$sidebar_options);
 //    update_option('widget_'.$widget_name,$homepagewidget);    

	// Add Featured Image to Post
	$image_url  = 'http://wordplus.yoopd.com/Hunmin_jeong-eum.jpg'; // Define the image URL here
	$upload_dir = wp_upload_dir(); // Set upload folder
	$image_data = file_get_contents($image_url); // Get image data
	$filename   = basename($image_url); // Create image file name

	// Check folder permission and define file location
	if( wp_mkdir_p( $upload_dir['path'] ) ) {
	    $file = $upload_dir['path'] . '/' . $filename;
	} else {
	    $file = $upload_dir['basedir'] . '/' . $filename;
	}

	// Create the image  file on the server
	file_put_contents( $file, $image_data );

	// Check image file type
	$wp_filetype = wp_check_filetype( $filename, null );

	// Set attachment data
	$attachment = array(
	    'post_mime_type' => $wp_filetype['type'],
	    'post_title'     => sanitize_file_name( $filename ),
	    'post_content'   => '',
	    'post_status'    => 'inherit'
	);

	// Create the attachment
	$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

	// Include image.php
	require_once(ABSPATH . 'wp-admin/includes/image.php');

	// Define attachment metadata
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

	// Assign metadata to attachment
	wp_update_attachment_metadata( $attach_id, $attach_data );

	// And finally assign featured image to post
	set_post_thumbnail( $post_id, $attach_id );



}

// add_action ( 'init', 'add_post_auto' );



// $result = activate_plugin( 'plugins/backupwordpress.php' );
// if ( is_wp_error( $result ) ) {
// 	echo "error!!";
// }

// 























?>