jQuery(document).ready(function($) {
    jQuery('#referral-registration-form').submit(function() {
        var first_name = jQuery("#first_name").val();
        var last_name = jQuery("#last_name").val();
        var email = jQuery("#email").val();
        var password = jQuery("#password").val();
        var referralCode = jQuery("#referral_code").val();

        $.ajax({
            url: referra_code_form.ajaxUrl,
            type: 'POST',
            data: {
                action: 'validate_referral_code',
                referral_code: referralCode,
                first_name:first_name,
                last_name:last_name,
                email:email,
                password:password,
                // nonce: referralCodeData.nonce
            },
            success: function(response) {
                 $('#referral-code-validation-message').html(response);
            }
        });
        return false; // Prevent page reload
    });
});
