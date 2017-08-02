<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
$plugin_name = WOO_BANNER_MANAGEMENT_PLUGIN_NAME;
$plugin_version = WBM_PLUGIN_VERSION;
?>
<div id="dotsstoremain">
    <div class="all-pad">
        <header class="dots-header">
            <div class="dots-logo-main">
                <img  src="<?php echo WBM_PLUGIN_URL . 'admin/images/banner-management-for-woocommerce.png'; ?>">
            </div>
            <div class="dots-header-right">
                <div class="logo-detail">
                    <strong><?php _e($plugin_name, WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?> </strong>
                    <span>Free Version <?php echo $plugin_version; ?> </span>
                </div>
                <div class="button-dots">
                    <span class=""><a  target = "_blank" href="https://store.multidots.com/woocommerce-category-banner-management/" >
                            <img src="<?php echo WBM_PLUGIN_URL . 'admin/images/upgrade_new.png'; ?>"></a>
                    </span>
                    <span class="support_dotstore_image"><a  target = "_blank" href="https://store.multidots.com/dotstore-support-panel/" >
                            <img src="<?php echo WBM_PLUGIN_URL . 'admin/images/support_new.png'; ?>"></a>
                    </span>
                </div>
            </div>

            <?php
            $fee_getting_started ='';
            $fee_list = isset($_GET['page']) && $_GET['page'] == 'banner-setting' ? 'active' : '';
            $fee_add = isset($_GET['page']) && $_GET['page'] == 'wbm-add-new' ? 'active' : '';
            //            $fee_getting_started = isset($_GET['page']) && $_GET['page'] == 'wcpfc-get-started' ? 'active' : '';
            if (!empty($_GET['page']) && ($_GET['page'] == 'wbm-get-started')) {
                $fee_getting_started = 'active';

            }
//            $premium_version = isset($_GET['page']) && $_GET['page'] == 'wbm-premium' ? 'active' : '';
            $fee_information = isset($_GET['page']) && $_GET['page'] == 'wbm-information' ? 'active' : '';

            if (isset($_GET['page']) && $_GET['page'] == 'wbm-information' || isset($_GET['page']) && $_GET['page'] == 'wbm-get-started') {
                $fee_about = 'active';
            } else {
                $fee_about = '';
            }
            if (!empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'add' || $_REQUEST['action'] == 'edit') {
                    $fee_add = 'active';
                }
            }
            ?>
            <div class="dots-menu-main">
                <nav>
                    <ul>
                        <li>
                            <a class="dotstore_plugin <?php echo $fee_list; ?>"  href="<?php echo home_url('/wp-admin/admin.php?page=banner-setting'); ?>"><?php _e('Settings', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a>
                        </li>
                        <li>
                            <a class="dotstore_plugin <?php echo $fee_about; ?>"  href="<?php echo home_url('/wp-admin/admin.php?page=wbm-get-started'); ?>"><?php _e('About Plugin', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a>
                            <ul class="sub-menu">
                                <li><a  class="dotstore_plugin <?php echo $fee_getting_started; ?>" href="<?php echo home_url('/wp-admin/admin.php?page=wbm-get-started'); ?>"><?php _e('Getting Started', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a></li>
                                <li><a class="dotstore_plugin <?php echo $fee_information; ?>" href="<?php echo home_url('/wp-admin/admin.php?page=wbm-information'); ?>"><?php _e('Quick info', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="dotstore_plugin"  href="#"><?php _e('Dotstore', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a>
                            <ul class="sub-menu">
                                <li><a target="_blank" href="https://store.multidots.com/go/flatrate-pro-new-interface-woo-plugins"><?php _e('WooCommerce Plugins', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a></li>
                                <li><a target="_blank" href="https://store.multidots.com/go/flatrate-pro-new-interface-wp-plugins"><?php _e('Wordpress Plugins', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a></li><br>
                                <li><a target="_blank" href="https://store.multidots.com/go/flatrate-pro-new-interface-wp-free-plugins"><?php _e('Free Plugins', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a></li>
                                <li><a target="_blank" href="https://store.multidots.com/go/flatrate-pro-new-interface-free-theme"><?php _e('Free Themes', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a></li>
                                <li><a target="_blank" href="https://store.multidots.com/go/flatrate-pro-new-interface-dotstore-support"><?php _e('Contact Support', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>