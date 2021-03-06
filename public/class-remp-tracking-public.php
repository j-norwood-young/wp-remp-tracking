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
		wp_enqueue_style( $this->remp_tracking, plugin_dir_url( __FILE__ ) . 'css/remp-tracking-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		$remp_tracking_enabled = get_option("remp_tracking_enabled");
		if (!$remp_tracking_enabled) return; // Bailing!
		$remp_post_id = get_the_ID();
		$remp_tracking_timespan_enabled = get_option("remp_tracking_timespan_enabled");
		$remp_tracking_readingprogress_enabled = get_option("remp_tracking_readingprogress_enabled");
		$remp_tracking_beam_url = get_option("remp_tracking_beam_url");
		$remp_campaign_url = get_option("remp_campaign_url");
		$remp_cookie_domain = get_option("remp_cookie_domain");
		$remp_tracking_tracking_url = get_option("remp_tracking_tracking_url");
		$remp_tracking_property_token = get_option("remp_tracking_property_token");
		$remp_post_title = esc_html( get_the_title() );
		$remp_post_author = get_the_author_meta("display_name", get_post($remp_post_id)->post_author);
		$remp_tags = array_map(function($i) { return $i->name; }, get_the_terms($remp_post_id, "article_tag"));
		$remp_sections = array_map(function($i) { return $i->name; }, get_the_terms($remp_post_id, "section"));
		$user_id = get_current_user_id();
		wp_enqueue_script( "remp_script", plugin_dir_url( __FILE__ ) . 'js/remp-tracking-public.js', array( 'jquery' ), $this->version );
		wp_localize_script( "remp_script", "remp_vars", array(
			"remp_tracking_beam_url" => $remp_tracking_beam_url,
			"remp_campaign_url" => $remp_campaign_url,
			"remp_cookie_domain" => $remp_cookie_domain,
			"remp_tracking_tracking_url" => $remp_tracking_tracking_url,
			"remp_tracking_property_token" => $remp_tracking_property_token,
			"remp_post_title" => $remp_post_title,
			"remp_post_author" => $remp_post_author,
			"remp_post_id" => $remp_post_id,
			"remp_tracking_timespan_enabled" => $remp_tracking_timespan_enabled,
			"remp_tracking_readingprogress_enabled" => $remp_tracking_readingprogress_enabled,
			"user_id" => ($user_id === 0) ? false : $user_id,
			"remp_is_front_page" => is_front_page(),
			"remp_tags" => $remp_tags,
			"remp_sections" => $remp_sections,
		));
	}

}
