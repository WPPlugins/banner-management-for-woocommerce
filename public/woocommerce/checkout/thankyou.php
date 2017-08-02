<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="woocommerce-order">
    <?php
    if ($order) :
        ?>

        <?php if ($order->has_status('failed')) : ?>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php _e('Pay', 'woocommerce') ?></a>
                <?php if (is_user_logged_in()) : ?>
                    <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php _e('My account', 'woocommerce'); ?></a>
                <?php endif; ?>
            </p>

        <?php else : ?>
            <?php
            $wbm_thankyou_page_stored_results_serialize_benner_src = '';
            $wbm_thankyou_page_stored_results_serialize_benner_link = '';
            $wbm_thankyou_page_stored_results_serialize_benner_enable_status = '';
            $wbm_thankyou_page_stored_results_serialize_benner_open_new_tab = '';
            $alt_tag_value = '';

            $wbm_thankyou_page_stored_results = get_option('wbm_thankyou_page_stored_data', '');

            if (isset($wbm_thankyou_page_stored_results) && !empty($wbm_thankyou_page_stored_results)) {
                $wbm_thankyou_page_stored_results_serialize = maybe_unserialize($wbm_thankyou_page_stored_results);
                if (!empty($wbm_thankyou_page_stored_results_serialize)) {
                    $wbm_thankyou_page_stored_results_serialize_benner_src = !empty($wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_image_src']) ? $wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_image_src'] : '';
                    $wbm_thankyou_page_stored_results_serialize_benner_link = !empty($wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_link_src']) ? $wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_link_src'] : '';
                    $wbm_thankyou_page_stored_results_serialize_benner_enable_status = !empty($wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_enable_status']) ? $wbm_thankyou_page_stored_results_serialize['thankyou_page_banner_enable_status'] : '';
                    $wbm_thankyou_page_stored_results_serialize_benner_open_new_tab = !empty($wbm_thankyou_page_stored_results_serialize['thankyou_page_benner_open_new_tab']) ? $wbm_thankyou_page_stored_results_serialize['thankyou_page_benner_open_new_tab'] : '';

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
            if (!empty($wbm_thankyou_page_stored_results_serialize_benner_open_new_tab) && $wbm_thankyou_page_stored_results_serialize_benner_open_new_tab === 'open') {

                $test = "_blank";
            } else {
                $test = "_self";
            }
            if (!empty($wbm_thankyou_page_stored_results_serialize_benner_enable_status) && $wbm_thankyou_page_stored_results_serialize_benner_enable_status === 'on') {
                ?>

                <div class="wbm_banner_image">
                    <a href="<?php echo $wbm_thankyou_page_stored_results_serialize_benner_link ?>" target="<?php echo $test; ?>">
                        <p><img src="<?php echo $wbm_thankyou_page_stored_results_serialize_benner_src; ?>" class="checkout_banner_image" alt="<?php echo $alt_tag_value; ?>"></p> 
                    </a>
                </div>	
            <?php }
            ?><p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', __('Thank you. Your order has been received.', 'woocommerce'), $order); ?></p>

            <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                <li class="woocommerce-order-overview__order order">
                    <?php _e('Order number:', 'woocommerce'); ?>
                    <strong><?php echo $order->get_order_number(); ?></strong>
                </li>

                <li class="woocommerce-order-overview__date date">
                    <?php _e('Date:', 'woocommerce'); ?>
                    <strong><?php echo wc_format_datetime($order->get_date_created()); ?></strong>
                </li>

                <li class="woocommerce-order-overview__total total">
                    <?php _e('Total:', 'woocommerce'); ?>
                    <strong><?php echo $order->get_formatted_order_total(); ?></strong>
                </li>

                <?php if ($order->get_payment_method_title()) : ?>

                    <li class="woocommerce-order-overview__payment-method method">
                        <?php _e('Payment method:', 'woocommerce'); ?>
                        <strong><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong>
                    </li>

                <?php endif; ?>

            </ul>

        <?php endif; ?>

        <?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
        <?php do_action('woocommerce_thankyou', $order->get_id()); ?>

    <?php else : ?>

        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', __('Thank you. Your order has been received.', 'woocommerce'), null); ?></p>

    <?php endif; ?>

</div>
