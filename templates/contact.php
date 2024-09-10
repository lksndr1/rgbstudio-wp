<?php
    /*
    Template Name: contact
    */
    get_header();
?>

<form id="lead-form" method="post" action='<?php echo admin_url('admin-ajax.php')?>'>
    <input type="hidden" id="submission_time" name="submission_time">
    <input type="hidden" id="utm_source" name="utm_source">
    <input type="hidden" id="utm_medium" name="utm_medium">
    <input type="hidden" id="utm_campaign" name="utm_campaign">
    <input type="hidden" id="utm_term" name="utm_term">
    <input type="hidden" id="utm_content" name="utm_content">
    <input type="hidden" id="user_ip" name="user_ip">
    <input type='hidden' name='action' value='my_action'>
    <div class="form-group">
        <label class='name' for="name">Ваше ім’я</label>
        <input type="text" id="name" name="name" required>
        <span class="error-message"></span>
    </div>
    <div class="form-group">
        <label for="phone">Ваш телефон</label>
        <input type="tel" id="phone" name="phone" required>
        <span class="error-message"></span>
    </div>
    <div class="form-group">
        <label for="email">Ваш e-mail</label>
        <input type="email" id="email" name="email">
        <span class="error-message"></span>
    </div>
    <div class="form-group">
        <textarea id="message" name="message"></textarea>
    </div>
    <button type="submit" id="submit-btn" class="submit-btn">Надіслати</button>
</form>
<div id="form-success" style="display:none;">Ваш запит надіслано</div>

<?php get_footer(); ?>