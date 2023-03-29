<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sonam.wisdmlabs.net
 * @since      1.0.0
 *
 * @package    Content_Calender
 * @subpackage Content_Calender/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Content_Calender
 * @subpackage Content_Calender/admin
 * @author     Sonam Divyanshi <sonam.divyanshi@wisdmlabs.com>
 */
class Content_Calender_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Content_Calender_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Content_Calender_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/content-calender-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Content_Calender_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Content_Calender_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/content-calender-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_my_content_calender()
	{
		add_menu_page(
			__('My Content Calender'),
			'Content Calender',
			'manage_options',
			'content-calender',
			array($this, 'my_content_calender'),
			'dashicons-calendar-alt',
			10
		);
	}

	public function my_content_calender()
	{
		my_form();
		display_table();
	}

	//To save data after submit button clicked
	public function form_data()
	{
		if (isset($_POST['submit'])) {
			save_data();
		}
	}

	function save_data()
	{
		$options = get_option('my_plugin_options', array());
		if (!empty($options)) {
			$options = maybe_unserialize($options);
		}

		$new_options = array(
			'date' => $_POST['date'],
			'occasion' => $_POST['occasion'],
			'post_title' => $_POST['post-title'],
			'author' => $_POST['author'],
			'reviewer' => $_POST['reviewer'],
		);

		// Check if the same date and occasion already exist in the options table
		foreach ($options as $option) {
			if ($option['date'] === $_POST['date'] && $option['occasion'] === $_POST['occasion']) {
				echo "<script>alert('On this date,same event already exists.');</script>";
				return;
			}
		}

		// Adding data into array
		$options[] = $new_options;
		$serialized_options = maybe_serialize($options);
		update_option('my_plugin_options', $serialized_options);
	}


}
