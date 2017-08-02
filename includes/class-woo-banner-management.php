<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://multidots.com
 * @since      1.0.0
 *
 * @package    Woo_Banner_Management
 * @subpackage Woo_Banner_Management/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Woo_Banner_Management
 * @subpackage Woo_Banner_Management/includes
 * @author     Multidots <info@multidots.com>
 */
class Woo_Banner_Management {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Woo_Banner_Management_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {

        $this->plugin_name = 'woo-banner-management';
        $this->version = '1.0.0';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Woo_Banner_Management_Loader. Orchestrates the hooks of the plugin.
     * - Woo_Banner_Management_i18n. Defines internationalization functionality.
     * - Woo_Banner_Management_Admin. Defines all hooks for the admin area.
     * - Woo_Banner_Management_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-woo-banner-management-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-woo-banner-management-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-woo-banner-management-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-woo-banner-management-public.php';

        $this->loader = new Woo_Banner_Management_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Woo_Banner_Management_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new Woo_Banner_Management_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new Woo_Banner_Management_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        //$this->loader->add_action('admin_menu', $plugin_admin, 'wbm_crea_custom_menu');
        $this->loader->add_action('admin_menu', $plugin_admin, 'dot_store_menu_banner_management');
        //edit product cat
        $this->loader->add_action('product_cat_edit_form_fields', $plugin_admin, 'WBM_product_cat_taxonomy_custom_fields', 10, 2);
        $this->loader->add_action('edited_product_cat', $plugin_admin, 'WBM_product_cat_save_taxonomy_custom_fields', 10, 2);
        //add product cat 
        $this->loader->add_action('product_cat_add_form_fields', $plugin_admin, 'wbm_product_add_taxonomy_custom_fields', 10, 2);
        $this->loader->add_action('create_product_cat', $plugin_admin, 'WBM_product_cat_save_taxonomy_custom_fields', 10, 2);

        $this->loader->add_action('woocommerce_before_main_content', $plugin_admin, 'WBM_show_category_banner',10);
        $this->loader->add_action('woocommerce_before_main_content', $plugin_admin, 'wbm_show_shop_page_banner', 10);
        $this->loader->add_action('woocommerce_before_cart', $plugin_admin, 'wbm_show_cart_page_banner', 10);
        $this->loader->add_action('woocommerce_before_checkout_form', $plugin_admin, 'wbm_show_checkout_page_banner', 10);
        $this->loader->add_action('wp_ajax_wbm_save_shop_page_banner_data', $plugin_admin, 'wbm_save_shop_page_banner_data');
        $this->loader->add_action('wp_ajax_nopriv_wbm_save_shop_page_banner_data', $plugin_admin, 'wbm_save_shop_page_banner_data');

        $this->loader->add_action('wp_ajax_add_plugin_user_wbm', $plugin_admin, 'wp_add_plugin_userfn_wbmfree');
        $this->loader->add_action('wp_ajax_nopriv_add_plugin_user_wbm', $plugin_admin, 'wp_add_plugin_userfn_wbmfree');

        $this->loader->add_action('admin_init', $plugin_admin, 'welcome_benner_mamagement_for_woocommerce_screen_do_activation_redirect');
        $this->loader->add_action('admin_menu', $plugin_admin, 'welcome_pages_screen_benner_mamagement_for_woocommerce');


        $this->loader->add_action('benner_mamagement_for_woocommerce_other_plugins', $plugin_admin, 'benner_mamagement_for_woocommerce_other_plugins');
        $this->loader->add_action('benner_mamagement_for_woocommerce_about', $plugin_admin, 'benner_mamagement_for_woocommerce_about');
        $this->loader->add_action('benner_mamagement_for_woocommerce_premium_feauter', $plugin_admin, 'benner_mamagement_for_woocommerce_premium_feauter');
        $this->loader->add_action('admin_print_footer_scripts', $plugin_admin, 'benner_mamagement_for_woocommerce_pointers_footer');
        $this->loader->add_action('admin_head', $plugin_admin, 'welcome_screen_benner_mamagement_for_woocommerce_remove_menus', 999);
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new Woo_Banner_Management_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_filter('woocommerce_locate_template', $plugin_public, 'wbm_woocommerce_locate_template', 10, 3);
        $this->loader->add_filter('woocommerce_paypal_args', $plugin_public, 'paypal_bn_code_filter_banner_management_for_woocommerce', 99, 1);
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Woo_Banner_Management_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

}
