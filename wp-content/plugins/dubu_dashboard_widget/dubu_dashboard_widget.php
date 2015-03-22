<?php
/*
Plugin Name: Dubu Dashboard Widget
Plugin URI:
Description: Create custom dashboard widgets
Version: 1.0
Author: DubuKiller
Author URI: http://wordplus.yoopd.com
License: GPL2
*/

require_once( plugin_dir_path( __FILE__ ) . '/custom_widgets.php' );

class Dubu_Dashboard_Widget {
 
    function __construct() {

        add_action( 'wp_dashboard_setup', array( $this, 'remove_dashboard_widgets' ) );
        add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widgets' ) );

    }
 
    function remove_dashboard_widgets() {
 
	    global $remove_defaults_widgets;
	 
	    foreach ( $remove_defaults_widgets as $widget_id => $options ) {
	        remove_meta_box( $widget_id, $options['page'], $options['context'] );
	    }

    }
 
    function add_dashboard_widgets() {
 
	    global $custom_dashboard_widgets;
	 
	    foreach ( $custom_dashboard_widgets as $widget_id => $options ) {
	        wp_add_dashboard_widget(
	            $widget_id,
	            $options['title'],
	            $options['callback']
	        );
	    }

    }
 
}
 
$wdw = new Dubu_Dashboard_Widget();













?>