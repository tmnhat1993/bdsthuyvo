jQuery(document).ready( function() {
	jQuery('#send_message').click(function(event) {
		event.preventDefault();
		
		nonce = jQuery(this).attr("data-nonce")

		jQuery('form#contact-form').submit(ajAxSubmit);

		function ajAxSubmit() {
		
			
			var sender_name = jQuery('#sender_name').val();
			var sender_email = jQuery('#sender_email').val();
			var sender_subject = jQuery('#sender_subject').val();
			var sender_message = jQuery('#sender_message').val();

			// alert(name);
			var valid = true;
			if(sender_name == "")
			{
				valid = false;
				jQuery("#name_error").show(500).css("display", "block");
				jQuery("#name_error").html('<img src="'+ email_icon_url +'/assets/images/email/error.png" alt="Error!">'+ jwtcAjax.name_error_message);
			}
			if(sender_email == "" && sender_subject == "")
				valid = false;
			if(sender_email == "")
			{
				jQuery("#email_error").show(500).css("display", "block");
				jQuery("#email_error").html('<img src="'+ email_icon_url +'/assets/images/email/error.png" alt="Error!">'+ jwtcAjax.email_error_message);
			}
			if(sender_subject == "")
			{
				jQuery("#subject_error").show(500).css("display", "block");
				jQuery("#subject_error").html('<img src="'+ email_icon_url +'/assets/images/email/error.png" alt="Error!">'+ jwtcAjax.subject_error_message);
			}
			if(sender_message == "") {
				valid = false;
				jQuery("#message_error").show(500).css("display", "block");
				jQuery("#message_error").html('<img src="'+ email_icon_url +'/assets/images/email/error.png" alt="Error!">'+ jwtcAjax.email_body_error_message);
			}
			
			if(valid) {
				jQuery.ajax({
						type : 'post',
						dataType : "json",
						url : jwtcAjax.ajaxurl,
						data : {action: "jwtc_contact_form_submit",
								sender_name : sender_name,
								sender_email : sender_email,
								sender_subject : sender_subject,
								sender_message : sender_message,
								nonce : nonce
				
						},
						async : false,
						success : function(data){
						
						// alert(data);
							
							sender_name = jQuery('#sender_name').val("");
							sender_email = jQuery('#sender_email').val("");
							sender_subject = jQuery('#sender_subject').val("");
							sender_message = jQuery('#sender_message').val("");
							
							jQuery("#sender_name").html("");
							jQuery("#sender_email").html("");
							jQuery("#sender_subject").html("");
							jQuery("#sender_message").html("");
							
							jQuery("#sender_name").hide(500).css("display", "none");
							jQuery("#sender_email").hide(500).css("display", "none");
							jQuery("#sender_subject").hide(500).css("display", "none");
							jQuery("#sender_message").hide(500).css("display", "none");
							
							jQuery('#mail_success').html('<img src="'+ email_icon_url +'/assets/images/email/success.png" alt="Success!">'+ jwtcAjax.email_success_message);
							jQuery('#mail_success').delay(1000).animate({opacity:0},500).delay(500).queue(function() { jQuery(this).remove(); });				

						},
						error : function(xhr, status){
							jQuery('#mail_fail').html('<img src="'+ email_icon_url +'/assets/images/email/error.png" alt="Error!">'+ jwtcAjax.email_failed_message);
							jQuery('#mail_fail').delay(1000).animate({opacity:0},500).delay(500).queue(function() { jQuery(this).remove(); });

						}
						
				})
			}
			event.preventDefault();
			return false;
		
		}
		
		});
	});