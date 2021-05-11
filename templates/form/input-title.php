<div class="adding-post__input-wrapper form__input-wrapper">
    <label class="adding-post__label form__label" for="<?= $name; ?>-heading">Заголовок <span class="form__input-required">*</span></label>
    <div class="form__input-section">
        <input class="adding-post__input form__input" id="<?= $name; ?>-heading" type="text" name="<?= $name; ?>-heading" placeholder="Введите заголовок">
        <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
        <?php $error_text = include 'error-text.php';
               var_dump($error_text);
        ?>
    </div>
</div>
