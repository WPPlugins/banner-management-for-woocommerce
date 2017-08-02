jQuery( document ).ready(function($) {
	
	/*
	*	 Woocommerce-banner-managment edit  uploading script
	*/
	$('.mdwbm_upload_file_button').live('click', function( event ) {

		event.preventDefault();
		// If the media frame already exists, reopen it.	
		// Create the media frame.
		file_frame_edit_cat = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false
		});
		
		// When an file is selected, run a callback.
		file_frame_edit_cat.on( 'select', function() {
		
			attachment = file_frame_edit_cat.state().get('selection').first().toJSON();

			// Update front end
			$('.banner_url_label').text( attachment.filename );
			$('.mdwbm_image').attr( 'value', attachment.id );
			$('.cat_banner_img_admin').attr('src', attachment.url );
			$('.cat_banner_img_admin').css('display', 'block' );
		});
		
		// Open the Modal
		file_frame_edit_cat.open();
	});
	
	//set the custom field script for add category page
	
	$('.mdwbm_add_cat_upload_file_button').live('click', function( event ) {
		event.preventDefault();
		
		// If the media frame already exists, reopen it.
		// Create the media frame.
		file_frame_add_cat = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false
		});
		
		// When an file is selected, run a callback.
		file_frame_add_cat.on( 'select', function() {
		
			attachment = file_frame_add_cat.state().get('selection').first().toJSON();

			// Update front end
			$('.banner_url_label').text( attachment.filename );
			$('.mdwbm_image').attr( 'value', attachment.id );
			$('.add_cat_banner_img_admin').attr('src', attachment.url );
			$('.add_cat_banner_img_admin').css('display', 'block' );
		});
		
		// Open the Modal
		file_frame_add_cat.open();
	});
	
	//Set the shop page banner upload script
	$('.wbm_shop_page_upload_file_button').live('click', function( event ) { 
		event.preventDefault();
		var file_frame;
		
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false
		});
		
		// When an file is selected, run a callback.
		file_frame.on( 'select', function() {
		
			attachment = file_frame.state().get('selection').first().toJSON();

			// Update front end
			$('.banner_url_label').text( attachment.filename );
			$('.wbm_shop_page_image').attr( 'value', attachment.id );
			$('.wbm_shop_page_cat_banner_img_admin').attr('src', attachment.url );
			$('.wbm_shop_page_cat_banner_img_admin').css('display', 'block' );
		});
		
		// Open the Modal
		file_frame.open();
	});
	
	//Set the cart page banner upload script
	$('.wbm_cart_page_upload_file_button').live('click', function( event ) { 
		event.preventDefault();
		var file_frame;
		
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false
		});
		
		// When an file is selected, run a callback.
		file_frame.on( 'select', function() {
		
			attachment = file_frame.state().get('selection').first().toJSON();

			// Update front end
			$('.banner_url_label').text( attachment.filename );
			$('.wbm_shop_cart_image').attr( 'value', attachment.id );
			$('.wbm_cart_page_cat_banner_img_admin').attr('src', attachment.url );
			$('.wbm_cart_page_cat_banner_img_admin').css('display', 'block' );
			
		});
		
		// Open the Modal
		file_frame.open();
	});
	//set the check out page banner upload script 
	$('.wbm_checkout_page_upload_file_button').live('click', function( event ) { 
		event.preventDefault();
		var file_frame;
		
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false
		});
		
		// When an file is selected, run a callback.
		file_frame.on( 'select', function() {
		
			attachment = file_frame.state().get('selection').first().toJSON();

			// Update front end
			$('.banner_url_label').text( attachment.filename );
			$('.wbm_shop_cart_image').attr( 'value', attachment.id );
			$('.wbm_checkout_page_banner_img_admin').attr('src', attachment.url );
			$('.wbm_checkout_page_banner_img_admin').css('display', 'block' );
		});
		
		// Open the Modal
		file_frame.open();
	});
	
	//set the thank you  page banner upload script 
	$('.wbm_thank_you_page_upload_file_button').live('click', function( event ) { 
		event.preventDefault();
		var file_frame;
		
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false
		});
		
		// When an file is selected, run a callback.
		file_frame.on( 'select', function() {
		
			attachment = file_frame.state().get('selection').first().toJSON();

			// Update front end
			$('.banner_url_label').text( attachment.filename );
			$('.wbm_shop_thank_you_page_image').attr( 'value', attachment.id );
			$('.wbm_thank_you_page_banner_img_admin').attr('src', attachment.url );
			$('.wbm_thank_you_page_banner_img_admin').css('display', 'block' );
		});
		
		// Open the Modal
		file_frame.open();
	});
	
	//Remove file when selected in edit category page
 	$('.mdwbm_remove_file').live('click', function( event ){
		$('.banner_url_label').text( '' );
		$('.mdwbm_image').attr( 'value', '' );
		$('.cat_banner_img_admin').attr('src', '' );
		$('.cat_banner_img_admin').css('display', 'none' );
	});
	
	
	//Remove file when selected in add category page
 	$('.mdwbm_add_cat_remove_file').live('click', function( event ){
		$('.banner_url_label').text( '' );
		$('.mdwbm_image').attr( 'value', '' );
		$('.add_cat_banner_img_admin').attr('src', '' );
		$('.add_cat_banner_img_admin').css('display', 'none' );
	});
	
	//remove the shop banner image script
	$('.wbm_shop_page_remove_file').live('click', function( event ){
		$('.banner_url_label').text( '' );
		$('.wbm_shop_page_image').attr( 'value', '' );
		$('.wbm_shop_page_cat_banner_img_admin').attr('src', '' );
		$('.wbm_shop_page_cat_banner_img_admin').css('display', 'none' );
	});
	//remove the cart page banner image script
	$('.wbm_cart_page_remove_file').live('click', function( event ){ 
		$('.banner_url_label').text( '' );
		$('.wbm_shop_page_image').attr( 'value', '' );
		$('.wbm_cart_page_cat_banner_img_admin').attr('src', '' );
		$('.wbm_cart_page_cat_banner_img_admin').css('display', 'none' );
	});
	//remove check out page banner image script
	$('.wbm_checkout_page_remove_file').live('click', function( event ){ 
		$('.banner_url_label').text( '' );
		$('.wbm_shop_page_image').attr( 'value', '' );
		$('.wbm_checkout_page_banner_img_admin').attr('src', '' );
		$('.wbm_checkout_page_banner_img_admin').css('display', 'none' );
	});
	//remove thank you page banner image script
	$('.wbm_checkout_page_remove_file').live('click', function( event ){ 
		$('.banner_url_label').text( '' );
		$('.wbm_shop_page_image').attr( 'value', '' );
		$('.wbm_thank_you_page_banner_img_admin').attr('src', '' );
		$('.wbm_thank_you_page_banner_img_admin').css('display', 'none' );
	});
	
	
});