jQuery(document).ready(function ($) {
    $('#lead-form').on('submit', function (e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: lead_form_params.ajax_url,
            type: 'POST',
            data: {
                action: 'submit_lead_form',
                form_data: formData,
            },
            success: function (response) {
                if (response.success) {
                    $('#lead-form').hide();
                    $('#form-success').show();
                } else {
                    $('.error-message').empty();
                    $.each(response.data.errors, function (key, message) {
                        $('#' + key).siblings('.error-message').text(message);
                        $('#' + key).addClass('error');
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log('AJAX Error: ' + status + error);
            },
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var input = document.querySelector("#phone");
    var iti = window.intlTelInput(input, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });
});