<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

require_once('header/plugin-header.php');
global $wpdb;
$current_user = wp_get_current_user();
if (!get_option('wbmfree_plugin_notice_shown')) {
    ?>
    <div id="wbm_dialog">
        <p><?php _e('Be the first to get latest updates and exclusive content straight to your email inbox.', WBN_FREE_PLUGIN_TEXT_DOMAIN); ?></p>
        <p><input type="text" id="txt_user_sub_wbm" class="regular-text" name="txt_user_sub_wbm" value="<?php echo $current_user->user_email; ?>"></p>
    </div>
<?php } ?>

    <div class="wbm-main-table res-cl">
        <h2><?php _e('Thanks For Installing '.WOO_BANNER_MANAGEMENT_PLUGIN_NAME, WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></h2>
        <table class="table-outer">
            <tbody>
            <tr>
                <td class="fr-2">
                    <p class="block gettingstarted"><strong><?php _e('Getting Started', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?> </strong></p>
                    <p class="block textgetting">
                        <?php _e('Banner Management for WooCommerce plugin that allows you to manage page and category wise banners in your WooCommerce store.You can easily add banner in WooCommerce stores and you can upload the banner specific for page and category. You can easily add banner in WooCommerce stores and you can upload the banner specific for page,category and welcome page.', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?>
                    </p>
                    <p class="block textgetting">
                        <?php _e('Add banner to shop page.', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?>
                        <span class="gettingstarted">
                            <img src="<?php echo WBM_PLUGIN_URL . 'admin/images/Getting_Started_01.png'; ?>">
                        </span>
                    </p>
                    <p class="block textgetting">
                        <?php _e('Add banner to cart page.', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?>
                        <span class="gettingstarted">
                            <img src="<?php echo WBM_PLUGIN_URL . 'admin/images/Getting_Started_02.png'; ?>">
                        </span>
                    </p>
                    <p class="block textgetting">
                        <?php _e('Add banner to checkout page.', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?>
                        <span class="gettingstarted">
                            <img src="<?php echo WBM_PLUGIN_URL . 'admin/images/Getting_Started_03.png'; ?>">
                        </span>
                    </p>
                    <p class="block textgetting">
                        <?php _e('Add banner to thank you page.', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?>
                        <span class="gettingstarted">
                            <img src="<?php echo WBM_PLUGIN_URL . 'admin/images/Getting_Started_04.png'; ?>">
                        </span>
                    </p>
                    <p class="block textgetting">
                        <?php _e('Add banner to category page.', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?>
                        <span class="gettingstarted">
                            <img src="<?php echo WBM_PLUGIN_URL . 'admin/images/Getting_Started_05.png'; ?>">
                        </span>
                    </p>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
<?php require_once('header/plugin-sidebar.php'); ?>