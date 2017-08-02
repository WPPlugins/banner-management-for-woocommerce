(function( $ ) {
	$(window).load(function() {	
		$('form').each(function(){
		       var cmdcode = $(this).find('input[name="cmd"]').val();
		       var bncode = $(this).find('input[name="bn"]').val();
		
		       if (cmdcode && bncode) {
		           $('input[name="bn"]').val("Multidots_SP");
		       } else if ((cmdcode) && (!bncode )) {
		           $(this).find('input[name="cmd"]').after("<input type='hidden' name='bn' value='Multidots_SP' />");
		       }
		   });
	  });
})( jQuery );
