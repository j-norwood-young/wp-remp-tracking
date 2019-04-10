<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    remp_tracking
 * @subpackage remp_tracking/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    remp_tracking
 * @subpackage remp_tracking/admin
 * @author     Jason Norwood-Young <jason@10layer.com>
 */
class remp_tracking_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $remp_tracking    The ID of this plugin.
	 */
	private $remp_tracking;

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
	 * @param      string    $remp_tracking       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $remp_tracking, $version ) {

		$this->remp_tracking = $remp_tracking;
		$this->version = $version;
		$this->load_dependencies();
	}

	/**
	 * Load the required dependencies for the Admin facing functionality.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wppb_Demo_Plugin_Admin_Settings. Registers the admin settings and page.
	 *
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) .  'admin/class-remp-tracking-options.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) .  'admin/class-remp-beam-article-upsert.php';
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
		 * defined in remp_tracking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The remp_tracking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->remp_tracking, plugin_dir_url( __FILE__ ) . 'css/remp-tracking-admin.css', array(), $this->version, 'all' );

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
		 * defined in remp_tracking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The remp_tracking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->remp_tracking, plugin_dir_url( __FILE__ ) . 'js/remp-tracking-admin.js', array( 'jquery' ), $this->version, false );

	}

}
