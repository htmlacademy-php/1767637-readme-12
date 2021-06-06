    
    <div class="adding-post__input-wrapper form__input-wrapper">
        <label class="adding-post__label form__label" for="<?= $title_field; ?>-heading">Заголовок <span class="form__input-required">*</span></label>
        <div class="form__input-section <?= in_array($title_field . '-heading', $errors_data) ? " form__input-section--error" : ""; ?>">
            <input class="adding-post__input form__input" id="<?//= $name; ?>-heading" type="text" name="<?= $title_field; ?>-heading" placeholder="Введите заголовок" value="<?= $_POST[$name . '-heading']; ?>">
            <button class=" form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
        </div>
    </div>