<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
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
        <h2><?php _e('Quick info', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></h2>
        <table class="table-outer">
            <tbody>
            <tr>
                <td class="fr-1"><?php _e('Product Type', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></td>
                <td class="fr-2"><?php _e('WooCommerce Plugin', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></td>
            </tr>
            <tr>
                <td class="fr-1"><?php _e('Product Name', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></td>
                <td class="fr-2"><?php _e($plugin_name, WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></td>
            </tr>
            <tr>
                <td class="fr-1"><?php _e('Installed Version', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></td>
                <td class="fr-2"><?php _e('Free Version', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?> <?php echo $plugin_version; ?></td>
            </tr>
            <tr>
                <td class="fr-1"><?php _e('License & Terms of use', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></td>
                <td class="fr-2"><a target="_blank"  href="http://t.signauxdeux.com/e1t/c/5/f18dQhb0SmZ58dDMPbW2n0x6l2B9nMJW7sM9dn7dK_MMdBzM2-04?t=https%3A%2F%2Fstore.multidots.com%2Fterms-conditions%2F&si=4973901068632064&pi=61378fda-f5e5-4125-c521-28a4597b13d6">
                        <?php _e('Click here', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a>
                    <?php _e('to view license and terms of use.', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?>
                </td>
            </tr>
            <tr>
                <td class="fr-1"><?php _e('Help & Support', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></td>
                <td class="fr-2 wbm-information">
                    <ul>
                        <li><a target="_blank" href="<?php echo site_url('wp-admin/admin.php?page=wbm-get-started'); ?>"><?php _e('Quick Start', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a></li>
                        <li><a target="_blank" href="https://store.multidots.com/wp-content/uploads/2017/02/Banner-Management-for-WooCommerce-help-document-.pdf"><?php _e('Guide Documentation', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a></li>
                        <li><a target="_blank" href="http://t.signauxdeux.com/e1t/c/5/f18dQhb0SmZ58dDMPbW2n0x6l2B9nMJW7sM9dn7dK_MMdBzM2-04?t=https%3A%2F%2Fstore.multidots.com%2Fdotstore-support-panel%2F&si=4973901068632064&pi=61378fda-f5e5-4125-c521-28a4597b13d6"><?php _e('Support Forum', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></a></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="fr-1"><?php _e('Localization', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></td>
                <td class="fr-2"><?php _e('English', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?>, <?php _e('Spanish', WOO_BANNER_MANAGEMENT_TEXT_DOMAIN); ?></td>
            </tr>

            </tbody>
        </table>
    </div>
<?php require_once('header/plugin-sidebar.php'); ?>