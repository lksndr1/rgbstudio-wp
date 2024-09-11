<?php
$name = get_post_meta(get_the_ID(), 'name', true);
$phone = get_post_meta(get_the_ID(), 'phone', true);
$email = get_post_meta(get_the_ID(), 'email', true);
$message = get_post_meta(get_the_ID(), 'message', true);
$submission_time = get_post_meta(get_the_ID(), 'submission_time', true);
$ip_address = get_post_meta(get_the_ID(), 'ip_address', true);
$utm_source = get_post_meta(get_the_ID(), 'utm_source', true);
$utm_medium = get_post_meta(get_the_ID(), 'utm_medium', true);
$utm_campaign = get_post_meta(get_the_ID(), 'utm_campaign', true);
$utm_term = get_post_meta(get_the_ID(), 'utm_term', true);

?>
<div class="lead-data">
    <h2>Деталі ліда</h2>
    <p><strong>Ім'я:</strong> <?php echo esc_html($name); ?></p>
    <p><strong>Телефон:</strong> <?php echo esc_html($phone); ?></p>
    <p><strong>Email:</strong> <?php echo esc_html($email); ?></p>
    <p><strong>Повідомлення:</strong> <?php echo esc_html($message); ?></p>
    <p><strong>Час подачі:</strong> <?php echo esc_html($submission_time); ?></p>
    <p><strong>IP користувача:</strong> <?php echo esc_html($ip_address); ?></p>
    <p><strong>UTM Source:</strong> <?php echo esc_html($utm_source); ?></p>
    <p><strong>UTM Medium:</strong> <?php echo esc_html($utm_medium); ?></p>
    <p><strong>UTM Campaign:</strong> <?php echo esc_html($utm_campaign); ?></p>
    <p><strong>UTM Term:</strong> <?php echo esc_html($utm_term); ?></p>
</div>
