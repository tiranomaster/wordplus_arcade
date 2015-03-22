<?PHP
/*
Plugin Name: Dubu Filter
Plugin URI: http://dev.yoopd.com
Description: Dubu Filter for test
Author: DubuKiller
Author URI:  http://dev.yoopd.com
Version: 1.0.1
*/

//add_filter( 'the_title', ucwords );

function dubu_set_primary_menu() {

	// global $wpdb, $wp_rewrite, $table_prefix;

	$cat_01 = array('description' => "상품 카테고리입니다.", 'parent' => "cat_ID", 'slug' => 'slug_product');
	$cat_02 = array('description' => "뉴스 카테고리입니다.", 'parent' => "cat_ID", 'slug' => 'slug_news');
	$cat_03 = array('description' => "블로그 카테고리입니다.", 'parent' => "cat_ID", 'slug' => 'slug_blog');
	$cat_04 = array('description' => "문의 카테고리입니다.", 'parent' => "cat_ID", 'slug' => 'slug_contact');
	$cat_05 = array('description' => "회사소개 카테고리입니다.", 'parent' => "cat_ID", 'slug' => 'slug_about');

	// $new_cat_id_01 = wp_insert_term("상품", "category", $cat_01);
	// $new_cat_id_02 = wp_insert_term("뉴스", "category", $cat_02);
	// $new_cat_id_03 = wp_insert_term("블로그", "category", $cat_03);
	// $new_cat_id_04 = wp_insert_term("문의", "category", $cat_04);
	// $new_cat_id_05 = wp_insert_term("회사소개", "category", $cat_05);


    //give your menu a name
    $name = 'main_menu';
    //create the menu
//	    $menu_id = wp_create_nav_menu($name);
    //then get the menu object by its name
    $menu = get_term_by( 'name', $name, 'nav_menu' );

    //then you set the wanted theme  location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary'] = $menu->term_id;
    set_theme_mod( 'nav_menu_locations', $locations );

    // 3. 메인메뉴 아이템 등록
    $cat_args = array (
	    'hierarchical' => 0,
	    'exclude' => '1',
	    'exclude_tree' => '1',
	    'hide_empty' => 0,
	    'orderby'    => 'id',
    );

    $theCats = get_categories($cat_args);

     // print_r($theCats);exit;

    // 3-2. 메뉴아이템 등
    // if (count($theCats) > 0){
    //     foreach($theCats as $category){
    //         wp_update_nav_menu_item($menu->term_id, 0, array(
    //             'menu-item-title' => $category->name,
    //             'menu-item-object-id' => $category->term_id,
    //             'menu-item-db-id' => 0,
    //             'menu-item-object' => 'category',
    //             'menu-item-parent-id' => 0,
    //             'menu-item-type' => 'taxonomy',
    //             'menu-item-url' => get_category_link($category->term_id),
    //             'menu-item-status' => 'publish')
    //         );
    //     }
    // }

	// update_option( 'widget_search', array ( 2 => array ( 'title' => '검색' ), '_multiwidget' => 1 ) );
	// update_option( 'widget_recent-posts', array ( 2 => array ( 'title' => '최근 글', 'number' => 5 ), '_multiwidget' => 1 ) );
	// update_option( 'widget_recent-comments', array ( 2 => array ( 'title' => '최근 댓글', 'number' => 5 ), '_multiwidget' => 1 ) );
	// update_option( 'widget_archives', array ( 2 => array ( 'title' => '저장소', 'count' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
	// update_option( 'widget_categories', array ( 2 => array ( 'title' => '카테고리', 'count' => 0, 'hierarchical' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
	// update_option( 'widget_meta', array ( 2 => array ( 'title' => '그밖의 기' ), '_multiwidget' => 1 ) );
	// update_option( 'sidebars_widgets', array ( 'wp_inactive_widgets' => array ( ), 'sidebar-1' => array ( 0 => 'search-2', 1 => 'recent-posts-2', 2 => 'recent-comments-2', 3 => 'archives-2', 4 => 'categories-2', 5 => 'meta-2', ), 'sidebar-2' => array ( ), 'sidebar-3' => array ( ), 'array_version' => 3 ) );

	// update_option( 'template', 'arcade-basic' );
	// update_option( 'stylesheet', 'arcade-basic' );

	// Create post object

	$user_id = get_current_user_id();

	$my_post = array(
	  'post_title'    => '첫번째 글',
	  'post_content'  => '이것을 첫번째 글입니다. 감사합니다!!',
	  'post_status'   => 'publish',
	  'post_author'   => $user_id,
	  // 'post_category' => array(8,39)
	);

	// Insert the post into the database
	// wp_insert_post( $my_post );

	$first_page = array(
	  'post_author' 	=> $user_id,
	  'post_content' 	=> '게시물 목록 페이지입니다. 감사합니다.',
	  'post_name' 		=> '게시물 목록 페이지',
	  'post_status' 	=> 'publish',
	  'post_title' 	    => '게시물 목록 페이지입니다. 감사합니다.',
	  'post_type' 		=> 'page',
	  'post_parent'		=> 0,
	  'menu_order' 		=> 0,
	  'to_ping' 		=> '',
	  'pinged' 			=> '',
	  'page_template'	=> 'page-templates/template-post-block.php'
	);

	// 페이지 입력
	// wp_insert_post( $first_page );

	// $templates = wp_get_theme()->get_page_templates();


	// foreach ( $templates as $template_name => $template_filename ) 
	// {
	//     echo "$template_name ($template_filename)<br />";
	// }

	// $args = array( 'meta_key' => '_wp_page_template');
 //    $templates = get_pages($args);
 //    foreach ( $templates as $template){
 //        $templateName = $template->meta_value;
 //        echo '==>' . $templateName . '</br>'; 

 //        // if( $templateName != 'default' && $templateName !='') include('inc/'. $templateName);
 //    } 


	// update_option('blogdescription', '워드플러스 입니다.');


	// Use a static front page
	// $news_page = get_page_by_title( 'NEWS' );
	// update_option( 'page_on_front', $news_page->ID );
	// update_option( 'show_on_front', 'page' );

	// $count = 8;

    $add_to_sidebar 	= 'home-page-top-area';
    $widget_name 		= 'bavotasan_custom_text_widget';
    $sidebar_options 	= get_option('sidebars_widgets');

    // echo "<pre>";
    // print_r($sidebar_options);
    // echo "</pre>";

    if(!isset($sidebar_options[$add_to_sidebar])){
        $sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
    }


    $homepagewidget = get_option('widget_'.$widget_name);
    // $homepagewidget = get_option($widget_name);

    // echo "<pre><h2>";
    // print_r($homepagewidget);
    // echo "</h2></pre>";

    if(!is_array($homepagewidget))$homepagewidget = array();
    $count = max(array_keys($homepagewidget)) + 1;

    // add first widget to sidebar:
    $sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;

    // echo "<pre><h2>";
    // print_r($sidebar_options);
    // echo "</h2></pre>";

    $homepagewidget[$count] = array(
        'title' 		=> 'COMPANY1',
        'icon' 			=> 'fa-hospital-o',
        'url' 			=> '/',
        'button_color' 	=> 'info',
        'text' 			=> 'GOOD COMPANY',
        'button_text' 	=> 'GOOD COMPANY',
        'filter'		=> ''
    );

    $count++;

    $sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
   	$homepagewidget[$count] = array(
        'title' 		=> 'COMPANY2',
        'icon' 			=> 'fa-hospital-o',
        'url' 			=> '/',
        'button_color' 	=> 'info',
        'text' 			=> 'GOOD COMPANY',
        'button_text' 	=> 'GOOD COMPANY',
        'filter'		=> ''
    );

    $count++;    

    $sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
   	$homepagewidget[$count] = array(
        'title' 		=> 'COMPANY3',
        'icon' 			=> 'fa-hospital-o',
        'url' 			=> '/',
        'button_color' 	=> 'info',
        'text' 			=> 'GOOD COMPANY',
        'button_text' 	=> 'GOOD COMPANY',
        'filter'		=> ''
    );

    $count++; 

    $sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
   	$homepagewidget[$count] = array(
        'title' 		=> 'COMPANY4',
        'icon' 			=> 'fa-hospital-o',
        'url' 			=> '/',
        'button_color' 	=> 'info',
        'text' 			=> 'GOOD COMPANY',
        'button_text' 	=> 'GOOD COMPANY',
        'filter'		=> ''
    );





    update_option('sidebars_widgets',$sidebar_options);
    update_option('widget_'.$widget_name,$homepagewidget);
    // update_option('dtbaker_done_installed_widgets',true);




}

// function change_theme() {

// 	update_option( 'template', 		'arcade-basic' );
// 	update_option( 'stylesheet', 	'arcade-basic' );

// }

add_action ( 'init', 'change_theme' );
?>