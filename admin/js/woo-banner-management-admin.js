(function($) {
    $(window).load(function() {
        $('body').on('click', '#wbm_shop_setting_enable', function() {
            var ele = $(this).find(':checkbox');

            var checked = $('input[id="wbm_shop_setting_enable"][type="checkbox"]:checked').val();
            var checked1 = $('input[id="wbm_shop_open_new_tab"][type="checkbox"]:checked').val();


            if (checked == 'on') {
                $('.wbm_shop_page_enable_open_div').css('display', 'block');
            } else {
                $('.wbm_shop_page_enable_open_div').css('display', 'none');
            }

        });
        //script for cart page setting script
        $('body').on('click', '#wbm_shop_setting_cart_enable', function() {
            var checked = $('input[id="wbm_shop_setting_cart_enable"][type="checkbox"]:checked').val();
            var checked1 = $('input[id="wbm_cart_open_new_tab"][type="checkbox"]:checked').val();
            var ele = $(this).find(':checkbox');
            if (checked == 'on') {
                $('.wbm-cart-upload-image-html').css('display', 'block');
            } else {
                $('.wbm-cart-upload-image-html').css('display', 'none');
            }
        });
        //script for check out page setting script 
        $('body').on('click', '#wbm_shop_setting_checkout_enable', function() {
            var checked = $('input[id="wbm_shop_setting_checkout_enable"][type="checkbox"]:checked').val();
            var checked1 = $('input[id="wbm_checkout_open_new_tab"][type="checkbox"]:checked').val();
            var ele = $(this).find(':checkbox');
            if (checked == 'on') {
                $('.wbm-checkout-upload-image-html').css('display', 'block');
            } else {
                $('.wbm-checkout-upload-image-html').css('display', 'none');
            }
        });
        //script for tahnk you page
        $('body').on('click', '#wbm_shop_setting_thank_you_page_enable', function() {
            var checked = $('input[id="wbm_shop_setting_thank_you_page_enable"][type="checkbox"]:checked').val();
            var checked1 = $('input[id="wbm_thankyou_open_new_tab"][type="checkbox"]:checked').val();
            var ele = $(this).find(':checkbox');
            if (checked == 'on') {
                $('.wbm-thank-you-page-upload-image-html').css('display', 'block');
                $('.shop_page_status_enable_or_disable').css('color', 'green');
            } else {
                $('.wbm-thank-you-page-upload-image-html').css('display', 'none');
            }
        });
        //script for save the setting data	
        $('body').on('click', '#save_wbm_shop_page_setting', function() {
            //get the value by shop page setting section
            var shop_page_banner_image_results = '';
            var shop_page_banner_link_results = '';
            var shop_page_banner_enable_or_not_results = '';
            var shop_page_benner_open_new_tab_results = '';

            var shop_page_banner_image = $('.wbm_shop_page_cat_banner_img_admin').attr('src');
            if (shop_page_banner_image != '') {
                shop_page_banner_image_results = shop_page_banner_image;
            }
            var shop_page_banner_link = $('#shop_page_banner_image_link').val();
            if (shop_page_banner_link != '') {
                shop_page_banner_link_results = shop_page_banner_link;
            }
            var shop_page_banner_enable_or_not = $('input[id="wbm_shop_setting_enable"][type="checkbox"]:checked').val();
            var shop_page_benner_open_new_tab = $('input[id="wbm_shop_open_new_tab"][type="checkbox"]:checked').val();
          
            if (shop_page_banner_enable_or_not != '') {
                shop_page_banner_enable_or_not_results = shop_page_banner_enable_or_not;
            }

            if (shop_page_benner_open_new_tab != '') {
                shop_page_benner_open_new_tab_results = shop_page_benner_open_new_tab;
            }
            if (shop_page_banner_enable_or_not === 'on') {
                $('span#shop_page_status_enable_or_disable').html('');
                $('span.Preview_link_for_shop_page').html('');
                var shop_page_url = $('#shop_page_hidden_url').val();
                var shop_page_content = '<strong>Preview:</strong> <a href="' + shop_page_url + '">Click here</a>';
                $('span.Preview_link_for_shop_page').html(shop_page_content);
                $('span#shop_page_status_enable_or_disable').html('( Enable )');
                $('span#shop_page_status_enable_or_disable').css('color', 'green');
            } else {
                $('span.Preview_link_for_shop_page').html('');
                $('span#shop_page_status_enable_or_disable').html('');
                $('span#shop_page_status_enable_or_disable').html('( Disable )');
                $('span#shop_page_status_enable_or_disable').css('color', 'red');
            }
            //get the value by cart setting section 
            var cart_page_banner_image_results = '';
            var cart_page_banner_link_results = '';
            var cart_page_banner_enable_or_not_results = '';
            var cart_page_benner_open_new_tab_results = '';

            var cart_page_banner_image = $('.wbm_cart_page_cat_banner_img_admin').attr('src');
            if (cart_page_banner_image != '') {
                cart_page_banner_image_results = cart_page_banner_image;
            }
            var cart_page_banner_link = $('#shop_cart_banner_image_link').val();
            if (cart_page_banner_link != '') {
                cart_page_banner_link_results = cart_page_banner_link;
            }
            var cart_page_banner_enable_or_not = $('input[id="wbm_shop_setting_cart_enable"][type="checkbox"]:checked').val();
            var cart_page_benner_open_new_tab = $('input[id="wbm_cart_open_new_tab"][type="checkbox"]:checked').val();
            if (cart_page_banner_enable_or_not != '') {
                cart_page_banner_enable_or_not_results = cart_page_banner_enable_or_not;
            }
            if (cart_page_benner_open_new_tab != '') {
                cart_page_benner_open_new_tab_results = cart_page_benner_open_new_tab;
            }
            if (cart_page_banner_enable_or_not === 'on') {

                $('span.Preview_link_for_cart_page').html('');
                var cart_url = $('#cart_page_hidden_url').val();
                var cart_preview_content = '<strong>Preview:</strong> <a href="' + cart_url + '">Click here</a>';
                $('span.Preview_link_for_cart_page').html(cart_preview_content);
                $('span#cart_page_status_enable_or_disable').html('');
                $('span#cart_page_status_enable_or_disable').html('( Enable )');
                $('span#cart_page_status_enable_or_disable').css('color', 'green');
            } else {
                $('span#cart_page_status_enable_or_disable').html('');
                $('span.Preview_link_for_cart_page').html('');
                $('span#cart_page_status_enable_or_disable').html('( Disable )');
                $('span#cart_page_status_enable_or_disable').css('color', 'red');
            }
            //get the value by cart setting section 
            var checkout_page_banner_image_results = '';
            var checkout_page_banner_link_results = '';
            var checkout_page_banner_enable_or_not_results = '';
            var checkout_page_benner_open_new_tab_results = '';

            var checkout_page_banner_image = $('.wbm_checkout_page_banner_img_admin').attr('src');
            if (checkout_page_banner_image != '') {
                checkout_page_banner_image_results = checkout_page_banner_image;
            }
            var checkout_page_banner_link = $('#shop_checkout_banner_image_link').val();
            if (checkout_page_banner_link != '') {
                checkout_page_banner_link_results = checkout_page_banner_link;
            }
            var checkout_page_banner_enable_or_not = $('input[id="wbm_shop_setting_checkout_enable"][type="checkbox"]:checked').val();

            var checkout_page_benner_open_new_tab = $('input[id="wbm_checkout_open_new_tab"][type="checkbox"]:checked').val();
            if (checkout_page_banner_enable_or_not != '') {
                checkout_page_banner_enable_or_not_results = checkout_page_banner_enable_or_not;
            }
            if (checkout_page_benner_open_new_tab != '') {
                checkout_page_benner_open_new_tab_results = checkout_page_benner_open_new_tab;
            }

            if (checkout_page_banner_enable_or_not === 'on') {

                $('.span.Preview_link_for_checkout_page').html('');
                var url = $('#checkout_page_hidden_url').val();
                var checkoutcontent = '<strong>Preview:</strong> <a href="' + url + '">Click here</a>';
                $('span.Preview_link_for_checkout_page').html(checkoutcontent);
                $('span#checkout_page_status_enable_or_disable').html('');
                $('span#checkout_page_status_enable_or_disable').html('( Enable )');
                $('span#checkout_page_status_enable_or_disable').css('color', 'green');
            } else {
                $('span#checkout_page_status_enable_or_disable').html('');

                $('span.Preview_link_for_checkout_page').html('');
                $('span#checkout_page_status_enable_or_disable').html('( Disable )');
                $('span#checkout_page_status_enable_or_disable').css('color', 'red');
            }

            //get the value by cart setting section 
            var thankyou_page_banner_image_results = '';
            var thankyou_page_banner_link_results = '';
            var thankyou_page_banner_enable_or_not_results = '';
            var thankyou_page_benner_open_new_tab_results = '';

            var thankyou_page_banner_image = $('.wbm_thank_you_page_banner_img_admin').attr('src');
            if (thankyou_page_banner_image != '') {
                thankyou_page_banner_image_results = thankyou_page_banner_image;
            }
            var thankyou_page_banner_link = $('#shop_thank_you_page_banner_image_link').val();
           
            if (thankyou_page_banner_link != '') {
                thankyou_page_banner_link_results = thankyou_page_banner_link;
            }
            var thankyou_page_banner_enable_or_not = $('input[id="wbm_shop_setting_thank_you_page_enable"][type="checkbox"]:checked').val();
            var thankyou_page_benner_open_new_tab = $('input[id="wbm_thankyou_open_new_tab"][type="checkbox"]:checked').val();
            
            if (thankyou_page_banner_enable_or_not != '') {
                thankyou_page_banner_enable_or_not_results = thankyou_page_banner_enable_or_not;
            }
            if (thankyou_page_benner_open_new_tab != '') {
                thankyou_page_benner_open_new_tab_results = thankyou_page_benner_open_new_tab;
            }
            if (thankyou_page_banner_enable_or_not === 'on') {
                $('span#thankyou_page_status_enable_or_disable').html('');
                $('span#thankyou_page_status_enable_or_disable').html('( Enable )');
                $('span#thankyou_page_status_enable_or_disable').css('color', 'green');
            } else {
                $('span#thankyou_page_status_enable_or_disable').html('');
                $('span#thankyou_page_status_enable_or_disable').html('( Disable )');
                $('span#thankyou_page_status_enable_or_disable').css('color', 'red');
            }

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: ({
                    action: 'wbm_save_shop_page_banner_data',
                    shop_page_banner_image_results: shop_page_banner_image_results,
                    shop_page_banner_link_results: shop_page_banner_link_results,
                    shop_page_banner_enable_or_not_results: shop_page_banner_enable_or_not_results,
                    shop_page_benner_open_new_tab_results: shop_page_benner_open_new_tab_results,
                    cart_page_banner_image_results: cart_page_banner_image_results,
                    cart_page_banner_link_results: cart_page_banner_link_results,
                    cart_page_banner_enable_or_not_results: cart_page_banner_enable_or_not_results,
                    cart_page_benner_open_new_tab_results: cart_page_benner_open_new_tab_results,
                    checkout_page_banner_image_results: checkout_page_banner_image_results,
                    checkout_page_banner_link_results: checkout_page_banner_link_results,
                    checkout_page_banner_enable_or_not_results: checkout_page_banner_enable_or_not_results,
                    checkout_page_benner_open_new_tab_results: checkout_page_benner_open_new_tab_results,
                    thankyou_page_banner_image_results: thankyou_page_banner_image_results,
                    thankyou_page_banner_link_results: thankyou_page_banner_link_results,
                    thankyou_page_banner_enable_or_not_results: thankyou_page_banner_enable_or_not_results,
                    thankyou_page_benner_open_new_tab_results: thankyou_page_benner_open_new_tab_results

                }),
                success: function(response) {
                    setTimeout(function() { alert("Setting saved."); }, 500);
                    $('#succesful_message_wbm').css('display', 'block');
                    $('#succesful_message_wbm').delay(2000).fadeOut('slow');
                }
            });


        });

        //accrodian jquery script 

        jQuery('.custom-accordian .aco-title').click(function() {
            jQuery(this).siblings().slideToggle(400);
            jQuery(this).toggleClass('open');
        });

        function close_accordion_section() {
            jQuery('.accordion .accordion-section-title').removeClass('active');
            jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
        }
        function close_accordion_preview_section() {
            jQuery('.accordion_preview .accordion_preview-section-title').removeClass('active');
            jQuery('.accordion_preview .accordion_preview-section-content').slideUp(300).removeClass('open');
        }
        //function for crea setting form 
        function creae_setting_close_accordion_section() {
            jQuery('.accordion-crea-setting .accordion-crea-setting-sections-titles').removeClass('active');
            jQuery('.accordion-crea-setting .accordion-section-content').slideUp(300).removeClass('open');
        }

        jQuery('.accordion-section-title').click(function(e) {
            // Grab current anchor value
            var currentAttrValue = jQuery(this).attr('href');

            if (jQuery(e.target).is('.active')) {
                close_accordion_section();
            } else {
                close_accordion_section();

                // Add active class to section title
                jQuery(this).addClass('active');
                // Open up the hidden content panel
                jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open');
            }

            e.preventDefault();
        });

        jQuery('.accordion_preview-section-title').click(function(e) {
            // Grab current anchor value
            var currentAttrValue = jQuery(this).attr('href');

            if (jQuery(e.target).is('.active')) {
                close_accordion_preview_section();
            } else {
                close_accordion_preview_section();

                // Add active class to section title
                jQuery(this).addClass('active');
                // Open up the hidden content panel
                jQuery('.accordion_preview ' + currentAttrValue).slideDown(300).addClass('open');
            }

            e.preventDefault();
        });
        //subscription add script 
        $("#wbm_dialog").dialog({
            modal: true, title: 'Subscribe To Our Newsletter', zIndex: 10000, autoOpen: true,
            width: '400', resizable: false,
            position: {my: "center", at: "center", of: window},
            dialogClass: 'dialogButtons',
            buttons: [
                {
                    id: "Delete",
                    text: "Subscribe Me",
                    click: function() {
                        // $(obj).removeAttr('onclick');
                        // $(obj).parents('.Parent').remove();
                        var email_id = jQuery('#txt_user_sub_wbm').val();
                        var data = {
                            'action': 'add_plugin_user_wbm',
                            'email_id': email_id
                        };
                        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                        jQuery.post(ajaxurl, data, function(response) {
                            jQuery('#wbm_dialog').html('<h2>You have been successfully subscribed');
                            jQuery(".ui-dialog-buttonpane").remove();
                        });
                    }
                },
                {
                    id: "No",
                    text: "No, Remind Me Later",
                    click: function() {

                        jQuery(this).dialog("close");
                    }
                },
            ]
        });
        jQuery("div.dialogButtons .ui-dialog-buttonset button").removeClass('ui-state-default');
        jQuery("div.dialogButtons .ui-dialog-buttonset button").addClass("button-primary woocommerce-save-button");

    });


})(jQuery);