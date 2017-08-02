<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://multidots.com
 * @since      1.0.0
 *
 * @package    Woo_Banner_Management
 * @subpackage Woo_Banner_Management/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Banner_Management
 * @subpackage Woo_Banner_Management/public
 * @author     Multidots <info@multidots.com>
 */
class Woo_Banner_Management_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
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
		 * defined in Woo_Banner_Management_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Banner_Management_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-banner-management-public.css', array(), $this->version, 'all' );

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
		 * defined in Woo_Banner_Management_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Banner_Management_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-banner-management-public.js', array( 'jquery' ), $this->version, false );

	}
		
	public function wbm_woocommerce_locate_template( $template, $template_name, $template_path ) {
		
			global $woocommerce;
			
			$_template = $template;
			
			if ( ! $template_path ) $template_path = $woocommerce->template_url;
				$path = untrailingslashit( plugin_dir_path( __FILE__ ) );
				$plugin_path  = $path . '/woocommerce/';
				$template = locate_template(
				
					array(
					
					  $template_path . $template_name,
					
					  $template_name
					
					)
				
				);
			
			// Modification: Get the template from this plugin, if it exists
			if ( ! $template && file_exists( $plugin_path . $template_name ) )
			
			$template = $plugin_path . $template_name;
			
			// Use default template
			if ( ! $template )
			
			$template = $_template;
			
			// Return what we found
			return $template;
		
		}
		
	/**
     * BN code added
     */
    function paypal_bn_code_filter_banner_management_for_woocommerce ($paypal_args) {
        $paypal_args['bn'] = 'Multidots_SP';
        return $paypal_args;
    }

}
