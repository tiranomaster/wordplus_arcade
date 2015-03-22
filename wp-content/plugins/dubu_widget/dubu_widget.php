<?PHP
error_reporting(E_ALL);
/*
Plugin Name: Dubu Widget
Plugin URI: http://dev.yoopd.com
Description: Dubu Widget for test
Author: DubuKiller
Author URI: http://dev.yoopd.com
Version: 1.0.1
*/

class dubu_Widget extends WP_Widget {

	function __construct() {

		$params = array (
			'description'	=> 'Display Dubu Widget Area',
			'name'			=> 'Dubu Widget'
		);

		parent::__construct('dubu_Widget', '', $params);

	}

	public function form($instance) {

		// print_r($instance);
		extract($instance);
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title')?>">Title : </label>
			<input 
				type="text"
				class="widefat"
				id="<?php echo $this->get_field_id('title'); ?>"
				name="<?php echo $this->get_field_name('title'); ?>"
				value="<?php if (isset($title)) echo esc_attr($title); ?>"
			/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>">Description : </label>
			<textarea
				class="widefat"
				rows="5"
				id="<?php echo $this->get_field_id('description'); ?>"
				name="<?php echo $this->get_field_name('description'); ?>" ><?php if (isset($description)) echo esc_attr($description); ?></textarea> 
		</p>

		<?php


	}

	public function widget($args, $instance) {

		// echo "<pre>";
		// print_r($args);
		// echo "</pre>";

		extract($args);
		extract($instance);

		if ( empty($title) ) $title = "Imsi title Name";

		$title = apply_filters('widget_title', $title );
		$description = apply_filters('widget_description', $description);

		echo $before_widget;
			echo $before_title . $title . $after_title . "<hr>";
			echo "<p>" . $description . "</p>";
		echo $after_widget;


	}
}

add_action('widgets_init', 'register_dubu_widget' );

function register_dubu_widget() {

	register_widget('dubu_Widget');

}













?>