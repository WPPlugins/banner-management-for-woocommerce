<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://multidots.com
 * @since      1.0.0
 *
 * @package    Woo_Banner_Management
 * @subpackage Woo_Banner_Management/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Banner_Management
 * @subpackage Woo_Banner_Management/admin
 * @author     Multidots <info@multidots.com>
 */
class Woo_Banner_Management_Admin {

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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
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
         * defined in Woo_Banner_Management_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Woo_Banner_Management_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        if( !empty($_GET['page']) && isset( $_GET['page'] ) ) {
            if (isset($_GET['page']) && !empty($_GET['page']) && ($_GET['page'] == "banner-setting" || $_GET['page'] == "banner-management-for-woocommerce") || ($_GET['page'] == 'wbm-premium') || ($_GET['page'] == 'wbm-get-started') || ($_GET['page'] == 'wbm-information') || ($_GET['page'] == 'wbm-edit-fee')) {
                wp_enqueue_style('thickbox');
                wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/woo-banner-management-admin.css', array('wp-jquery-ui-dialog'), $this->version, 'all');
                wp_enqueue_style('image-upload-category-css', plugin_dir_url(__FILE__) . 'css/woo-image-upload.css', array(), $this->version, 'all');
                wp_enqueue_style('wp-pointer');

                wp_enqueue_style($this->plugin_name . '-choose-css', plugin_dir_url(__FILE__) . 'css/chosen.min.css', array(), $this->version, 'all');
                wp_enqueue_style($this->plugin_name . '-jquery-ui-css', plugin_dir_url(__FILE__) . 'css/jquery-ui.min.css', array(), $this->version, 'all');
                wp_enqueue_style($this->plugin_name . 'font-awesome', plugin_dir_url(__FILE__) . 'css/font-awesome.min.css', array(), $this->version, 'all');
                wp_enqueue_style($this->plugin_name . '-webkit-css', plugin_dir_url(__FILE__) . 'css/webkit.css', array(), $this->version, 'all');
                wp_enqueue_style($this->plugin_name . 'main-style', plugin_dir_url(__FILE__) . 'css/style.css', array(), 'all');
                wp_enqueue_style($this->plugin_name . 'media-css', plugin_dir_url(__FILE__) . 'css/media.css', array(), 'all');
            }
        }
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
         * defined in Woo_Banner_Management_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Woo_Banner_Management_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
       
