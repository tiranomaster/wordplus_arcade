<?PHP
error_reporting(E_ALL);
/*
Plugin Name: Dubu Power
Plugin URI: http://dev.yoopd.com
Description: Dubu Widget for test
Author: DubuKiller
Author URI: http://dev.yoopd.com
Version: 1.0.1
*/

function change_theme() {

	// update_option('current_theme', 'arcade-basic-child');
	// update_option('template', 'arcade-basic');
	// update_option('stylesheet', 'arcade-basic-child');

	// $themes = get_themes();
	// echo "<pre>";
	// echo print_r($themes);
	// echo "<pre>";

	// activate_plugin( dirname( dirname( __FILE__ ) ) . 
	// '/wp-content/plugins/backupwordpress/backupwordpress.php' );

	// // Define the new plugin you want to activate
	// $plugin_path = WP_CONTENT_DIR . '/plugins/backupwordpress/backupwordpress.php';
	// // Get already-active plugins   
	// $active_plugins = get_option('active_plugins');
	// // Make sure your plugin isn't active

	// if (isset($active_plugins[$plugin_path]))
	//     return;

	// // Include the plugin.php file so you have access to the activate_plugin() function
	// require_once(ABSPATH .'/wp-admin/includes/plugin.php');
	// // Activate your plugin
	// activate_plugin($plugin_path);


	// Include the plugin.php file so you have access to the activate_plugin() function
	require_once(ABSPATH .'/wp-admin/includes/plugin.php');

	// 활성화 대상 플러그인
	$plugin_array = array (
		"backupwordpress/backupwordpress.php",
		"statpress/statpress.php",
		"wp-google-fonts/google-fonts.php",
		"wordpress-importer/wordpress-importer.php"
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

}

//add_action ( 'init', 'change_theme' );

function change_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();
}
add_action('init', 'change_permalinks');














?>