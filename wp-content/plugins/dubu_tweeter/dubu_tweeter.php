<?PHP
error_reporting(E_ALL);
/*
Plugin Name: Dubu Tweeter
Plugin URI: http://dev.yoopd.com
Description: Dubu Widget for test
Author: DubuKiller
Author URI: http://dev.yoopd.com
Version: 1.0.1
*/

class dubu_Tweeter extends WP_Widget {

	function __construct() {

		$params = array (
			'description'	=> 'Display Dubu Tweeter Area',
			'name'			=> 'Dubu Tweeter'
		);

		parent::__construct('dubu_Tweeter', '', $params);

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
			<label for="<?php echo $this->get_field_id('username')?>">Username : </label>
			<input 
				type="text"
				class="widefat"
				id="<?php echo $this->get_field_id('username'); ?>"
				name="<?php echo $this->get_field_name('username'); ?>"
				value="<?php if (isset($username)) echo esc_attr($username); ?>"
			/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('tweetcount')?>">Tweet Count : </label>
			<input 
				type="number"
				class="widefat"
				min=1
				max=9
				style="width: 40px;"
				id="<?php echo $this->get_field_id('tweetcount'); ?>"
				name="<?php echo $this->get_field_name('tweetcount'); ?>"
				value="<?php echo !empty($tweetcount) ? $tweetcount : 5; ?>"
			/>
		</p>

		<?php

	}

	public function widget($args, $instance) {

		// echo "<pre>";
		// print_r($args);
		// echo "</pre>";

		extract($args);
		extract($instance);

		if ( empty($title) ) $title = "Dubu Tweeter";

		// $title = apply_filters('widget_title', $title );
		// $description = apply_filters('widget_description', $description);

		// echo $before_widget;
		// 	echo $before_title . $title . $after_title . "<hr>";
		// 	echo "<p>" . $description . "</p>";
		// echo $after_widget;

		$this->show_tweet($tweetcount, $username);

	}

	private function show_tweet($tweetcount, $username) {

		if ( empty($username) ) {

			echo "no username";
			return false;

		} else {

			$this->fetch_tweet($tweetcount, $username);

		}

	}

	private function fetch_tweet($tweetcount, $username) {

		// $tweets = wp_remote_get( "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$username&count=$tweetcount" );
		// print_r($tweet);

	}

} // end class

add_action('widgets_init', 'register_dubu_tweeter' );

function register_dubu_tweeter() {

	register_widget('dubu_Tweeter');

}













?>