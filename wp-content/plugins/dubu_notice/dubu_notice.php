<?PHP
error_reporting(E_ALL);
/*
Plugin Name: Dubu Notice 
Plugin URI: http://dev.yoopd.com
Description: Dubu Widget for test
Author: DubuKiller
Author URI: http://dev.yoopd.com
Version: 1.0.1
*/

class Dubu_Notice {

	public function __construct() {

		$this->register_dubu_post_type();
		$this->add_dubu_meta_boxes();

	}

	/**
	* Registers a new post type
	* @uses $wp_post_types Inserts new post type object into the list
	*
	* @param string  Post type key, must not exceed 20 characters
	* @param array|string  See optional args description above.
	* @return object|WP_Error the registered post type object, or an error object
	*/
	function register_dubu_post_type() {

		$labels = array(
			'name'               => _x( 'Dubu Notice', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Notice', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Notice', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Notice', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'notice', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Notice', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Notice', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Notice', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Notice', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Notices', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Notices', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Notices:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No Notices found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No Notices found in Trash.', 'your-plugin-textdomain' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'notice' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( 'dubu_notice', $args );

	}

	public function add_dubu_meta_boxes() {

		add_action('add_meta_boxes',function(){

			add_meta_box( 'dubu_notice_top_priority', 'Top Position', 'notice_top_position', 'dubu_notice' );

		});

		function notice_top_position($post) {

			$dubu_notice_top_priority = get_post_meta( $post->ID, 'dubu_notice_top_priority', true );
?>
			<p>
				<label for="dubu_notice_top_priority">Top Position : </label>
				<input type="checkbox" class="widefat" name="dubu_notice_top_priority" id="dubu_notice_top_priority" value="1<?PHP //echo esc_attr($dubu_notice_top_priority); ?>" checked="checked" />
			</p>
<?PHP
				
		}

		add_action('save_post', function($id){
			if ( isset($_POST['dubu_notice_top_priority']) ) {
				update_post_meta(
					$id, 
					'dubu_notice_top_priority',
					strip_tags($_POST['dubu_notice_top_priority'])
				);
			}
		});

	}



}


add_action('init', function(){

	// new Dubu_Notice();

});


?>