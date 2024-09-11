jQuery(document).ready(function ($) {
    console.log('Form submit handler attached');
    $('#lead-form').on('submit', function (e) {
        e.preventDefault();
        console.log('Form submitted');

        let iti = window.intlTelInputGlobals.getInstance(document.querySelector("#phone"));
        let phoneNumber = iti.getNumber();
        let formData = $(this).serializeArray();
        formData.push({name: 'phone', value: phoneNumber});

        $.ajax({
            url: lead_form_params.ajax_url,
            type: 'POST',
            data: {
                action: 'submit_lead_form',
                form_data: $.param(formData),
            },
            success: function (response) {
                if (response.success) {
                    $('#lead-form')[0].reset();
                    $('#success-modal').fadeIn();
                    $('#content-wrapper').css('display', 'none');
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

    $('#close-modal').on('click', function () {
        $('#success-modal').fadeOut();
        $('#content-wrapper').css('display', 'flex');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    let input = document.querySelector("#phone");
    let iti = window.intlTelInput(input, {
        initialCountry: "UA",
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });
});

// hidden-data
const form = document.getElementById('lead-form');

const submissionTimeField = document.getElementById('submission_time');
submissionTimeField.value = new Date().toISOString();

const urlParams = new URLSearchParams(window.location.search);
document.getElementById('utm_source').value = urlParams.get('utm_source') || '';
document.getElementById('utm_medium').value = urlParams.get('utm_medium') || '';
document.getElementById('utm_campaign').value = urlParams.get('utm_campaign') || '';
document.getElementById('utm_term').value = urlParams.get('utm_term') || '';
document.getElementById('utm_content').value = urlParams.get('utm_content') || '';

fetch('https://api.ipify.org?format=json')
    .then(response => response.json())
    .then(data => {
        document.getElementById('user_ip').value = data.ip;
    })
    .catch(error => console.error('Error fetching IP:', error));
