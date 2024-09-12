<?php
    /*
    Template Name: contact
    */
    get_header();
?>

<div class="container">
    <div class="wrapper">
        <div id='content-wrapper' class="flex-wrapper">
            <div class='slogan'>
                <img src="<?php echo get_template_directory_uri(); ?>/src/images/face1.png" alt="woman face" class="face1">
                <img src="<?php echo get_template_directory_uri(); ?>/src/images/face2.png" alt="woman face" class="face2">
                <h1 class='slogan-text'>Ми завжди готові запропонувати інноваційні та альтернативні шляхи лікування зубів</h1>
            </div>
            <div class="form-wrapper">
                <h2 class='form-heading'>Заповніть форму та отримайте професійну консультацію</h2>
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
                        <input type="text" id="name" name="name" required placeholder="Вкажіть Ваше ім'я">
                        <span class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Ваш телефон</label>
                        <input type="tel" id="phone" name="phone" required>
                        <span class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Ваш e-mail</label>
                        <input type="email" id="email" name="email" placeholder='email@gmail.com'>
                        <span class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <textarea id="message" name="message" placeholder='Коротко опишіть проблему, яку хочете вирішити'></textarea>
                    </div>
                    <button type="submit" id="submit-btn" class="submit-btn"><span class='button-text'>Надіслати</span></button>
                    <p class="personal-data">Натискаючи на кнопку, я даю згоду<br>на <a class='personal-data-link' href='#'>обробку персональних даних</a></p>
                </form>
            </div>
        </div>
        <div id="success-modal" class="modal">
            <button id="close-modal">
                <p>Закрити</p>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.21851 2L13.4999 14.2814" stroke="#6F6F72" stroke-linecap="round" />
                    <path d="M13.272 2L0.990552 14.2814" stroke="#6F6F72" stroke-linecap="round" />
                </svg>
            </button>
            <div class="modal-content">
                <img src="<?php echo get_template_directory_uri(); ?>/src/images/success-rocket.png" alt="rocket" class="rocket-img">
                <p class='modal-message-status'>Ваш запит надіслано</p>
                <p class='modal-thanks'>Дякуємо,</br>що довіряєте!</p>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>