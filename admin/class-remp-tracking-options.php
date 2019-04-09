<?php

/**
 * The options menu.
 *
 * Creates the menus we need
 *
 * @package    remp_tracking
 * @subpackage remp_tracking/admin
 * @author     Jason Norwood-Young <jason@10layer.com>
 */

class remp_tracking_Options {
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
    
    public function __construct( $remp_tracking, $version ) {
        $this->remp_tracking = $remp_tracking;
		$this->version = $version;
    }

    public function setup_plugin_options_menu() {
		//Add the menu to the Plugins set of menu items
		add_options_page(
			'REMP Tracking', 					// The title to be displayed in the browser window for this page.
			'REMP Tracking',					// The text to be displayed for this menu item
			'manage_options',					// Which type of users can see this menu item
			'remp_tracking_options',			// The unique ID - that is, the slug - for this menu item
			array( $this, 'render_remp_tracking_options')				// The name of the function to call when rendering this menu's page
		);
    }

    public function register_settings() {
        register_setting( 'remp-tracking-settings-group', 'remp_tracking_beam_url' );
        register_setting( 'remp-tracking-settings-group', 'remp_tracking_remplib_url' );
        register_setting( 'remp-tracking-settings-group', 'remp_tracking_cookie_domain' );
    }
    
    public function render_remp_tracking_options() {
		?>
		<!-- Create a header in the default WordPress 'wrap' container -->
		<div class="wrap">

			<h2><?php _e( 'REMP Tracking Options', 'remp-tracking' ); ?></h2>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
                <?php settings_fields( 'remp-tracking-settings-group' ); ?>
                <?php do_settings_sections( 'remp-tracking-settings-group' ); ?>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">BEAM Tracker URL</th>
                            <td>
                                <input style="width: 600px; height: 40px;" name="remp_tracking_beam_url" placeholder="http://tracker.beam.remp.press" id="remp_tracking_beam_url" type="url" value="<?php echo esc_attr( get_option('remp_tracking_beam_url') ); ?>">
                                <p class="description">The URL location of BEAM Tracker, eg. http://tracker.beam.remp.press.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Remplib.js URL</th>
                            <td>
                                <input style="width: 600px; height: 40px;" name="remp_tracking_remplib_url" placeholder="http://beam.remp.press/assets/lib/js/remplib.js" id="remp_tracking_remplib_url" type="url" value="<?php echo esc_attr( get_option('remp_tracking_remplib_url') ); ?>">
                                <p class="description">The URL to location of BEAM remplib.js, eg. http://beam.remp.press/assets/lib/js/remplib.js.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Cookie Domain</th>
                            <td>
                                <input style="width: 600px; height: 40px;" name="remp_tracking_cookie_domain" placeholder=".remp.press" id="remp_tracking_cookie_domain" type="text" value="<?php echo esc_attr( get_option('remp_tracking_cookie_domain') ); ?>">
                                <p class="description">Controls where cookies (UTM parameters of visit) are stored, eg. .remp.press.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?=	submit_button(); ?>
		    </form>
		</div><!-- /.wrap -->
	<?php
    }
    
    public function general_options_callback() {
		$options = get_option('wppb_demo_display_options');
		var_dump($options);
		echo '<p>' . __( 'Select which areas of content you wish to display.', 'wppb-demo-plugin' ) . '</p>';
	}
}