        if (isset($_GET['page']) && !empty($_GET['page']) && ($_GET['page'] == "banner-setting" || $_GET['page'] == "banner-management-for-woocommerce" || $_GET['page'] == 'wbm-premium' || $_GET['page'] == 'wbm-get-started' || $_GET['page'] == 'wbm-information' || $_GET['page'] == 'wbm-edit-fee') || isset($_GET["taxonomy"]) && !empty($_GET["taxonomy"]) && ($_GET["taxonomy"]=='product_cat')) {
                wp_enqueue_script('jquery-ui');
                wp_enqueue_script('jquery-ui-accordion');
                wp_enqueue_script('jquery-ui-dialog');
                wp_enqueue_script('wp-pointer');
                wp_enqueue_media();
                wp_enqueue_script('thickbox');
                wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/woo-banner-management-admin.js', array('jquery'), $this->version, false);
                // wp_enqueue_style('wp-jquery-ui-dialog');
                wp_enqueue_script($this->plugin_name . '-choose-js', plugin_dir_url(__FILE__) . 'js/chosen.jquery.min.js', array('jquery', 'jquery-ui-datepicker'), $this->version, false);
                wp_enqueue_script($this->plugin_name . '-tablesorter-js', plugin_dir_url(__FILE__) . 'js/jquery.tablesorter.js', array('jquery'), $this->version, false);
                wp_enqueue_script('wbm-admin', plugin_dir_url(__FILE__) . 'js/wbm-admin.js', array('jquery'), $this->version);
            }
       
    }

    public function dot_store_menu_banner_management() {
        global $GLOBALS;
        if (empty($GLOBALS['admin_page_hooks']['dots_store'])) {
            add_menu_page(
                'DotStore Plugins', __('DotStore Plugins'), 'manage_option', 'dots_store', array($this, 'dot_store_menu_page'), WBM_PLUGIN_URL . 'admin/images/menu-icon.png', 25
            );
        }
        add_submenu_page('dots_store', __('Banner Management', 'banner-setting'), __('Banner Management', 'banner-setting'), 'manage_options', 'banner-setting', array($this, 'my_custom_submenu_page_callback'));
        add_submenu_page('dots_store', 'Get Started', 'Get Started', 'manage_options', 'wbm-get-started', array($this, 'wbm_get_started_page'));
        add_submenu_page('dots_store', 'Premium Version', 'Premium Version', 'manage_options', 'wbm-premium', array($this, 'premium_version_wbm_page'));
        add_submenu_page('dots_store', 'Introduction', 'Introduction', 'manage_options', 'wbm-information', array($this, 'wbm_information_page'));
    }

    public function dot_store_menu_page() {

    }

    public function wbm_information_page() {
        require_once('partials/wbm-information-page.php');
    }

    public function premium_version_wbm_page() {
        require_once('partials/wbm-premium-version-page.php');
    }

    public function wbm_get_started_page() {
        require_once('partials/wbm-get-started-page.php');
    }

    /**
     *  Set custom menu in woocommerce-benner-managment plugin
     */
    public function wbm_crea_custom_menu() {
        $wbm_page = 'woocommerce';
        $wbm_settings_page = add_submenu_page($wbm_page, __('Banner Management', 'banner-setting'), __('Banner Management', 'banner-setting'), 'manage_options', 'banner-setting', array(&$this, 'my_custom_submenu_page_callback'));
    }

    //custom call wbm setting page
    public function my_custom_submenu_page_callback() {
        wp_enqueue_media();
        $wbm_shop_page_stored_results_serialize_benner_src = '';
        $wbm_shop_page_stored_results_serialize_benner_link = '';
        $wbm_shop_page_stored_results_serialize_benner_enable_status = '';
        $wbm_shop_page_stored_results_serialize_benner_open_new_tab = '';

        $wbm_cart_page_stored_results_serialize_benner_src = '';
        $wbm_cart_page_stored_results_serialize_benner_link = '';
        $wbm_cart_page_stored_results_serialize_benner_enable_status = '';
        $wbm_cart_page_stored_results_serialize_benner_open_new_tab = '';

        $wbm_checkout_page_stored_results_serialize_benner_src = '';
        $wbm_checkout_page_stored_results_serialize_benner_link = '';
        $wbm_checkout_page_stored_results_serialize_benner_enable_status = '';
        $wbm_checkout_page_stored_results_serialize_benner_open_new_tab = '';

        $wbm_thankyou_page_stored_results_serialize_benner_src = '';
        $wbm_thankyou_page_stored_results_serialize_benner_link = '';
        $wbm_thankyou_page_stored_results_serialize_benner_enable_status = '';
        $wbm_thankyou_page_stored_results_serialize_benner_open_new_tab = '';


        $wbm_shop_page_stored_results = get_option('wbm_shop_page_stored_data', '');
        $wbm_cart_page_stored_results = get_option('wbm_cart_page_stored_data', '');
        $wbm_checkout_page_stored_results = get_option('wbm_checkout_page_stored_data', '');
        $wbm_thankyou_page_stored_results = get_option('wbm_thankyou_page_stored_data', '');

        // get shop page stored data 
        if (isset($wbm_shop_page_stored_results) && !empty($wbm_shop_page_stored_results)) {
            $wbm_shop_page_stored_results_serialize = maybe_unserialize($wbm_shop_page_stored_results);
            if (!empty($wbm_shop_page_stored_results_serialize)) {
                $wbm_shop_page_stored_results_serialize_benner_src = !empty($wbm_shop_page_stored_results_serialize['shop_page_banner_image_src']) ? $wbm_shop_page_stored_results_serialize['shop_page_banner_image_src'] : '';
                $wbm_shop_page_stored_results_serialize_benner_link = !empty($wbm_shop_page_stored_results_serialize['shop_page_banner_link_src']) ? $wbm_shop_page_stored_results_serialize['shop_page_banner_link_src'] : '';
                $wbm_shop_page_stored_results_serialize_benner_enable_status = !empty($wbm_shop_page_stored_results_serialize['shop_page_banner_enable_status']) ? $wbm_shop_page_stored_results_serialize['shop_page_banner_enable_status'] : '';
                $wbm_shop_page_stored_results_serialize_benner_open_new_tab = !empty($wbm_shop_page_stored_results_serialize['shop_page_benner_open_new_tab']) ? $wbm_shop_page_stored_results_serialize['shop_page_benner_open_new_tab'] : '';
            }
        }
        //get cart setting page stored data
        if (isset($wbm_cart_page_stored_results) && !empty($wbm_cart_page_stored_results)) {
            $wbm_cart_page_stored_results_serialize = maybe_unserialize($wbm_cart_page_stored_results);
            if (!empty($wbm_cart_page_stored_results_serialize)) {
                $wbm_cart_page_stored_results_serialize_benner_src = !empty($wbm_cart_page_stored_results_serialize['cart_page_banner_image_src']) ? $wbm_cart_page_stored_results_serialize['cart_page_banner_image_src'] : '';
                $wbm_cart_page_stored_results_serialize_benner_link = !empty($wbm_cart_page_stored_results_serialize['cart_page_banner_link_src']) ? $wbm_cart_page_stored_results_serialize['cart_page_banner_link_src'] : '';
                $wbm_cart_page_stored_results_serialize_benner_enable_status = !empty($wbm_cart_page_stored_results_serialize['cart_page_banner_enable_status']) ? $wbm_cart_page_stored_results_serialize['cart_page_banner_enable_status'] : '';
                $wbm_cart_page_stored_results_serialize_benner_open_new_tab = !empty($wbm_cart_page_stored_results_serialize['cart_page_benner_open_new_tab']) ? $wbm_cart_page_stored_results_serialize['cart_page_benner_open_new_tab'] : '';
            }
        }

        //get checkout setting page stored data
        if (isset($wbm_checkout_page_stored_results) && !empty($wbm_checkout_page_stored_results)) {
            $wbm_checkout_page_stored_results_serialize = maybe_unserialize($wbm_checkout_page_stored_results);
            if (!empty($wbm_checkout_page_stored_results_serialize)) {
                $wbm_checkout_page_stored_results_serialize_benner_src = !empty($wbm_checkout_page_stored_results_serialize['checkout_page_banner_image_src']) ? $wbm_checkout_page_stored_results_serialize['checkout_page_banner_image_src'] : '';
                $wbm_checkout_page_stored_results_serialize_benner_link = !empty($wbm_checkout_page_stored_results_serialize['checkout_page_banner_link_src']) ? $wbm_checkout_page_stored_results_serialize['checkout_page_banner_link_src'] : '';
                $wbm_checkout_page_stored_results_serialize_benner_enable_status = !empty($wbm_checkout_page_stored_results_serialize['checkout_page_banner_enable_status']) ? $wbm_checkout_page_stored_results_serialize['checkout_page_banner_enable_status'] : '';
                $wbm_checkout_page_stored_results_serialize_benner_open_new_tab = !empty($wbm_checkout_page_stored_results_serialize['checkout_page_benner_open_new_tab']) ? $wbm_checkout_page_stored_results_serialize['checkout_page_benner_open_new_tab'] : '';
            }
        }

        //get thank you setting page stored data
        if (isset($wbm_thankyou_page_stored_results) && !empty($wbm_thankyou_page_stored_results)) {
            $wbm_thankyou_page_stored_results_serialize = maybe_unserialize($wbm_thankyou_page_stored_results);
            if (!empty($wbm_thankyou_page_stored_results_serialize)) {
                $wbm_thankyou_page_stored_results_serialize_benner_src = !empty($wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_image_src']) ? $wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_image_src'] : '';
                $wbm_thankyou_page_stored_results_serialize_benner_link = !empty($wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_link_src']) ? $wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_link_src'] : '';
                $wbm_thankyou_page_stored_results_serialize_benner_enable_status = !empty($wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_enable_status']) ? $wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_enable_status'] : '';
                $wbm_thankyou_page_stored_results_serialize_benner_open_new_tab = !empty($wbm_thankyou_page_stored_results_serialize['thankyou_page_benner_open_new_tab']) ? $wbm_thankyou_page_stored_results_serialize['thankyou_page_benner_open_new_tab'] : '';
            }
        }

        require_once('partials/header/plugin-header.php');
        global $woocommerce;
        $current_user = wp_get_current_user();
        if (!get_option('wbmfree_plugin_notice_shown')) {
            ?>
            <div id="wbm_dialog">
                <p><?php _e('Be the first to get latest updates and exclusive content straight to your email inbox.', WBN_FREE_PLUGIN_TEXT_DOMAIN); ?></p>
                <p><input type="text" id="txt_user_sub_wbm" class="regular-text" name="txt_user_sub_wbm" value="<?php echo $current_user->user_email; ?>"></p>
            </div>
        <?php } ?>
        <!--<div class="succesful_message_wbm"></div> -->
        <div class="wbm-main-table res-cl">
            <h2>Banner Management Settings </h2>
            <div class="accordion">
                <table class="form-table table-outer product-fee-table">
                    <tbody>
                    <tr valign="top">
<!--                        <th class="titledesc" scope="row"><label for="fee_settings_product_fee_title">--><?php //_e('Product Fee Title', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?><!--<span class="required-star">*</span></label></th>-->
                        <td class="forminp mdtooltip"><div class="accordion-section">
                                <?php
                                $setting_enable_or_color = "red";
                                if ($wbm_shop_page_stored_results_serialize_benner_enable_status === 'on') {
                                    $setting_enable_or_not = " ( Enable ) ";
                                    $setting_enable_or_color = "green";
                                } else {
                                    $setting_enable_or_not = " ( Disable ) ";
                                    $setting_enable_or_color = "red";
                                }
                                ?>
                                <a class="accordion-section-title" href="#wbm-enable-banner-for-shpe-page"> Banner for shop page   <span id="shop_page_status_enable_or_disable" class="shop_page_status_enable_or_disable" style="color:<?php echo $setting_enable_or_color ?>"><?php echo $setting_enable_or_not; ?></span></a>
                                <div id="wbm-enable-banner-for-shpe-page" class="accordion-section-content">

                                    <table class="form-table" id="form-table-wbm-shop-page">
                                        <tbody>
                                        <tr>
                                            <th scope="row"><label class="wbm_leble_setting_css" for="wbm_enable_shop">Enable/Disable </label></th>
                                            <td><input type="checkbox" value="on" id="wbm_shop_setting_enable" class="wbm_shop_setting_enable_or_not" <?php
                                                if ($wbm_shop_page_stored_results_serialize_benner_enable_status === 'on') {
                                                    echo " checked ";
                                                }
                                                ?>></td>
                                            <?php
                                            $shop_page_url_results = "#";
                                            $shop_page_url = get_permalink(wc_get_page_id('shop'));
                                            if (!empty($shop_page_url)) {
                                                $shop_page_url_results = $shop_page_url;
                                            }
                                            if ($wbm_shop_page_stored_results_serialize_benner_enable_status === 'on') {
                                                $shop_page_preview_content = '<strong>Preview:</strong> <a href=' . $shop_page_url_results . '>Click here</a>';
                                            } else {
                                                $shop_page_preview_content = '';
                                            }
                                            ?>
                                            <input type="hidden" id="shop_page_hidden_url" value="<?php echo $shop_page_url_results; ?>">
                                            <td><span class="Preview_link_for_shop_page"><?php echo $shop_page_preview_content; ?></span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <?php
                                    $display_option = 'block';
                                    if ($wbm_shop_page_stored_results_serialize_benner_enable_status != 'on') {
                                        $display_option = 'none';
                                    }
                                    ?>
                                    <div class="wbm_shop_page_enable_open_div" style="display:<?php echo $display_option; ?>">
                                        <fieldset>
                                            <table class="form-table">
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><label  class="wbm_leble_setting_css" for="banner_url"><?php _e('Banner Image'); ?></label></th>
                                                    <td><a class='wbm_shop_page_upload_file_button button' uploader_title='Select File' uploader_button_text='Include File'>Upload File</a>  <a class='wbm_shop_page_remove_file button'>Remove File</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"></th>
                                                    <?php
                                                    if ($wbm_shop_page_stored_results_serialize_benner_src == '') {
                                                        $shop_page_benner_css = "none";
                                                    } else {
                                                        $shop_page_benner_css = "block";
                                                    }
                                                    ?>
                                                    <td><img class="wbm_shop_page_cat_banner_img_admin" style="display:<?php echo $shop_page_benner_css; ?>" src="<?php echo $wbm_shop_page_stored_results_serialize_benner_src; ?>" /></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><label  class="wbm_leble_setting_css" for="banner_link"><?php _e('Banner Image Link'); ?></label></th>
                                                    <td><input type="url" id="shop_page_banner_image_link" name='term_meta[banner_link]' value='<?php echo $wbm_shop_page_stored_results_serialize_benner_link; ?>' /><p><label class="banner_link_label" for="banner_link"><em>Where users will be directed if they click on the banner.</em></label></p>	</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><label  class="wbm_leble_setting_css" for="banner_link"><?php _e('Enable Open New Tab Link '); ?></label></th>
                                                    <td><input type="checkbox" value="open" id="wbm_shop_open_new_tab" class="wbm_shop_open_new_tab_or_not" <?php
                                                        if ($wbm_shop_page_stored_results_serialize_benner_open_new_tab === 'open') {
                                                            echo " checked ";
                                                        }
                                                        ?>>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </fieldset>
                                    </div>
                                </div><!--end .accordion-section-content-->
                            </div><!--end .accordion-section--></td>
                    </tr>
                    <tr>
<!--                        <th class="titledesc" scope="row"><label for="fee_settings_product_fee_title">--><?php //_e('Product Fee Title', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?><!--<span class="required-star">*</span></label></th>-->
                        <td class="forminp mdtooltip">
                            <div class="accordion-section">
                                <?php
                                $setting_enable_or_color_cart = "red";
                                $setting_enable_or_not_cart = " ( Disable ) ";
                                if ($wbm_cart_page_stored_results_serialize_benner_enable_status === 'on') {
                                    $setting_enable_or_not_cart = " ( Enable ) ";
                                    $setting_enable_or_color_cart = "green";
                                } else {
                                    $setting_enable_or_not_cart = " ( Disable ) ";
                                    $setting_enable_or_color = "red";
                                }
                                ?>
                                <a class="accordion-section-title" href="#wbm-enable-banner-for-cart-page">Banner for cart page <span  id="cart_page_status_enable_or_disable"class="shop_page_status_enable_or_disable" style="color:<?php echo $setting_enable_or_color_cart; ?>"> <?php echo $setting_enable_or_not_cart; ?></span></a>
                                <div id="wbm-enable-banner-for-cart-page" class="accordion-section-content">
                                    <div class="woocommerce-banner-managment-cart-setting-admin">

                                        <table class="form-table">
                                            <tbody>
                                            <tr>
                                                <th scope="row"><label class="wbm_leble_setting_css"  for="wbm_enable_shop">Enable/Disable</label></th>
                                                <td><input type="checkbox" value="on" id="wbm_shop_setting_cart_enable" class="wbm_shop_setting_cart_enable_or_not" <?php
                                                    if ($wbm_cart_page_stored_results_serialize_benner_enable_status === 'on') {
                                                        echo " checked ";
                                                    }
                                                    ?>></td>
                                                <?php
                                                $cart_url_results = "#";
                                                $cart_url = wc_get_cart_url();
                                                if (!empty($cart_url)) {
                                                    $cart_url_results = $cart_url;
                                                }
                                                if ($wbm_cart_page_stored_results_serialize_benner_enable_status === 'on') {
                                                    $cart_page_preview_url = '<strong>Preview:</strong> <a href=' . $cart_url_results . '>Click here</a>';
                                                } else {
                                                    $cart_page_preview_url = "";
                                                }
                                                ?>
                                                <input type="hidden" id="cart_page_hidden_url" value="<?php echo $cart_url_results; ?>">
                                                <td><span class="Preview_link_for_cart_page"><?php echo $cart_page_preview_url; ?></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <?php
                                        $display_option_cart = 'block';
                                        if ($wbm_cart_page_stored_results_serialize_benner_enable_status != 'on') {
                                            $display_option_cart = 'none';
                                        }
                                        ?>
                                        <div class="wbm-cart-upload-image-html" style="display:<?php echo $display_option_cart; ?>">
                                            <fieldset>
                                                <table class="form-table">
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row"><label  class="wbm_leble_setting_css" for="banner_url"><?php _e('Banner Image'); ?></label></th>
                                                        <td><a class='wbm_cart_page_upload_file_button button' uploader_title='Select File' uploader_button_text='Include File'>Upload File</a>  <a class='wbm_cart_page_remove_file button'>Remove File</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <?php
                                                        if ($wbm_cart_page_stored_results_serialize_benner_src == '') {
                                                            $cart_page_image_css = "none";
                                                        } else {
                                                            $cart_page_image_css = "block";
                                                        }
                                                        ?>
                                                        <td><img class="wbm_cart_page_cat_banner_img_admin" style="display:<?php echo $cart_page_image_css; ?>" src="<?php echo $wbm_cart_page_stored_results_serialize_benner_src; ?>" /></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><label  class="wbm_leble_setting_css" for="banner_link"><?php _e('Banner Image Link'); ?></label></th>
                                                        <td><input type="url" id="shop_cart_banner_image_link" name='term_meta[banner_link]' value='<?php echo $wbm_cart_page_stored_results_serialize_benner_link; ?>' /><p><label class="banner_link_label" for="banner_link"><em>Where users will be directed if they click on the banner.</em></label></p>	</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><label  class="wbm_leble_setting_css" for="banner_link"><?php _e('Enable Open New Tab Link'); ?></label></th>
                                                        <td><input type="checkbox" value="open" id="wbm_cart_open_new_tab" class="wbm_cart_open_new_tab_or_not" <?php
                                                            if ($wbm_cart_page_stored_results_serialize_benner_open_new_tab === 'open') {
                                                                echo " checked ";
                                                            }
                                                            ?>>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div><!--end .accordion-section-content-->
                            </div><!--end .accordion-section-->
                        </td>
                    </tr>
                    <tr>
<!--                        <th class="titledesc" scope="row"><label for="fee_settings_product_fee_title">--><?php //_e('Product Fee Title', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?><!--<span class="required-star">*</span></label></th>-->
                        <td class="forminp mdtooltip">
                            <div class="accordion-section">
                                <?php
                                $setting_enable_or_color_checkout = "red";
                                $setting_enable_or_not_checkout = " ( Disable ) ";
                                if ($wbm_checkout_page_stored_results_serialize_benner_enable_status === 'on') {
                                    $setting_enable_or_not_checkout = " ( Enable ) ";
                                    $setting_enable_or_color_checkout = "green";
                                } else {
                                    $setting_enable_or_not_checkout = " ( Disable ) ";
                                    $setting_enable_or_color_checkout = "red";
                                }
                                ?>
                                <a class="accordion-section-title" href="#wbm-enable-banner-for-checkout-page">Banner for checkout page <span id="checkout_page_status_enable_or_disable" class="shop_page_status_enable_or_disable" style="color:<?php echo $setting_enable_or_color_checkout; ?>"><?php echo $setting_enable_or_not_checkout; ?> </span></a>
                                <div id="wbm-enable-banner-for-checkout-page" class="accordion-section-content">
                                    <div class="woocommerce-banner-managment-checkout-setting-admin">
                                        <table class="form-table">

                                            <tbody>
                                            <tr>
                                                <th scope="row"><label class="wbm_leble_setting_css" for="wbm_enable_shop">Enable/Disable </label></th>
                                                <td><input type="checkbox" value="on" id="wbm_shop_setting_checkout_enable" class="wbm_shop_setting_checkout_enable_or_not" <?php
                                                    if ($wbm_checkout_page_stored_results_serialize_benner_enable_status === 'on') {
                                                        echo " checked ";
                                                    }
                                                    ?>></td>
                                                <?php
                                                $CheckOut_url_real = "#";
                                                $CheckOut_url = wc_get_checkout_url();
                                                if (!empty($CheckOut_url)) {
                                                    $CheckOut_url_real = $CheckOut_url;
                                                }
                                                if ($wbm_checkout_page_stored_results_serialize_benner_enable_status === 'on') {
                                                    $check_out_preview_content = '<strong>Preview :</strong> <a href=' . $CheckOut_url_real . '>Click here</a>';
                                                } else {
                                                    $check_out_preview_content = "";
                                                }
                                                ?>

                                                <input type="hidden" id="checkout_page_hidden_url" value="<?php echo $CheckOut_url_real; ?>">
                                                <td><span class="Preview_link_for_checkout_page"><?php echo $check_out_preview_content; ?></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <?php
                                        $display_option_checkout = 'block';
                                        if ($wbm_checkout_page_stored_results_serialize_benner_enable_status != 'on') {
                                            $display_option_checkout = 'none';
                                        }
                                        ?>
                                        <div class="wbm-checkout-upload-image-html" style="display:<?php echo $display_option_checkout; ?>">
                                            <fieldset>
                                                <table class="form-table">
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row"><label  class="wbm_leble_setting_css" for="banner_url"><?php _e('Banner Image'); ?></label></th>
                                                        <td><a class='wbm_checkout_page_upload_file_button button' uploader_title='Select File' uploader_button_text='Include File'>Upload File</a>  <a class='wbm_checkout_page_remove_file button'>Remove File</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <?php
                                                        if ($wbm_checkout_page_stored_results_serialize_benner_src == '') {
                                                            $checkout_banner_image_css = "none";
                                                        } else {
                                                            $checkout_banner_image_css = "block";
                                                        }
                                                        ?>
                                                        <td><img class="wbm_checkout_page_banner_img_admin"  style="display:<?php echo $checkout_banner_image_css; ?>"src="<?php echo $wbm_checkout_page_stored_results_serialize_benner_src; ?>" /></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><label class="wbm_leble_setting_css" for="banner_link"><?php _e('Banner Image Link'); ?></label></th>
                                                        <td><input type="url" id="shop_checkout_banner_image_link" name='term_meta[banner_link]' value='<?php echo $wbm_checkout_page_stored_results_serialize_benner_link; ?>' /><p><label class="banner_link_label" for="banner_link"><em>Where users will be directed if they click on the banner.</em></label></p>	</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><label  class="wbm_leble_setting_css" for="banner_link"><?php _e('Enable Open New Tab Link'); ?></label></th>
                                                        <td><input type="checkbox" value="open" id="wbm_checkout_open_new_tab" class="wbm_checkout_open_new_tab_or_not" <?php
                                                            if ($wbm_checkout_page_stored_results_serialize_benner_open_new_tab === 'open') {
                                                                echo " checked ";
                                                            }
                                                            ?>>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div><!--end .accordion-section-content-->
                            </div><!--end .accordion-section-->
                        </td>
                    </tr>
                    <tr>
<!--                        <th class="titledesc" scope="row"><label for="fee_settings_product_fee_title">--><?php //_e('Product Fee Title', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?><!--<span class="required-star">*</span></label></th>-->
                        <td class="forminp mdtooltip">
                            <div class="accordion-section">
                                <?php
                                $setting_enable_or_color_thankyou = "red";
                                $setting_enable_or_not_thankyou = " ( Disable ) ";
                                if ($wbm_thankyou_page_stored_results_serialize_benner_enable_status === 'on') {
                                    $setting_enable_or_not_thankyou = " ( Enable ) ";
                                    $setting_enable_or_color_thankyou = "green";
                                } else {
                                    $setting_enable_or_not_thankyou = " ( Disable ) ";
                                    $setting_enable_or_color_thankyou = "red";
                                }
                                ?>
                                <a class="accordion-section-title" href="#wbm-enable-banner-for-thankyou-page">Banner for thank you page <span id="thankyou_page_status_enable_or_disable"class="shop_page_status_enable_or_disable" style="color:<?php echo $setting_enable_or_color_thankyou; ?>"><?php echo $setting_enable_or_not_thankyou; ?></span></a>
                                <div id="wbm-enable-banner-for-thankyou-page" class="accordion-section-content">
                                    <div class="woocommerce-banner-managment-thank-you-setting-admin">
                                        <table class="form-table">
                                            <tbody>
                                            <tr>
                                                <th scope="row"><label class="wbm_leble_setting_css"  for="wbm_enable_shop">Enable/Disable</label></th>
                                                <td><input type="checkbox" value="on" id="wbm_shop_setting_thank_you_page_enable" class="wbm_shop_setting_thank_you_page_enable_or_not" <?php
                                                    if ($wbm_thankyou_page_stored_results_serialize_benner_enable_status === 'on') {
                                                        echo " checked ";
                                                    }
                                                    ?>></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <?php
                                        $display_option_checkout = 'block';
                                        if ($wbm_thankyou_page_stored_results_serialize_benner_enable_status != 'on') {
                                            $display_option_checkout = 'none';
                                        }
                                        ?>
                                        <div class="wbm-thank-you-page-upload-image-html" style="display:<?php echo $display_option_checkout; ?>">
                                            <fieldset>
                                                <table class="form-table">
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row"><label class="wbm_leble_setting_css"  for="banner_url"><?php _e('Banner Image'); ?></label></th>
                                                        <td><a class='wbm_thank_you_page_upload_file_button button' uploader_title='Select File' uploader_button_text='Include File'>Upload File</a>  <a class='wbm_checkout_page_remove_file button'>Remove File</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <?php
                                                        if ($wbm_thankyou_page_stored_results_serialize_benner_src == '') {
                                                            $thankyou_page_image_css = "none";
                                                        } else {
                                                            $thankyou_page_image_css = "block";
                                                        }
                                                        ?>
                                                        <td><img class="wbm_thank_you_page_banner_img_admin" style="display:<?php echo $thankyou_page_image_css; ?>"src="<?php echo $wbm_thankyou_page_stored_results_serialize_benner_src; ?>" /></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><label  class="wbm_leble_setting_css" for="banner_link"><?php _e('Banner Image Link'); ?></label></th>
                                                        <td><input type="url" id="shop_thank_you_page_banner_image_link" name='term_meta[banner_link]' value='<?php echo $wbm_thankyou_page_stored_results_serialize_benner_link; ?>' /><p><label class="banner_link_label" for="banner_link"><em>Where users will be directed if they click  on the banner.</em></label></p>	</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><label  class="wbm_leble_setting_css" for="banner_link"><?php _e('Enable Open New Tab Link'); ?></label></th>
                                                        <td><input type="checkbox" value="open" id="wbm_thankyou_open_new_tab" class="wbm_thankyou_open_new_tab_or_not" <?php
                                                            if ($wbm_thankyou_page_stored_results_serialize_benner_open_new_tab === 'open') {
                                                                echo " checked ";
                                                            }
                                                            ?>>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div><!--end .accordion-section-content-->
                            </div><!--end .accordion-section-->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="sub-title">
                <h2><?php _e('Category specific banner', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></h2>
            </div>
            <table id="tbl-product-fee" class="tbl_product_fee table-outer tap-cas form-table product-fee-table">
                <tbody>
                <tr>
                    <td class="forminp mdtooltip">
                        <div class="category_based_settings">
                            <p>You can upload custom banner at the top of your product category pages. Easily update the image through your product category edit page.</p> </br>
                            <img  class="preview_category_page_image" src="<?php echo __(WooCommerce_Banner_Management_Url); ?>admin/assets/images/category_setting_image.png">
                            <p><strong>Go to category page</strong> <a target="_blank" href="<?php echo site_url(); ?>/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product">click here</a></p>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <input type="button" name="save_wbmshop" id="save_wbm_shop_page_setting" class="button button-primary" value="Save Changes">
        </div>

        <?php

        require_once('partials/header/plugin-sidebar.php');
    }

    /**
     *
     *  set the custom html for category add fiel
     *
     */
    function wbm_product_add_taxonomy_custom_fields($tag) {
        ?>
        <script>
            jQuery(document).ajaxComplete(function(event, request, options) {
                if (request && 4 === request.readyState && 200 === request.status
                    && options.data && 0 <= options.data.indexOf('action=add-tag')) {

                    var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');
                    if (!res || res.errors) {
                        return;
                    }
                    // Clear Thumbnail fields on submit
                    jQuery('#add_cat_banner_img_admin').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                    jQuery('#product_cat_thumbnail_id').val('');
                    jQuery('.remove_image_button').hide();
                    // Clear Display type field on submit
                    jQuery('#display_type').val('');
                    jQuery('.add_cat_banner_img_admin').css('display', 'none');
                    jQuery('.auto_display_banner').val('');
                    jQuery('.term_meta_link_add').val('');
                    jQuery('.term_meta_link_add').val('');
                    $('input:checkbox[id=auto_display_banner_create_new]').css('input[type=checkbox]:checked:before', 'content:\f147;');

                    return;
                }
            });
        </script>
        <tr class="form-field mdwbm_banner_url_form_field">
            <th scope="row" valign="top">
                <label for="banner_url"><?php _e('Banner Image'); ?></label>
            </th>
            <td>
                <fieldset>
                    <a class='mdwbm_add_cat_upload_file_button button' uploader_title='Select File' uploader_button_text='Include File'>Upload File</a>
                    <a class='mdwbm_add_cat_remove_file button'>Remove File</a>
                    <!--<label class='banner_url_label' ><?php //if ( $banner_id != null ) echo basename( wp_get_attachment_url( $banner_id ) )         ?></label>-->
                </fieldset>
                <fieldset>
                    <img class="add_cat_banner_img_admin" style="display:none"src="<?php //if ( $banner_id != null ) echo wp_get_attachment_url( $banner_id )         ?>" />
                </fieldset>

                <input type="hidden" class='mdwbm_image' name='term_meta[banner_url_id]' value='<?php //if ( $banner_id != null ) echo $banner_id;         ?>' />
            </td>
        </tr>
        <tr class="form-field banner_link_form_field">
            <th scope="row" valign="top">
                <label for="banner_link"><?php _e('Banner image link'); ?></label>
            </th>
            <td>
                <fieldset>
                    <input type="url" name='term_meta[banner_link]' class="term_meta_link_add" value='<?php //if ( $banner_link != null ) echo $banner_link         ?>' />
                    <label class="banner_link_label" for="banner_link"><em>Where users will be directed if they click on the banner.</em></label>
                </fieldset>
            </td>
        </tr>
        <tr class="form-field auto_display_banner">
            <th scope="row" valign="top">
                <label for="auto_display_banner"><?php _e('Automatically insert banner above main content'); ?></label>
            </th>
            <td>
                <fieldset>
                    <input name="term_meta[auto_display_banner]" type="checkbox" checked value="on" class="auto_display_banner" id="auto_display_banner_create_new"/>
                    <label class="auto_display_banner_label" for="auto_display_banner"><em></em></label>
                </fieldset>
            </td>
        </tr>
        <?php
    }

    /**
     * 	Set the custom html for category edit field
     *
     */
    function WBM_product_cat_taxonomy_custom_fields($tag) {
        $t_id = $tag->term_id;
        $term_meta = get_option("taxonomy_term_$t_id");
        //print_r($tag);
        // Get banner image
        if (isset($term_meta['banner_url_id']) and $term_meta['banner_url_id'] != '') {

            $banner_id = $term_meta['banner_url_id'];
        } else {
            $banner_id = null;
        }

        // Get banner link 
        if (isset($term_meta['banner_link']) and $term_meta['banner_link'] != '')
            $banner_link = $term_meta['banner_link'];
        else
            $banner_link = null;

        if ((isset($term_meta['auto_display_banner']) && $term_meta['auto_display_banner'] == 'on') || !isset($term_meta['auto_display_banner'])) {
            $auto_display_banner = true;
        } else {
            $auto_display_banner = false;
        }
        ?>
        <tr class="form-field mdwbm_banner_url_form_field">
            <th scope="row" valign="top">
                <label for="banner_url"><?php _e('Banner Image'); ?></label>
            </th>
            <td>
                <fieldset>
                    <a class='mdwbm_upload_file_button button' uploader_title='Select File' uploader_button_text='Include File'>Upload File</a>
                    <a class='mdwbm_remove_file button'>Remove File</a>
                    <!--<label class='banner_url_label' ><?php //if ( $banner_id != null ) echo basename( wp_get_attachment_url( $banner_id ) )       ?></label>-->
                </fieldset>

                <fieldset>
                    <?php
                    if ($banner_id == '') {
                        $category_banner_css = "none";
                    } else {
                        $category_banner_css = "block";
                    }
                    ?>
                    <img class="cat_banner_img_admin" style="display:<?php echo $category_banner_css; ?>"src="<?php if ($banner_id != null) echo wp_get_attachment_url($banner_id) ?>" />
                </fieldset>

                <input type="hidden" class='mdwbm_image' name='term_meta[banner_url_id]' value='<?php if ($banner_id != null) echo $banner_id; ?>' />
            </td>
        </tr>
        <tr class="form-field banner_link_form_field">
            <th scope="row" valign="top">
                <label for="banner_link"><?php _e('Banner image link'); ?></label>
            </th>
            <td>
                <fieldset>
                    <input type="url" name='term_meta[banner_link]' value='<?php if ($banner_link != null) echo $banner_link ?>' />
                    <label class="banner_link_label" for="banner_link"><em>Where users will be directed if they click on the banner.</em></label>
                </fieldset>
            </td>
        </tr>
        <tr class="form-field auto_display_banner">
            <th scope="row" valign="top">
                <label for="auto_display_banner"><?php _e('Automatically insert banner above main content'); ?></label>
            </th>
            <td>
                <fieldset>
                    <input name="term_meta[auto_display_banner]" type="checkbox" value="on" class="auto_display_banner" <?php if ($auto_display_banner) echo " checked "; ?>/>
                    <label class="auto_display_banner_label" for="auto_display_banner"><em></em></label>
                </fieldset>
            </td>
        </tr>

        <?php
    }

    /**
     * Save the Woocommerce-Banner-Managment Category Data
     *
     * @param  $term_id
     */
    function WBM_product_cat_save_taxonomy_custom_fields($term_id) {

        if (isset($_POST['term_meta'])) {
            $t_id = $term_id;
            $term_meta = get_option("taxonomy_term_$t_id");
            $posted_term_meta = $_POST['term_meta'];

            if (!isset($posted_term_meta['auto_display_banner']))
                $posted_term_meta['auto_display_banner'] = 'off';

            $cat_keys = array_keys($posted_term_meta);

            foreach ($cat_keys as $key) {
                if (isset($posted_term_meta[$key])) {
                    $term_meta[$key] = $posted_term_meta[$key];
                }
            }
            //save the option array  
            update_option("taxonomy_term_$t_id", $term_meta);
        }
    }

    /**
     * Save WBM shop page setting
     *
     */
    public function wbm_save_shop_page_banner_data() {
        $shop_page_banner_image_results = sanitize_text_field(!empty($_POST['shop_page_banner_image_results'])) ? $_POST['shop_page_banner_image_results'] : '';
        $shop_page_banner_link_results = sanitize_text_field(!empty($_POST['shop_page_banner_link_results'])) ? $_POST['shop_page_banner_link_results'] : '';
        print_r($_POST['shop_page_banner_enable_or_not_results']);
        $shop_page_banner_enable_or_not_results = sanitize_text_field(!empty($_POST['shop_page_banner_enable_or_not_results'])) ? $_POST['shop_page_banner_enable_or_not_results'] : '';

        print_r($_POST['shop_page_benner_open_new_tab_results']);
        $shop_page_benner_open_new_tab_results = sanitize_text_field(!empty($_POST['shop_page_benner_open_new_tab_results'])) ? $_POST['shop_page_benner_open_new_tab_results'] : '';

        $cart_page_banner_image_results = sanitize_text_field(!empty($_POST['cart_page_banner_image_results'])) ? $_POST['cart_page_banner_image_results'] : '';
        $cart_page_banner_link_results = sanitize_text_field(!empty($_POST['cart_page_banner_link_results'])) ? $_POST['cart_page_banner_link_results'] : '';
        $cart_page_banner_enable_or_not_results = sanitize_text_field(!empty($_POST['cart_page_banner_enable_or_not_results'])) ? $_POST['cart_page_banner_enable_or_not_results'] : '';
        $cart_page_benner_open_new_tab_results = sanitize_text_field(!empty($_POST['cart_page_benner_open_new_tab_results'])) ? $_POST['cart_page_benner_open_new_tab_results'] : '';


        $checkout_page_banner_image_results = sanitize_text_field(!empty($_POST['checkout_page_banner_image_results'])) ? $_POST['checkout_page_banner_image_results'] : '';
        $checkout_page_banner_link_results = sanitize_text_field(!empty($_POST['checkout_page_banner_link_results'])) ? $_POST['checkout_page_banner_link_results'] : '';
        $checkout_page_banner_enable_or_not_results = sanitize_text_field(!empty($_POST['checkout_page_banner_enable_or_not_results'])) ? $_POST['checkout_page_banner_enable_or_not_results'] : '';
        $checkout_page_benner_open_new_tab_results = sanitize_text_field(!empty($_POST['checkout_page_benner_open_new_tab_results'])) ? $_POST['checkout_page_benner_open_new_tab_results'] : '';


        $thankyou_page_banner_image_results = sanitize_text_field(!empty($_POST['thankyou_page_banner_image_results'])) ? $_POST['thankyou_page_banner_image_results'] : '';
        $thankyou_page_banner_link_results = sanitize_text_field(!empty($_POST['thankyou_page_banner_link_results'])) ? $_POST['thankyou_page_banner_link_results'] : '';
        $thankyou_page_banner_enable_or_not_results = sanitize_text_field(!empty($_POST['thankyou_page_banner_enable_or_not_results'])) ? $_POST['thankyou_page_banner_enable_or_not_results'] : '';
        $thankyou_page_benner_open_new_tab_results = sanitize_text_field(!empty($_POST['thankyou_page_benner_open_new_tab_results'])) ? $_POST['thankyou_page_benner_open_new_tab_results'] : '';

        $shop_page_data_stored_array = array(
            'shop_page_banner_image_src' => $shop_page_banner_image_results,
            'shop_page_banner_link_src' => $shop_page_banner_link_results,
            'shop_page_banner_enable_status' => $shop_page_banner_enable_or_not_results,
            'shop_page_benner_open_new_tab' => $shop_page_benner_open_new_tab_results,
        );

        $cart_page_data_stored_array = array(
            'cart_page_banner_image_src' => $cart_page_banner_image_results,
            'cart_page_banner_link_src' => $cart_page_banner_link_results,
            'cart_page_banner_enable_status' => $cart_page_banner_enable_or_not_results,
            'cart_page_benner_open_new_tab' => $cart_page_benner_open_new_tab_results,
        );

        $checkout_page_data_stored_array = array(
            'checkout_page_banner_image_src' => $checkout_page_banner_image_results,
            'checkout_page_banner_link_src' => $checkout_page_banner_link_results,
            'checkout_page_banner_enable_status' => $checkout_page_banner_enable_or_not_results,
            'checkout_page_benner_open_new_tab' => $checkout_page_benner_open_new_tab_results,
        );

        $thankyou_page_data_stored_array = array(
            'thankyou_page_banner_image_src' => $thankyou_page_banner_image_results,
            'thankyou_page_banner_link_src' => $thankyou_page_banner_link_results,
            'thankyou_page_banner_enable_status' => $thankyou_page_banner_enable_or_not_results,
            'thankyou_page_benner_open_new_tab' => $thankyou_page_benner_open_new_tab_results,
        );

        update_option('wbm_shop_page_stored_data', $shop_page_data_stored_array);
        update_option('wbm_cart_page_stored_data', $cart_page_data_stored_array);
        update_option('wbm_checkout_page_stored_data', $checkout_page_data_stored_array);
        update_option('wbm_thankyou_page_stored_data', $thankyou_page_data_stored_array);
        die();
        /* update_option('',) */
    }

    /**
     * Show Category Banner In Category Page
     *
     */
    public function WBM_show_category_banner() {
        global $woocommerce;
        global $wp_query;

        // Make sure this is a product category page
        if (is_product_category()) {
            $cat_id = $wp_query->queried_object->term_id;

            $term_options = get_option("taxonomy_term_$cat_id");

            if ((isset($term_options['auto_display_banner']) && $term_options['auto_display_banner'] == 'on') || !isset($term_options['auto_display_banner'])) {
                // Get the banner image id
                if ($term_options['banner_url_id'] != '')
                    $url = wp_get_attachment_url($term_options['banner_url_id']);

                // Exit if the image url doesn't exist
                if (!isset($url) or $url == false)
                    return;

                // Get the banner link if it exists
                if ($term_options['banner_link'] != '')
                    $link = $term_options['banner_link'];

                // Print Output
                if (isset($link)) {
                    if ($link == '') {
                        echo "<a>";
                    } else {
                        echo "<a href='" . $link . "' target='_blank'>";
                    }
                }
                if ($url != false) {
                    echo "<img src='" . $url . "' class='wbm_category_banner_image' />";
                }
                if (isset($link)) {
                    echo "</a>";
                }
            }
        }
    }

    /**
     * Function For display the banner image in shop page
     *
     *
     */
    public function wbm_show_shop_page_banner() {
        global $woocommerce, $wp_query, $wpdb;

        $wbm_shop_page_stored_results_serialize_benner_src = '';
        $wbm_shop_page_stored_results_serialize_benner_link = '';
        $wbm_shop_page_stored_results_serialize_benner_enable_status = '';
        $wbm_shop_page_stored_results_serialize_benner_open_new_tab = '';
        $alt_tag_value = '';

        $wbm_shop_page_stored_results = get_option('wbm_shop_page_stored_data', '');
        if (isset($wbm_shop_page_stored_results) && !empty($wbm_shop_page_stored_results)) {
            $wbm_shop_page_stored_results_serialize = maybe_unserialize($wbm_shop_page_stored_results);
            if (!empty($wbm_shop_page_stored_results_serialize)) {
                $wbm_shop_page_stored_results_serialize_benner_src = !empty($wbm_shop_page_stored_results_serialize['shop_page_banner_image_src']) ? $wbm_shop_page_stored_results_serialize['shop_page_banner_image_src'] : '';
                $wbm_shop_page_stored_results_serialize_benner_link = !empty($wbm_shop_page_stored_results_serialize['shop_page_banner_link_src']) ? $wbm_shop_page_stored_results_serialize['shop_page_banner_link_src'] : '';
                $wbm_shop_page_stored_results_serialize_benner_enable_status = !empty($wbm_shop_page_stored_results_serialize['shop_page_banner_enable_status']) ? $wbm_shop_page_stored_results_serialize['shop_page_banner_enable_status'] : '';
                $wbm_shop_page_stored_results_serialize_benner_open_new_tab = !empty($wbm_shop_page_stored_results_serialize['shop_page_benner_open_new_tab']) ? $wbm_shop_page_stored_results_serialize['shop_page_benner_open_new_tab'] : '';

                $wbm_shop_page_stored_results_serialize_benner_alt = array_reverse(explode('/', $wbm_shop_page_stored_results_serialize_benner_src));
                if (!empty($wbm_shop_page_stored_results_serialize_benner_src)) {
                    if (!empty($wbm_shop_page_stored_results_serialize_benner_alt)) {
                        $wbm_shop_page_stored_results_serialize_benner_alt_results = array_reverse(explode('.', $wbm_shop_page_stored_results_serialize_benner_src));
                        if (!empty($wbm_shop_page_stored_results_serialize_benner_alt_results)) {
                            $wbm_shop_page_stored_results_serialize_benner_alt_results = array_reverse(explode('/', $wbm_shop_page_stored_results_serialize_benner_alt_results[1]));
                            $alt_tag_value = $wbm_shop_page_stored_results_serialize_benner_alt_results[0];
                        }
                    }
                }
            }
        }

        if (is_shop()) {
            if (!empty($wbm_shop_page_stored_results_serialize_benner_open_new_tab) && $wbm_shop_page_stored_results_serialize_benner_open_new_tab === 'open') {
                $test="_blank";
                //print_r($wbm_shop_page_stored_results_serialize_benner_open_new_tab);
            }
            else
            {
                $test="_self";
            }
            ?>
            <?php //echo $wbm_shop_page_stored_results_serialize_benner_open_new_tab;?>
            <?php if (!empty($wbm_shop_page_stored_results_serialize_benner_enable_status) && $wbm_shop_page_stored_results_serialize_benner_enable_status === 'on') {
                // print_r($wbm_shop_page_stored_results_serialize_benner_enable_status);
                ?>
                <div class="wbm_banner_image">
                    <?php
                    if ($wbm_shop_page_stored_results_serialize_benner_link == '') {
                        $alt_tag_css_shop_page_fornt = 'style="cursor:default"';
                    } else {
                        $alt_tag_css_shop_page_fornt = 'style="cursor:pointer"href="' . $wbm_shop_page_stored_results_serialize_benner_link . '" target="'. $test .'"';
                    }
                    ?>
                    <a <?php echo $alt_tag_css_shop_page_fornt; ?>>
                        <p><img src="<?php echo $wbm_shop_page_stored_results_serialize_benner_src; ?>" class="category_banner_image" alt="<?php echo $alt_tag_value; ?>"></p>
                    </a>
                </div>
                <?php
            }
        }
    }

    /**
     * Function For display banner image in cart page
     *
     */
    public function wbm_show_cart_page_banner() {
        $wbm_cart_page_stored_results_serialize_benner_src = '';
        $wbm_cart_page_stored_results_serialize_benner_link = '';
        $wbm_cart_page_stored_results_serialize_benner_enable_status = '';
        $wbm_cart_page_stored_results_serialize_benner_open_new_tab = '';
        $alt_tag_value = '';

        $wbm_cart_page_stored_results = get_option('wbm_cart_page_stored_data', '');
        if (isset($wbm_cart_page_stored_results) && !empty($wbm_cart_page_stored_results)) {
            $wbm_cart_page_stored_results_serialize = maybe_unserialize($wbm_cart_page_stored_results);
            if (!empty($wbm_cart_page_stored_results_serialize)) {
                $wbm_cart_page_stored_results_serialize_benner_src = !empty($wbm_cart_page_stored_results_serialize['cart_page_banner_image_src']) ? $wbm_cart_page_stored_results_serialize['cart_page_banner_image_src'] : '';
                $wbm_cart_page_stored_results_serialize_benner_link = !empty($wbm_cart_page_stored_results_serialize['cart_page_banner_link_src']) ? $wbm_cart_page_stored_results_serialize['cart_page_banner_link_src'] : '';
                $wbm_cart_page_stored_results_serialize_benner_enable_status = !empty($wbm_cart_page_stored_results_serialize['cart_page_banner_enable_status']) ? $wbm_cart_page_stored_results_serialize['cart_page_banner_enable_status'] : '';
                $wbm_cart_page_stored_results_serialize_benner_open_new_tab = !empty($wbm_cart_page_stored_results_serialize['cart_page_benner_open_new_tab']) ? $wbm_cart_page_stored_results_serialize['cart_page_benner_open_new_tab'] : '';

                $wbm_cart_page_stored_results_serialize_benner_alt = array_reverse(explode('/', $wbm_cart_page_stored_results_serialize_benner_src));
                if (!empty($wbm_cart_page_stored_results_serialize_benner_src)) {
                    if (!empty($wbm_cart_page_stored_results_serialize_benner_alt)) {
                        $wbm_cart_page_stored_results_serialize_benner_alt_results = array_reverse(explode('.', $wbm_cart_page_stored_results_serialize_benner_src));
                        if (!empty($wbm_cart_page_stored_results_serialize_benner_alt_results)) {
                            $wbm_cart_page_stored_results_serialize_benner_alt_results = array_reverse(explode('/', $wbm_cart_page_stored_results_serialize_benner_alt_results[1]));
                            $alt_tag_value = $wbm_cart_page_stored_results_serialize_benner_alt_results[0];
                        }
                    }
                }
            }
        }
        if (!empty($wbm_cart_page_stored_results_serialize_benner_open_new_tab) && $wbm_cart_page_stored_results_serialize_benner_open_new_tab === 'open') {
            $test="_blank";
            //print_r($wbm_shop_page_stored_results_serialize_benner_open_new_tab);
        }
        else
        {
            $test="_self";
        }
        if (!empty($wbm_cart_page_stored_results_serialize_benner_enable_status) && $wbm_cart_page_stored_results_serialize_benner_enable_status === 'on') {
            //print_r($wbm_shop_page_stored_results_serialize_benner_alt);

            ?>
            <div class="wbm_banner_image">
                <?php
                if ($wbm_cart_page_stored_results_serialize_benner_link == '') {
                    $alt_tag_css_cart_page_fornt = 'style="cursor:default"';
                } else {
                    $alt_tag_css_cart_page_fornt = 'style="cursor:pointer"href="' . $wbm_cart_page_stored_results_serialize_benner_link . '" target="'. $test .'"';
                }
                ?>
                <a <?php echo $alt_tag_css_cart_page_fornt; ?>>
                    <p><img src="<?php echo $wbm_cart_page_stored_results_serialize_benner_src; ?>" class="cart_banner_image" alt="<?php echo $alt_tag_value; ?>"></p>
                </a>
            </div>
            <?php
        }
    }

    /**
     * Function For display banner image in check out page
     *
     */
    public function wbm_show_checkout_page_banner() {

        $wbm_checkout_page_stored_results_serialize_benner_src = '';
        $wbm_checkout_page_stored_results_serialize_benner_link = '';
        $wbm_checkout_page_stored_results_serialize_benner_enable_status = '';
        $wbm_checkout_page_stored_results_serialize_benner_open_new_tab = '';
        $alt_tag_value = '';

        $wbm_checkout_page_stored_results = get_option('wbm_checkout_page_stored_data', '');

        if (isset($wbm_checkout_page_stored_results) && !empty($wbm_checkout_page_stored_results)) {
            $wbm_checkout_page_stored_results_serialize = maybe_unserialize($wbm_checkout_page_stored_results);
            if (!empty($wbm_checkout_page_stored_results_serialize)) {
                $wbm_checkout_page_stored_results_serialize_benner_src = !empty($wbm_checkout_page_stored_results_serialize['checkout_page_banner_image_src']) ? $wbm_checkout_page_stored_results_serialize['checkout_page_banner_image_src'] : '';
                $wbm_checkout_page_stored_results_serialize_benner_link = !empty($wbm_checkout_page_stored_results_serialize['checkout_page_banner_link_src']) ? $wbm_checkout_page_stored_results_serialize['checkout_page_banner_link_src'] : '';
                $wbm_checkout_page_stored_results_serialize_benner_enable_status = !empty($wbm_checkout_page_stored_results_serialize['checkout_page_banner_enable_status']) ? $wbm_checkout_page_stored_results_serialize['checkout_page_banner_enable_status'] : '';

                $wbm_checkout_page_stored_results_serialize_benner_open_new_tab = !empty($wbm_checkout_page_stored_results_serialize['checkout_page_benner_open_new_tab']) ? $wbm_checkout_page_stored_results_serialize['checkout_page_benner_open_new_tab'] : '';

                $wbm_checkout_page_stored_results_serialize_benner_alt = array_reverse(explode('/', $wbm_checkout_page_stored_results_serialize_benner_src));
                if (!empty($wbm_checkout_page_stored_results_serialize_benner_src)) {
                    if (!empty($wbm_checkout_page_stored_results_serialize_benner_alt)) {
                        $wbm_checkout_page_stored_results_serialize_benner_alt_results = array_reverse(explode('.', $wbm_checkout_page_stored_results_serialize_benner_src));
                        if (!empty($wbm_checkout_page_stored_results_serialize_benner_alt_results)) {
                            $wbm_checkout_page_stored_results_serialize_benner_alt_results = array_reverse(explode('/', $wbm_checkout_page_stored_results_serialize_benner_alt_results[1]));
                            $alt_tag_value = $wbm_checkout_page_stored_results_serialize_benner_alt_results[0];
                        }
                    }
                }
            }
        }
        if (!empty($wbm_checkout_page_stored_results_serialize_benner_open_new_tab) && $wbm_checkout_page_stored_results_serialize_benner_open_new_tab === 'open') {
            $test="_blank";
            //print_r($wbm_shop_page_stored_results_serialize_benner_open_new_tab);
        }
        else
        {
            $test="_self";
        }
        if (!empty($wbm_checkout_page_stored_results_serialize_benner_enable_status) && $wbm_checkout_page_stored_results_serialize_benner_enable_status === 'on') {
            //print_r($wbm_shop_page_stored_results_serialize_benner_alt);
            ?>
            <div class="wbm_banner_image">
                <?php
                if ($wbm_checkout_page_stored_results_serialize_benner_link == '') {
                    $alt_tag_css_checkout_page_fornt = 'style="cursor:default"';
                } else {
                    $alt_tag_css_checkout_page_fornt = 'style="cursor:pointer"href="' . $wbm_checkout_page_stored_results_serialize_benner_link . '" target="'. $test .'"';
                }
                ?>
                <a <?php echo $alt_tag_css_checkout_page_fornt; ?>>
                    <p><img src="<?php echo $wbm_checkout_page_stored_results_serialize_benner_src; ?>" class="checkout_banner_image" alt="<?php echo $alt_tag_value; ?>"></p>
                </a>
            </div>
            <?php
        }
    }

    /**
     * Function For display banner image in Thank you page
     *
     */
    public function wbm_show_thankyou_page_banner() {

        $wbm_thankyou_page_stored_results_serialize_benner_src = '';
        $wbm_thankyou_page_stored_results_serialize_benner_link = '';
        $wbm_thankyou_page_stored_results_serialize_benner_enable_status = '';
        $alt_tag_value = '';

        $wbm_thankyou_page_stored_results = get_option('wbm_thankyou_page_stored_data', '');

        if (isset($wbm_thankyou_page_stored_results) && !empty($wbm_thankyou_page_stored_results)) {
            $wbm_thankyou_page_stored_results_serialize = maybe_unserialize($wbm_thankyou_page_stored_results);
            if (!empty($wbm_thankyou_page_stored_results_serialize)) {
                $wbm_thankyou_page_stored_results_serialize_benner_src = !empty($wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_image_src']) ? $wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_image_src'] : '';
                $wbm_thankyou_page_stored_results_serialize_benner_link = !empty($wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_link_src']) ? $wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_link_src'] : '';
                $wbm_thankyou_page_stored_results_serialize_benner_enable_status = !empty($wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_enable_status']) ? $wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_enable_status'] : '';


                $wbm_thankyou_page_stored_results_serialize_benner_alt = array_reverse(explode('/', $wbm_thankyou_page_stored_results_serialize_benner_src));
                if (!empty($wbm_thankyou_page_stored_results_serialize_benner_src)) {
                    if (!empty($wbm_thankyou_page_stored_results_serialize_benner_alt)) {
                        $wbm_thankyou_page_stored_results_serialize_benner_alt_results = array_reverse(explode('.', $wbm_thankyou_page_stored_results_serialize_benner_src));
                        if (!empty($wbm_thankyou_page_stored_results_serialize_benner_alt_results)) {
                            $wbm_thankyou_page_stored_results_serialize_benner_alt_results = array_reverse(explode('/', $wbm_thankyou_page_stored_results_serialize_benner_alt_results[1]));
                            $alt_tag_value = $wbm_thankyou_page_stored_results_serialize_benner_alt_results[0];
                        }
                    }
                }
            }
        }

        if (!empty($wbm_thankyou_page_stored_results_serialize_benner_enable_status) && $wbm_thankyou_page_stored_results_serialize_benner_enable_status === 'on') {
            //print_r($wbm_shop_page_stored_results_serialize_benner_alt);
            ?>
            <div class="wbm_banner_image">
                <?php
                if ($wbm_thankyou_page_stored_results_serialize_benner_link == '') {
                    $alt_tag_css_thankyou_page_fornt = 'style="cursor:default"';
                } else {
                    $alt_tag_css_thankyou_page_fornt = 'style="cursor:pointer"href="' . $wbm_thankyou_page_stored_results_serialize_benner_link . '" target="_blank"';
                }
                ?>
                <a <?php echo $alt_tag_css_thankyou_page_fornt; ?>>
                    <p><img src="<?php echo $wbm_thankyou_page_stored_results_serialize_benner_src; ?>" class="checkout_banner_image" alt="<?php echo $alt_tag_value; ?>"></p>
                </a>
            </div>
            <?php
        }
    }

    public function wp_add_plugin_userfn_wbmfree() {
        $email_id = (isset($_POST["email_id"]) && !empty($_POST["email_id"])) ? $_POST["email_id"] : '';
        $log_url = $_SERVER['HTTP_HOST'];
        $cur_date = date('Y-m-d');
        $request_url = 'http://www.multidots.com/store/wp-content/themes/business-hub-child/API/wp-add-plugin-users.php';
        if (!empty($email_id)) {
            $request_response = wp_remote_post($request_url, array('method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'body' => array('user' => array('plugin_id' => '25', 'user_email' => $email_id, 'plugin_site' => $log_url, 'status' => 1, 'activation_date' => $cur_date)),
                'cookies' => array()));
            update_option('wbm_plugin_notice_shown', 'true');
        }
    }

    // function for welcome screen page 

    public function welcome_benner_mamagement_for_woocommerce_screen_do_activation_redirect() {

        if (!get_transient('_benner_management_for_woocommerce_welcome_screen')) {
            return;
        }

        // Delete the redirect transient
        delete_transient('_benner_management_for_woocommerce_welcome_screen');

        // if activating from network, or bulk
        if (is_network_admin() || isset($_GET['activate-multi'])) {
            return;
        }
        // Redirect to extra cost welcome  page
        wp_safe_redirect(add_query_arg(array('page' => 'wbm-get-started'), admin_url('admin.php')));
    }

    public function welcome_pages_screen_benner_mamagement_for_woocommerce() {
        add_dashboard_page(
            'Banner Management for WooCommerce Dashboard', 'Banner Management for WooCommerce Dashboard', 'read', 'banner-management-for-woocommerce', array($this, 'welcome_screen_content_banner_management_for_woocommerce'));
    }

    public function welcome_screen_benner_mamagement_for_woocommerce_remove_menus() {
        remove_submenu_page('index.php', 'banner-management-for-woocommerce');
        remove_submenu_page('dots_store', 'wbm-information');
        remove_submenu_page('dots_store', 'wbm-premium');
        remove_submenu_page('dots_store', 'wbm-add-new');
        remove_submenu_page('dots_store', 'wbm-edit-fee');
        remove_submenu_page('dots_store', 'wbm-get-started');
    }

    public function welcome_screen_content_banner_management_for_woocommerce() {
        global $wpdb, $woocommerce;
        $current_user = wp_get_current_user();
        if (!get_option('wbmfree_plugin_notice_shown')) {
            ?>
            <div id="wbm_dialog">
                <p><?php _e('Be the first to get latest updates and exclusive content straight to your email inbox.', WBN_FREE_PLUGIN_TEXT_DOMAIN); ?></p>
                <p><input type="text" id="txt_user_sub_wbm" class="regular-text" name="txt_user_sub_wbm" value="<?php echo $current_user->user_email; ?>"></p>
            </div>
        <?php } ?>

        <div class="wrap about-wrap">
            <h1 style="font-size: 2.1em;"><?php printf(__('Welcome to Banner Management for WooCommerce', 'banner-management-for-woocommerce')); ?></h1>

            <div class="about-text woocommerce-about-text">
                <?php
                $message = '';
                printf(__('%s With this plugin, You can easily add banner in WooCommerce stores and you can upload the banner specific for page,category and welcome page.', 'banner-management-for-woocommerce'), $message);
                ?>
                <img class="version_logo_img" src="<?php echo plugin_dir_url(__FILE__) . 'images/banner-management-for-woocommerce.png'; ?>">
            </div>

            <?php
            $setting_tabs_wc = apply_filters('banner_management_for_woocommerce_setting_tab', array("about" => "Overview", "other_plugins" => "Checkout our other plugins", "premium_feauter" => "Premium Feature"));
            $current_tab_wc = (isset($_GET['tab'])) ? $_GET['tab'] : 'general';
            $aboutpage = isset($_GET['page'])
            ?>
            <h2 id="woo-extra-cost-tab-wrapper" class="nav-tab-wrapper">
                <?php
                foreach ($setting_tabs_wc as $name => $label)
                    echo '<a  href="' . home_url('wp-admin/index.php?page=banner-management-for-woocommerce&tab=' . $name) . '" class="nav-tab ' . ( $current_tab_wc == $name ? 'nav-tab-active' : '' ) . '">' . $label . '</a>';
                ?>
            </h2>
            <?php
            foreach ($setting_tabs_wc as $setting_tabkey_wc => $setting_tabvalue) {
                switch ($setting_tabkey_wc) {
                    case $current_tab_wc:
                        do_action('benner_mamagement_for_woocommerce_' . $current_tab_wc);
                        break;
                }
            }
            ?>
            <hr />
            <div class="return-to-dashboard">
                <a href="<?php echo home_url('/wp-admin/admin.php?page=banner-setting'); ?>"><?php _e('Go to Banner Management for WooCommerce Settings', 'banner-management-for-woocommerce'); ?></a>
            </div>
        </div>

        <?php
    }

    // function for welcome page about us tag content 

    public function benner_mamagement_for_woocommerce_about() {
        ?>
        <div class="changelog">
            </br>
            <style type="text/css">
                p.banner_management_for_woocommerce_overview {max-width: 100% !important;margin-left: auto;margin-right: auto;font-size: 15px;line-height: 1.5;}.banner_management_for_woocommerce_content_ul ul li {margin-left: 3%;list-style: initial;line-height: 23px;}
            </style>
            <div class="changelog about-integrations">
                <div class="wc-feature feature-section col three-col">
                    <div>
                        <p class="banner_management_for_woocommerce_overview"><?php _e('Banner Management for WooCommerce plugin that allows you to manage page and category wise banners in your WooCommerce store.You can easily add banner in WooCommerce stores and you can upload the banner specific for page and category.', 'banner-management-for-woocommerce'); ?></p>
                    </div>
                    <p class="banner_management_for_woocommerce_overview"><strong>Plugin Functionality:</strong></p>
                    <div class="banner_management_for_woocommerce_content_ul">
                        <ul>
                            <li>Easy to use</li>
                            <li>Enable and disable banner for particular page, category</li>
                            <li>you can Manage "Page Specific Banner"  and  "Category Specific Banner"</li>
                            <li>Add Banner for Shop Page</li>
                            <li>Add Banner for Cart Page</li>
                            <li>Add Banner for Checkout Page</li>
                            <li>Add Banner for Thank you page</li>
                            <li>you can add Banner URL/LINK for a particular banner</li>
                            <li>Fully tested with latest version of WooCommerce</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <?php
    }

    public function benner_mamagement_for_woocommerce_other_plugins() {
        global $wpdb;
        $url = 'http://www.multidots.com/store/wp-content/themes/business-hub-child/API/checkout_other_plugin.php';
        $response = wp_remote_post($url, array('method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => array(),
            'body' => array('plugin' => 'advance-flat-rate-shipping-method-for-woocommerce'),
            'cookies' => array()));

        $response_new = array();
        $response_new = json_decode($response['body']);
        $get_other_plugin = maybe_unserialize($response_new);

        $paid_arr = array();
        ?>

        <div class="plug-containter">
            <div class="paid_plugin">
                <h3>Paid Plugins</h3>
                <?php
                foreach ($get_other_plugin as $key => $val) {
                    if ($val['plugindesc'] == 'paid') {
                        ?>


                        <div class="contain-section">
                            <div class="contain-img"><img src="<?php echo $val['pluginimage']; ?>"></div>
                            <div class="contain-title"><a target="_blank" href="<?php echo $val['pluginurl']; ?>"><?php echo $key; ?></a></div>
                        </div>


                        <?php
                    } else {

                        $paid_arry[$key]['plugindesc'] = $val['plugindesc'];
                        $paid_arry[$key]['pluginimage'] = $val['pluginimage'];
                        $paid_arry[$key]['pluginurl'] = $val['pluginurl'];
                        $paid_arry[$key]['pluginname'] = $val['pluginname'];
                        ?>


                        <?php
                    }
                }
                ?>
            </div>
            <?php if (isset($paid_arry) && !empty($paid_arry)) { ?>
            <div class="free_plugin">
                <h3>Free Plugins</h3>
                <?php foreach ($paid_arry as $key => $val) { ?>
                    <div class="contain-section">
                        <div class="contain-img"><img src="<?php echo $val['pluginimage']; ?>"></div>
                        <div class="contain-title"><a target="_blank" href="<?php echo $val['pluginurl']; ?>"><?php echo $key; ?></a></div>
                    </div>
                    <?php
                }
                }
                ?>
            </div>

        </div>

        <?php
    }

    public function benner_mamagement_for_woocommerce_premium_feauter() {
        ?>

        <div class="changelog">
            </br>
            <style type="text/css">
                p.banner_management_for_woocommerce_overview {max-width: 100% !important;margin-left: auto;margin-right: auto;font-size: 15px;line-height: 1.5;}.banner_management_for_woocommerce_content_ul ul li {margin-left: 3%;list-style: initial;line-height: 23px;}.other_feature {margin-top: 3%;}
            </style>
            <div class="changelog about-integrations">
                <div class="wc-feature feature-section col three-col">
                    <div>
                        <p class="banner_management_for_woocommerce_overview"><strong>Woocommerce Category Banner Management </strong></p>
                        <p class="banner_management_for_woocommerce_overview">Need even more? upgrade to <a href="https://codecanyon.net/item/woocommerce-category-banner-management/17623205?s_rank=1" rel="nofollow">Woocommerce Category Banner Management</a> and get all the features available in Woocommerce Category Banner Management</p>

                        <p class="banner_management_for_woocommerce_overview">Woocommerce Category Banner Management plugin that allows you to manage page and category wise banners in your WooCommerce store.You can easily add single banner and Multiple banner for page and category in WooCommerce stores.</p>

                        <p class="banner_management_for_woocommerce_overview"><strong>Key Features of >Woocommerce Category Banner Management: </strong></p>

                        <p></p>

                        <div class="banner_management_for_woocommerce_picture_entry_content">
                            <div class="banner_management_for_woocommerce_picture">
                                <div class="picture-content"><img src="https://store.multidots.com/wp-content/uploads/2016/08/01-640x427.png"></div>
                            </div>
                            <div class="banner_management_for_woocommerce_content">
                                <h3 class="h4 cactus-post-title entry-title">Manage Page Specific Banner</h3>
                                <div class="excerpt">

                                    <div>
                                        Using this feature you can add a single and multiple banners and assigned to a specific page and category of your WooCommerce store. Like,
                                    </div>

                                    <div class="banner_management_for_woocommerce_content_ul">
                                        <ul>
                                            <li>Banner for Shop page</li>
                                            <li>Banner for Cart page</li>
                                            <li>Banner for Checkout page</li>
                                            <li>Banner for Thank you page</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                            <div class="cactus-last-child"></div>
                        </div>


                        <div class="banner_management_for_woocommerce_picture_entry_content">
                            <div class="banner_management_for_woocommerce_picture_fourth">
                                <div class="picture-content"><img src="https://store.multidots.com/wp-content/uploads/2016/08/02-640x427.png"></div>
                            </div>
                            <div class="banner_management_for_woocommerce_content_fourth">
                                <h3 class="h4 cactus-post-title entry-title">Add single Banner for specific page</h3>
                                <div class="excerpt">

                                    <div>
                                        Allows you to add a single banner image to a specific page of the website.You can configure banner for particular time periods and add custom link of that banner also.
                                    </div>

                                </div>
                            </div>

                            <div class="cactus-last-child"></div>

                        </div>

                        <div class="banner_management_for_woocommerce_picture_entry_content">
                            <div class="banner_management_for_woocommerce_picture">
                                <div class="picture-content"><img src="https://store.multidots.com/wp-content/uploads/2016/08/03-640x427.png"></div>
                            </div>
                            <div class="banner_management_for_woocommerce_content third_section">
                                <h3 class="h4 cactus-post-title entry-title">Add Multiple Banner for specific page</h3>
                                <div class="excerpt">

                                    <div>
                                        Allows you to add a Multiple banner image to a specific page of the website. you can configure banner for particular time periods and add custom link of that banner.
                                    </div>
                                </div>
                            </div>

                            <div class="cactus-last-child"></div>

                        </div>

                        <div class="banner_management_for_woocommerce_picture_entry_content">

                            <div class="banner_management_for_woocommerce_content_fourth">
                                <h3 class="h4 cactus-post-title entry-title">Display Random and Slider Banner for specific page and category</h3>
                                <div class="excerpt">

                                    <div>
                                        Displays the Random banners that you specify by the order of their position every time the page is refreshed.Also plugin allows you to display simple image slider with enable/ disable navigation option and assigned to a specific page and category of your WooCommerce store
                                    </div>
                                </div>
                            </div>
                            <div class="banner_management_for_woocommerce_picture_fourth">
                                <div class="picture-content"><img src="https://store.multidots.com/wp-content/uploads/2016/08/12Multiple-Randon-banner--640x427.png"></div>
                            </div>
                            <div class="cactus-last-child"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    // function for admin notice print 

    public function benner_mamagement_for_woocommerce_pointers_footer() {
        $admin_pointers = benner_mamagement_for_woocommerce_admin_pointers();
        ?>
        <script type="text/javascript">
            /* <![CDATA[ */
            (function($) {
                <?php
                foreach ($admin_pointers as $pointer => $array) {
                if ($array['active']) {
                ?>
                $('<?php echo $array['anchor_id']; ?>').pointer({
                    content: '<?php echo $array['content']; ?>',
                    position: {
                        edge: '<?php echo $array['edge']; ?>',
                        align: '<?php echo $array['align']; ?>'
                    },
                    close: function() {
                        $.post(ajaxurl, {
                            pointer: '<?php echo $pointer; ?>',
                            action: 'dismiss-wp-pointer'
                        });
                    }
                }).pointer('open');
                <?php
                }
                }
                ?>
            })(jQuery);
            /* ]]> */
        </script>
        <?php
    }

}

function benner_mamagement_for_woocommerce_admin_pointers() {

    $dismissed = explode(',', (string) get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true));
    $version = '1_0'; // replace all periods in 1.0 with an underscore
    $prefix = 'benner_mamagement_for_woocommerce_admin_pointers' . $version . '_';

    $new_pointer_content = '<h3>' . __('Welcome to Banner Management for WooCommerce') . '</h3>';
    $new_pointer_content .= '<p>' . __('With this plugin, You can easily add banner in WooCommerce stores and you can upload the banner specific for page,category and welcome page.') . '</p>';

    return array(
        $prefix . 'benner_mamagement_for_woocommerce_admin_pointers' => array(
            'content' => $new_pointer_content,
            'anchor_id' => '#toplevel_page_woocommerce',
            'edge' => 'left',
            'align' => 'left',
            'active' => (!in_array($prefix . 'benner_mamagement_for_woocommerce_admin_pointers', $dismissed) )
        )
    );
}
