<?php
    /*
    Template Name: contact
    */
    get_header();
?>

<form id="ccform" method="post" action="">
    <div class="form-group">
        <label class='nameme' for="name">Ваше ім’я</label>
        <input type="text" id="name" name="name" required pattern="^[A-Za-zА-Яа-я]+( [A-Za-zА-Яа-я]+)*$">
        <span class="error-message"></span>
    </div>
    <div class="form-group">
        <label for="phone">Ваш телефон</label>
        <input type="tel" id="phone" name="phone" required pattern="^\+?[0-9\s]+$">
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