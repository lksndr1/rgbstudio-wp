<?php

function rgb_studio_scripts() {
    wp_enqueue_style('main', get_stylesheet_uri());
    wp_enqueue_style('rgb_studio-style', get_template_directory_uri() . '/styles/main.css', array('main'));
    wp_enqueue_script('rgb_studio-scripts', get_template_directory_uri() . '/scripts/main.js', array(), false, true);

    wp_localize_script('rgb_studio-scripts', 'lead_form_params', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
    
    if (is_page_template('templates/contact.php')) {
        wp_enqueue_style('contact-style', get_template_directory_uri() . '/styles/template-styles/contact.css', array('main'));
        wp_enqueue_script('contact-scripts', get_template_directory_uri() . '/scripts/template-scripts/contact.js', array(), false, true);
    }
}

add_action('wp_enqueue_scripts', 'rgb_studio_scripts');

function lead_form_settings_init() {
    add_settings_section('lead_form_settings_section', 'Lead Form Settings', null, 'general');
    add_settings_field('lead_form_emails', 'Lead Form Emails', 'lead_form_emails_callback', 'general', 'lead_form_settings_section');
    register_setting('general', 'lead_form_emails', [
        'sanitize_callback' => 'sanitize_lead_form_emails'
    ]);
}

function sanitize_lead_form_emails($input) {
    $emails = array_map('trim', explode(',', $input));
    $emails = array_filter($emails, function($email) {
        return is_email($email);
    });
    return implode(', ', $emails);
}

function lead_form_emails_callback() {
    $emails = get_option('lead_form_emails', '');
    echo '<input type="text" id="lead_form_emails" name="lead_form_emails" value="' . esc_attr($emails) . '" class="regular-text" placeholder="example1@example.com, example2@example.com" />';
}

add_action('admin_init', 'lead_form_settings_init');

function handle_lead_form_submission() {
    if (!isset($_POST['form_data'])) {
        wp_send_json_error(['errors' => 'Немає даних для обробки.']);
        return;
    }

    parse_str($_POST['form_data'], $form_data);

    $errors = [];

    if (empty($form_data['name']) || !preg_match("/^[A-Za-zА-Яа-яІіЇїЄєЁёҐґ]+( [A-Za-zА-Яа-яІіЇїЄєЁёҐґ]+)*$/u", $form_data['name'])) {
        $errors['name'] = 'Введіть коректне ім’я.';
    }

    if (empty($form_data['phone']) || !preg_match("/^\+?[0-9\s]+$/", $form_data['phone'])) {
        $errors['phone'] = 'Введіть коректний номер телефону.';
    }

    if (!empty($form_data['email']) && !filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Введіть коректну адресу електронної пошти.';
    }

    if (!empty($errors)) {
        wp_send_json_error(['errors' => $errors]);
        return;
    }

    $admin_emails = get_option('lead_form_emails', 'example@example.com');
    $to = explode(',', $admin_emails);
    $subject = 'Новий лід з контактної форми';
    $body = sprintf(
        "Ім'я: %s\nТелефон: %s\nEmail: %s\nПовідомлення: %s\nЧас подачі: %s\nUTM Source: %s\nUTM Medium: %s\nUTM Campaign: %s\nUTM Term: %s\nUTM Content: %s\nIP користувача: %s",
        sanitize_text_field($form_data['name']),
        sanitize_text_field($form_data['phone']),
        sanitize_email($form_data['email']),
        sanitize_textarea_field($form_data['message'] ?? ''),
        sanitize_text_field($form_data['submission_time'] ?? ''),
        sanitize_text_field($form_data['utm_source'] ?? ''),
        sanitize_text_field($form_data['utm_medium'] ?? ''),
        sanitize_text_field($form_data['utm_campaign'] ?? ''),
        sanitize_text_field($form_data['utm_term'] ?? ''),
        sanitize_text_field($form_data['utm_content'] ?? ''),
        sanitize_text_field($form_data['user_ip'] ?? '')
    );
    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    wp_mail($to, $subject, $body, $headers);

    $post_data = [
        'post_type' => 'lead',
        'post_status' => 'publish',
        'post_title' => 'Lead from ' . $form_data['name'],
        'meta_input' => [
            'name' => sanitize_text_field($form_data['name']),
            'phone' => sanitize_text_field($form_data['phone']),
            'email' => sanitize_email($form_data['email']),
            'message' => sanitize_textarea_field($form_data['message']),
            'submission_time' => sanitize_text_field($form_data['submission_time']),
            'ip_address' => sanitize_text_field($form_data['user_ip']),
            'utm_source' => sanitize_text_field($form_data['utm_source']),
            'utm_medium' => sanitize_text_field($form_data['utm_medium']),
            'utm_campaign' => sanitize_text_field($form_data['utm_campaign']),
            'utm_term' => sanitize_text_field($form_data['utm_term']),
        ],
    ];

    wp_insert_post($post_data);

    wp_send_json_success('Ваш запит надіслано успішно!');
}

add_action('wp_ajax_submit_lead_form', 'handle_lead_form_submission');
add_action('wp_ajax_nopriv_submit_lead_form', 'handle_lead_form_submission');

function create_lead_post_type() {
    register_post_type('lead', [
        'labels' => [
            'name' => __('Leads'),
            'singular_name' => __('Lead'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_position' => 5,
        'supports' => ['title', 'custom-fields'],
    ]);
}

add_action('init', 'create_lead_post_type');

function enqueue_custom_scripts() {
    wp_enqueue_style('intl-tel-input', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css');
    wp_enqueue_script('intl-tel-input', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js', ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

?>
