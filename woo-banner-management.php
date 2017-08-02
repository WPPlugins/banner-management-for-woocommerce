<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://multidots.com
 * @since             1.0.0
 * @package           Woo_Banner_Management
 *
 * @wordpress-plugin
 * Plugin Name:       Banner Management for WooCommerce
 * Plugin URI:        multidots.com
 * Description:       With this plugin, You can easily add banner in WooCommerce stores and you can upload the banner  specific for page,category  and welcome page.
 * Version:           1.0.8
 * Author:            Multidots
 * Author URI:        http://multidots.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-banner-management
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if (!defined('WooCommerce_Banner_Management_Url')) {
   define('WooCommerce_Banner_Management_Url', plugin_dir_url(__FILE__));
}
define('WBN_FREE_PLUGIN_TEXT_DOMAIN','woo-banner-management');

if (!defined('WBM_PLUGIN_URL'))
    define('WBM_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-banner-management-activator.php
 */
function activate_woo_banner_management() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-banner-management-activator.php';
	Woo_Banner_Management_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-banner-management-deactivator.php
 */
function deactivate_woo_banner_management() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-banner-management-deactivator.php';
	Woo_Banner_Management_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_banner_management' );
register_deactivation_hook( __FILE__, 'deactivate_woo_banner_management' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-banner-management.php';
require plugin_dir_path( __FILE__ ) . 'includes/constant.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_banner_management() {

	$plugin = new Woo_Banner_Management();
	$plugin->run();

}
run_woo_banner_management();
