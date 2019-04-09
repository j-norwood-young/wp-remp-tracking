<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    remp_tracking
 * @subpackage remp_tracking/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    remp_tracking
 * @subpackage remp_tracking/public
 * @author     Jason Norwood-Young <jason@10layer.com>
 */
class remp_tracking_Public {

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
	 * @param      string    $remp_tracking       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $remp_tracking, $version ) {

		$this->remp_tracking = $remp_tracking;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->remp_tracking, plugin_dir_url( __FILE__ ) . 'css/remp-tracking-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		$remp_tracking_beam_url = get_settings("remp_tracking_beam_url");
		$remp_tracking_remplib_url = get_settings("remp_tracking_remplib_url");
		$remp_tracking_cookie_domain = get_settings("remp_tracking_cookie_domain");
		?>
		<script>
			var remp_tracking_beam_url = "<?= $remp_tracking_beam_url ?>";
			var remp_tracking_remplib_url = "<?= $remp_tracking_remplib_url ?>";
			var remp_tracking_cookie_domain = "<?= $remp_tracking_cookie_domain ?>";
		</script>
		<?php
		wp_enqueue_script( $this->remp_tracking, plugin_dir_url( __FILE__ ) . 'js/remp-tracking-public.js', array( 'jquery' ), $this->version, false );

	}

}