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
        register_setting( 'remp-tracking-settings-group', 'remp_tracking_crm_url' );
        register_setting( 'remp-tracking-settings-group', 'remp_tracking_enabled' );
        register_setting( 'remp-tracking-settings-group', 'remp_tracking_timespan_enabled' );
        register_setting( 'remp-tracking-settings-group', 'remp_tracking_readingprogress_enabled' );
        register_setting( 'remp-tracking-settings-group', 'remp_tracking_beam_url' );
        register_setting( 'remp-tracking-settings-group', 'remp_tracking_tracking_url' );
        register_setting( 'remp-tracking-settings-group', 'remp_post_types' );
        register_setting( 'remp-tracking-settings-group', 'remp_tracking_property_token' );
        register_setting( 'remp-tracking-settings-group', 'remp_campaign_url' );
        register_setting( 'remp-tracking-settings-group', 'remp_mailer_url' );
        register_setting( 'remp-tracking-settings-group', 'remp_cookie_domain' );
        register_setting( 'remp-tracking-settings-group', 'remp_api_key' );
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
                            <th scope="row">CRM URL</th>
                            <td>
                                <input style="width: 600px; height: 40px;" name="remp_tracking_crm_url" placeholder="http://crm.remp.press" id="remp_tracking_crm_url" type="url" value="<?php echo esc_attr( get_option('remp_tracking_crm_url') ); ?>">
                                <p class="description">The URL to location of CRM, eg. http://crm.remp.press.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Enable Tracking</th>
                            <td>
                                <label for="remp_tracking_enabled">
                                    <input name="remp_tracking_enabled" type="checkbox" id="remp_tracking_enabled" value="1" <?= (get_option("remp_tracking_enabled")) ? 'checked="checked"' : "" ?>>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Enable Time Spent Tracking</th>
                            <td>
                                <label for="remp_tracking_timespan_enabled">
                                    <input name="remp_tracking_timespan_enabled" type="checkbox" id="remp_tracking_timespan_enabled" value="1" <?= (get_option("remp_tracking_timespan_enabled")) ? 'checked="checked"' : "" ?>>
                                </label>
                                <p class="description">Warning: Generates multiple events per pageview</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Enable Reading Progress Tracking</th>
                            <td>
                                <label for="remp_tracking_readingprogress_enabled">
                                    <input name="remp_tracking_readingprogress_enabled" type="checkbox" id="remp_tracking_readingprogress_enabled" value="1" <?= (get_option("remp_tracking_readingprogress_enabled")) ? 'checked="checked"' : "" ?>>
                                </label>
                                <p class="description">Warning: Generates multiple events per pageview</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">BEAM URL</th>
                            <td>
                                <input style="width: 600px; height: 40px;" name="remp_tracking_beam_url" placeholder="http://beam.remp.press" id="remp_tracking_beam_url" type="url" value="<?php echo esc_attr( get_option('remp_tracking_beam_url') ); ?>">
                                <p class="description">The URL to location of BEAM, eg. http://beam.remp.press.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">BEAM Tracker URL</th>
                            <td>
                                <input style="width: 600px; height: 40px;" name="remp_tracking_tracking_url" placeholder="http://tracker.beam.remp.press" id="remp_tracking_tracking_url" type="url" value="<?php echo esc_attr( get_option('remp_tracking_tracking_url') ); ?>">
                                <p class="description">The URL location of BEAM Tracker, eg. http://tracker.beam.remp.press.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">BEAM Tracked Post Types</th>
                            <td>
                                <input style="width: 600px; height: 40px;" name="remp_post_types" placeholder="article,cartoon" id="remp_post_types" type="text" value="<?php echo esc_attr( get_option('remp_post_types') ); ?>">
                                <p class="description">Comma-seperated list of post types to send to BEAM, eg. "article,cartoon".</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">BEAM Property Token</th>
                            <td>
                                <input style="width: 600px; height: 40px;" name="remp_tracking_property_token" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxx" id="remp_tracking_property_token" type="text" value="<?php echo esc_attr( get_option('remp_tracking_property_token') ); ?>">
                                <p class="description">The property token for BEAM Tracker. You can get it in Beam admin - Properties.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Campaign URL</th>
                            <td>
                                <input style="width: 600px; height: 40px;" name="remp_campaign_url" placeholder="http://campaign.remp.press" id="remp_campaign_url" type="url" value="<?php echo esc_attr( get_option('remp_campaign_url') ); ?>">
                                <p class="description">The URL to location of Campaign, eg. http://campaign.remp.press.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Mailer URL</th>
                            <td>
                                <input style="width: 600px; height: 40px;" name="remp_mailer_url" placeholder="http://mailer.remp.press" id="remp_mailer_url" type="url" value="<?php echo esc_attr( get_option('remp_mailer_url') ); ?>">
                                <p class="description">The URL to location of Mailer, eg. http://mailer.remp.press.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Cookie Domain</th>
                            <td>
                                <input style="width: 600px; height: 40px;" name="remp_cookie_domain" placeholder=".remp.press" id="remp_cookie_domain" type="text" value="<?php echo esc_attr( get_option('remp_cookie_domain') ); ?>">
                                <p class="description">Controls where cookies (UTM parameters of visit) are stored, eg. .remp.press.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">API Key</th>
                            <td>
                                <input style="width: 600px; height: 40px;" name="remp_api_key" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxx" id="remp_api_key" type="password" value="<?php echo esc_attr( get_option('remp_api_key') ); ?>">
                                <p class="description">API key. Generate in SSO.</p>
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