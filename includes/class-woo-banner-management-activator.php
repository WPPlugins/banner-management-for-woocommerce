<?php

/**
 * Fired during plugin activation
 *
 * @link       http://multidots.com
 * @since      1.0.0
 *
 * @package    Woo_Banner_Management
 * @subpackage Woo_Banner_Management/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Woo_Banner_Management
 * @subpackage Woo_Banner_Management/includes
 * @author     Multidots <info@multidots.com>
 */
class Woo_Banner_Management_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() { 
		if( !in_array( 'woocommerce/woocommerce.php',apply_filters('active_plugins',get_option('active_plugins'))) && !is_plugin_active_for_network( 'woocommerce/woocommerce.php' )   ) { 
			wp_die( "<strong>Woo-Banner-Management </strong> Plugin requires <strong>WooCommerce</strong> <a href='".get_admin_url(null, 'plugins.php')."'>Plugins page</a>." );
		} 
		
		global $wpdb,$woocommerce;
		set_transient( '_benner_management_for_woocommerce_welcome_screen', true, 30 );
	}

}
