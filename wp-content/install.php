
<?PHP  
/*
wp_install()
wp_install_defaults()
wp_new_blog_notification()
wp_upgrade()
*/

if ( !function_exists('wp_install_defaults') ) :
/**
 * {@internal Missing Short Description}}
 *
 * {@internal Missing Long Description}}
 *
 * @since 2.1.0
 *
 * @param int $user_id User ID.
 */

function wp_install_defaults( $user_id ) {

	global $wpdb, $wp_rewrite, $table_prefix;

	/*
	01. 카테고리 추가
	02. 테마 세팅
	03. 메인 네비 메뉴추가 & 주 네비로 설정 
	04. 주 네비에 카테고리 추가
	05. 기본 설정(시간,언어등)
	06. 기본 위젯 위치 세팅
	07. 포스트, 페이지 등록, 포스트용 특정이미지 추가
	08. 전면페이지 세팅 
	09. 전면페이지 위젯 세팅(arcade-basic-child 전용)
	10. 플러그인 설치/자동활성화
	11. 검색최적화를 위한 고유주소(permalink) 구조변경
	12. 대쉬보드 워드플러스 뉴스피드 등록
	*/

	// 1. 카테고리 추가 ------------------------------------------------------- 시작

	$cat_01 = array('description' => "기타 카테고리", 		'parent' => "cat_ID", 'slug' => 'etc');
	// $cat_01 = array('description' => "상품 카테고리", 		'parent' => "cat_ID", 'slug' => 'product');
	$cat_02 = array('description' => "뉴스 카테고리", 		'parent' => "cat_ID", 'slug' => 'news');
	$cat_03 = array('description' => "블로그 카테고리", 		'parent' => "cat_ID", 'slug' => 'blog');
	$cat_04 = array('description' => "공지사항 카테고리", 	'parent' => "cat_ID", 'slug' => 'notice');
	// $cat_05 = array('description' => "문의 카테고리", 		'parent' => "cat_ID", 'slug' => 'contact');
	// $cat_06 = array('description' => "회사소개 카테고리", 	'parent' => "cat_ID", 'slug' => 'aboutus');	

	$new_cat_id_01 = wp_insert_term("ETC", 		"category", $cat_00);
	// $new_cat_id_01 = wp_insert_term("PRODUCT", 	"category", $cat_01);
	$new_cat_id_02 = wp_insert_term("NEWS", 	"category", $cat_02);
	$new_cat_id_03 = wp_insert_term("BLOG", 	"category", $cat_03);
	$new_cat_id_04 = wp_insert_term("NOTICE", 	"category", $cat_04);
	// $new_cat_id_05 = wp_insert_term("CONTACT", 	"category", $cat_05);
	// $new_cat_id_06 = wp_insert_term("ABOUTUS", 	"category", $cat_06);

	// 1. 카테고리 추가 ------------------------------------------------------ 종료

	// 2. 테마 세팅 --------------------------------------------------------- 시작

	update_option( 'template', 		'arcade-basic' );
	update_option( 'stylesheet', 	'arcade-basic-child' );	// 차일드 테마

	// 2. 테마 세팅 --------------------------------------------------------- 종료

	// 3. 메인 네비 메뉴 추가 & 주메뉴로 설정 ------------------------------------- 시작

    $name 		= 'main_menu';
    $menu_id 	= wp_create_nav_menu($name);
    $menu 		= get_term_by( 'name', $name, 'nav_menu' );

    $locations 	= get_theme_mod('nav_menu_locations');
    $locations['primary'] = $menu->term_id;
    set_theme_mod( 'nav_menu_locations', $locations );

    // 3. 메인 네비 메뉴 추가 & 주메뉴로 설정 ------------------------------------- 종료

    // 4. 주 네비에 카테고리 추가 ----------------------------------------------- 시작

    // 홈 메뉴아이템 추가
    wp_update_nav_menu_item($menu->term_id, 0, array(
        'menu-item-title' 	=> 'HOME',
        'menu-item-url' 	=> get_bloginfo('url'),
        'menu-item-status' 	=> 'publish')
    );

    // 기타 카테고리를 제외한 카테고리 배열 설정
    $cat_args = array (
	    'hierarchical' 	=> 0,
	    'exclude' 		=> '1',
	    'exclude_tree' 	=> '1',
	    'hide_empty' 	=> 0,
	    'orderby'    	=> 'id',
    );

    $theCats = get_categories($cat_args);

    if (count($theCats) > 0){
        foreach($theCats as $category){
            wp_update_nav_menu_item($menu->term_id, 0, array(
                'menu-item-title' 		=> $category->name,
                'menu-item-object-id' 	=> $category->term_id,
                'menu-item-db-id' 		=> 0,
                'menu-item-object' 		=> 'category',
                'menu-item-parent-id' 	=> 0,
                'menu-item-type' 		=> 'taxonomy',
                'menu-item-url' 		=> get_category_link($category->term_id),
                'menu-item-status' 		=> 'publish')
            );
        }
    }

    // 4. 주 네비에 카테고리 추가 ----------------------------------------------- 종료

    // 5. 기본 세팅 --------------------------------------------------------- 시작

	update_option('timezone_string','Asia/Seoul');	
	update_option('blogname', 'WORDPLUS');
	update_option('blogdescription', '워드플러스에 오신 것을 환영합니다.');
	
	// 5. 기본 세팅 --------------------------------------------------------- 종료

	// 6. 기본 위젯 세팅 ----------------------------------------------------- 시작

	update_option( 'widget_search', array ( 2 => array ( 'title' => '검색' ), '_multiwidget' => 1 ) );
	update_option( 'widget_calendar', array ( 2 => array ( 'title' => '달력' ), '_multiwidget' => 1 ) );
	update_option( 'widget_tag_cloud', array ( 2 => array ( 'title' => '태그' ), '_multiwidget' => 1 ) );
	update_option( 'widget_meta', array ( 2 => array ( 'title' => '그밖의 기타' ), '_multiwidget' => 1 ) );
	update_option( 'sidebars_widgets', array ( 'wp_inactive_widgets' => array ( ), 'sidebar' => array ( 0 => 'search-2', 1 => 'calendar-2', 2 => 'tag_cloud-2', 3 => 'meta-2', ), 'sidebar-2' => array ( ), 'sidebar-3' => array ( ), 'array_version' => 3 ) );

	// 6. 기본 위젯 세팅 ----------------------------------------------------- 종료
	
	// 7. 포스트, 페이지 등록 -------------------------------------------------- 시작

	$term_news    = get_term_by('name','NEWS','category');
	$term_news_id = $term_news->term_id;

	$post_news_01 = array(
	  'post_title'    	=> '워드플러스가 오픈하였습니다.',
	  'post_content'  	=> '나라말이 중국과 달라, 한문・한자와 서로 통하지 아니하므로, 어리석은 백성들이 말하고자 하는 바가 있어도, 끝내 제 뜻을 펴지 못하는 사람이 많다. 내가 이를 불쌍히 여겨, 새로 스물 여덟 글자를 만드니, 사람마다 하여금 쉽게 익혀, 날마다 씀에 편하게 하고자 할 따름이다.',
	  'post_status'   	=> 'publish',
	  'post_author'   	=> $user_id,
	  'tax_input' 		=> array( 'category' => $term_news_id )	// news
	);

	// 포스트 입력
	$res_post_news_01 = wp_insert_post( $post_news_01 );

	$post_news_02 = array(
	  'post_title'    	=> '인터넷상에서는 최대한 예의를 지키도록 합시다.',
	  'post_content'  	=> '나라말이 중국과 달라, 한문・한자와 서로 통하지 아니하므로, 어리석은 백성들이 말하고자 하는 바가 있어도, 끝내 제 뜻을 펴지 못하는 사람이 많다. 내가 이를 불쌍히 여겨, 새로 스물 여덟 글자를 만드니, 사람마다 하여금 쉽게 익혀, 날마다 씀에 편하게 하고자 할 따름이다.',
	  'post_status'   	=> 'publish',
	  'post_author'   	=> $user_id,
	  'tax_input' 		=> array( 'category' => $term_news_id )	// news
	);

	// 포스트 입력
	$res_post_news_02 = wp_insert_post( $post_news_02 );

	$post_news_03 = array(
	  'post_title'    	=> '소중한 한글을 사랑합시다.',
	  'post_content'  	=> '나라말이 중국과 달라, 한문・한자와 서로 통하지 아니하므로, 어리석은 백성들이 말하고자 하는 바가 있어도, 끝내 제 뜻을 펴지 못하는 사람이 많다. 내가 이를 불쌍히 여겨, 새로 스물 여덟 글자를 만드니, 사람마다 하여금 쉽게 익혀, 날마다 씀에 편하게 하고자 할 따름이다.',
	  'post_status'   	=> 'publish',
	  'post_author'   	=> $user_id,
	  'tax_input' 		=> array( 'category' => $term_news_id )	// news
	);

	// 포스트 입력
	$res_post_news_03 = wp_insert_post( $post_news_03 );

	$post_news_04 = array(
	  'post_title'    	=> '소중한 사람과 항상 함께하기를 바랍니다.',
	  'post_content'  	=> '나라말이 중국과 달라, 한문・한자와 서로 통하지 아니하므로, 어리석은 백성들이 말하고자 하는 바가 있어도, 끝내 제 뜻을 펴지 못하는 사람이 많다. 내가 이를 불쌍히 여겨, 새로 스물 여덟 글자를 만드니, 사람마다 하여금 쉽게 익혀, 날마다 씀에 편하게 하고자 할 따름이다.',
	  'post_status'   	=> 'publish',
	  'post_author'   	=> $user_id,
	  'tax_input' 		=> array( 'category' => $term_news_id )	// news
	);

	// 포스트 입력
	$res_post_news_04 = wp_insert_post( $post_news_04 );

	$dubu_pages = array (

		array(
		  'post_author' 	=> $user_id,
		  'post_content' 	=> '상품정보 페이지',
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
		  'post_author' 	=> $user_id,
		  'post_content' 	=> '문의 페이지',
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
		  'post_author' 	=> $user_id,
		  'post_content' 	=> '회사소개 페이지',
		  'post_name' 		=> 'ABOUTUS',
		  'post_status' 	=> 'publish',
		  'post_title' 	    => 'ABOUTUS',
		  'post_type' 		=> 'page',
		  'post_parent'		=> 0,
		  'menu_order' 		=> 0,
		  'to_ping' 		=> '',
		  'pinged' 			=> '',
		),
		array(
		  'post_author' 	=> $user_id,
		  'post_content' 	=> '전면페이지(front-page) 출력용 페이지입니다.',
		  'post_name' 		=> 'WORDPLUS NEWS',
		  'post_status' 	=> 'publish',
		  'post_title' 	    => 'WORDPLUS NEWS',
		  'post_type' 		=> 'page',
		  'post_parent'		=> 0,
		  'menu_order' 		=> 0,
		  'to_ping' 		=> '',
		  'pinged' 			=> '',
		  'page_template'	=> 'page-templates/template-post-block.php'
		)
	);

	// PRODUCT, CONTACT, ABOUTUS, 전면출력 페이지 추가
	foreach ($dubu_pages as $dubu_page) {

		wp_insert_post( $dubu_page );

	}

	// 메인메뉴 페이지 추가
	$dubu_input_page = array();

	$dubu_input_page[] = get_page_by_title('PRODUCT');
	$dubu_input_page[] = get_page_by_title('CONTACT');
	$dubu_input_page[] = get_page_by_title('ABOUTUS');

	$dubu_page_items = array (

		array(
		    'menu-item-object-id' => $dubu_input_page[0]->ID,	// product
		    'menu-item-parent-id' => 0,
		    'menu-item-position'  => 2,
		    'menu-item-object' => 'page',
		    'menu-item-type'      => 'post_type',
		    'menu-item-status'    => 'publish'
		),
		array(
		    'menu-item-object-id' => $dubu_input_page[1]->ID,	// contact
		    'menu-item-parent-id' => 0,
		    'menu-item-position'  => 6,
		    'menu-item-object' => 'page',
		    'menu-item-type'      => 'post_type',
		    'menu-item-status'    => 'publish'
		),
		array(
		    'menu-item-object-id' => $dubu_input_page[2]->ID,	// aboutus
		    'menu-item-parent-id' => 0,
		    'menu-item-position'  => 7,
		    'menu-item-object' => 'page',
		    'menu-item-type'      => 'post_type',
		    'menu-item-status'    => 'publish'
		)

	);

	// 메인메뉴 3개 페이지 추가
	foreach ($dubu_page_items as $dubu_page_item) {

		wp_update_nav_menu_item($menu_id, 0, $dubu_page_item);

	}	

	// 특정 이미지 추가
	// $image_url  = 'http://wordplus.yoopd.com/Hunmin_jeong-eum.jpg'; // Define the image URL here
	$image_url  = 'http://upload.wikimedia.org/wikipedia/commons/1/1a/Bachalpseeflowers.jpg';
	$upload_dir = wp_upload_dir(); // Set upload folder
	$image_data = file_get_contents($image_url); // Get image data
	$filename   = basename($image_url); // Create image file name

	// 권한 확인
	if( wp_mkdir_p( $upload_dir['path'] ) ) {
	    $file = $upload_dir['path'] . '/' . $filename;
	} else {
	    $file = $upload_dir['basedir'] . '/' . $filename;
	}

	// 이미지 파일 생성
	file_put_contents( $file, $image_data );

	// 이미지 파일 형태 확인
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

	// 포스트에 연결
	set_post_thumbnail( $res_post_news_01, $attach_id );
	set_post_thumbnail( $res_post_news_02, $attach_id );
	set_post_thumbnail( $res_post_news_03, $attach_id );
	set_post_thumbnail( $res_post_news_04, $attach_id );

	// 7. 포스트, 페이지 등록 -------------------------------------------------- 종료

	// 8. 전면페이지 세팅    -------------------------------------------------- 시작

	$news_page = get_page_by_title( 'WORDPLUS NEWS' );
	update_option( 'page_on_front', $news_page->ID );
	update_option( 'show_on_front', 'page' );

	// 8. 전면페이지 세팅    -------------------------------------------------- 종료

	// 9. 전면페이지 위젯 세팅 ------------------------------------------------- 시작

	// ------------------- 점보 헤드라인 

	$add_to_sidebar 	= 'jumbo-headline';
    $widget_name 		= 'text';
    $sidebar_options 	= get_option('sidebars_widgets');

    if(!isset($sidebar_options[$add_to_sidebar])){
        $sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
    }

    $homepagewidget = get_option('widget_'.$widget_name);

    if(!is_array($homepagewidget))$homepagewidget = array();
    $count = max(array_keys($homepagewidget)) + 1;

    $sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
    $homepagewidget[$count] = array(
        'title' 		=> '워드플러스 점보 헤드라인',
        'text' 			=> '나라말이 중국과 달라, 한문・한자와 서로 통하지 아니하므로, 어리석은 백성들이 말하고자 하는 바가 있어도, 끝내 제 뜻을 펴지 못하는 사람이 많다. 내가 이를 불쌍히 여겨, 새로 스물 여덟 글자를 만드니, 사람마다 하여금 쉽게 익혀, 날마다 씀에 편하게 하고자 할 따름이다.',
        'filter'		=> '1'
    );

    $count++;

    update_option('sidebars_widgets',$sidebar_options);
    update_option('widget_'.$widget_name,$homepagewidget);

	// ------------------- 홈페이지 탑 영역

    $add_to_sidebar 	= 'home-page-top-area';
    $widget_name 		= 'bavotasan_custom_text_widget';
    $sidebar_options 	= get_option('sidebars_widgets');

    if(!isset($sidebar_options[$add_to_sidebar])){
        $sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
    }

    $homepagewidget = get_option('widget_'.$widget_name);

    if(!is_array($homepagewidget))$homepagewidget = array();
    $count = max(array_keys($homepagewidget)) + 1;

    $sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
    $homepagewidget[$count] = array(
        'title' 		=> 'PRODUCT',
        'icon' 			=> 'fa-archive',
        'url' 			=> '/',
        'button_color' 	=> 'danger',
        'text' 			=> '나라말이 중국과 달라, 한문・한자와 서로 통하지 아니하므로, 어리석은 백성들이 말하고자 하는 바가 있어도, 끝내 제 뜻을 펴지 못하는 사람이 많다. 내가 이를 불쌍히 여겨, 새로 스물 여덟 글자를 만드니, 사람마다 하여금 쉽게 익혀, 날마다 씀에 편하게 하고자 할 따름이다.',
        'button_text' 	=> '자세히 보기',
        'filter'		=> ''
    );

    $count++;

    $sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
   	$homepagewidget[$count] = array(
        'title' 		=> 'NEWS',
        'icon' 			=> 'fa-file-text-o',
        'url' 			=> '/',
        'button_color' 	=> 'primary',
        'text' 			=> '나라말이 중국과 달라, 한문・한자와 서로 통하지 아니하므로, 어리석은 백성들이 말하고자 하는 바가 있어도, 끝내 제 뜻을 펴지 못하는 사람이 많다. 내가 이를 불쌍히 여겨, 새로 스물 여덟 글자를 만드니, 사람마다 하여금 쉽게 익혀, 날마다 씀에 편하게 하고자 할 따름이다.',
        'button_text' 	=> '자세히 보기',
        'filter'		=> ''
    );

    $count++;    

    $sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
   	$homepagewidget[$count] = array(
        'title' 		=> 'BLOG',
        'icon' 			=> 'fa-user-plus',
        'url' 			=> '/',
        'button_color' 	=> 'info',
        'text' 			=> '나라말이 중국과 달라, 한문・한자와 서로 통하지 아니하므로, 어리석은 백성들이 말하고자 하는 바가 있어도, 끝내 제 뜻을 펴지 못하는 사람이 많다. 내가 이를 불쌍히 여겨, 새로 스물 여덟 글자를 만드니, 사람마다 하여금 쉽게 익혀, 날마다 씀에 편하게 하고자 할 따름이다.',
        'button_text' 	=> '자세히 보기',
        'filter'		=> ''
    );

    $count++; 

    $sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
   	$homepagewidget[$count] = array(
        'title' 		=> 'NOTICE',
        'icon' 			=> 'fa-envelope-o',
        'url' 			=> '/',
        'button_color' 	=> 'success',
        'text' 			=> '나라말이 중국과 달라, 한문・한자와 서로 통하지 아니하므로, 어리석은 백성들이 말하고자 하는 바가 있어도, 끝내 제 뜻을 펴지 못하는 사람이 많다. 내가 이를 불쌍히 여겨, 새로 스물 여덟 글자를 만드니, 사람마다 하여금 쉽게 익혀, 날마다 씀에 편하게 하고자 할 따름이다.',
        'button_text' 	=> '자세히 보기',
        'filter'		=> ''
    );

    update_option('sidebars_widgets',$sidebar_options);
    update_option('widget_'.$widget_name,$homepagewidget);	

	// 9. 전면페이지 위젯 세팅 ------------------------------------------------- 종료

	// 10. 플러그인 설치/실행 -------------------------------------------------- 시작
	// Include the plugin.php file so you have access to the activate_plugin() function
	require_once(ABSPATH .'/wp-admin/includes/plugin.php');

	// 활성화 대상 플러그인
	$plugin_array = array (
		"backupwordpress/backupwordpress.php",		// 백업 플러그인
		"statpress/statpress.php",					// 통계 플러그인 
//		"wp-google-fonts/google-fonts.php",			// 폰트 플러그인
		"wordpress-importer/wordpress-importer.php"	// 워드프레스 가져오기 도구
	);

	// 현재 활성화되어있는 플러그인 배열
	$active_plugins = get_option('active_plugins');

	foreach ($plugin_array as $plugin) {

		$tmp_plugin = WP_CONTENT_DIR . "/plugins/" . $plugin;

		if ( in_array($plugin, $active_plugins) ) {
	     	continue;
		} else {
			activate_plugin($tmp_plugin);	
		}

	}

	// 10. 플러그인 설치/실행 -------------------------------------------------- 종료

	// 11. 고유주소 구조 변경 -------------------------------------------------- 시작

    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();	

	// 11. 고유주소 구조 변경 -------------------------------------------------- 종료

} // end wp_install_defaults
endif;



















?>

