<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/remp2020/remp
 * @since             1.0.0
 * @package           remp_tracking
 *
 * @wordpress-plugin
 * Plugin Name:       REMP Tracking
 * Plugin URI:        https://github.com/remp2020/remp
 * Description:       Add tracking codes to your WordPress installation to integrate with REMP
 * Version:           1.2.0
 * Author:            Jason Norwood-Young
 * Author URI:        https://10layer.com.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       remp-tracking
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'REMP_TRACKING_VERSION', '1.2.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-remp-tracking-activator.php
 */
function activate_remp_tracking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-remp-tracking-activator.php';
	remp_tracking_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-remp-tracking-deactivator.php
 */
function deactivate_remp_tracking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-remp-tracking-deactivator.php';
	remp_tracking_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_remp_tracking' );
register_deactivation_hook( __FILE__, 'deactivate_remp_tracking' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-remp-tracking.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_remp_tracking() {

	$plugin = new remp_tracking();
	$plugin->run();

}
run_remp_tracking();
