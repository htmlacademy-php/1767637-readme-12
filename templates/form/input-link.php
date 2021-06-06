<div class="adding-post__textarea-wrapper form__input-wrapper">
    <label class="adding-post__label form__label" for="post-link">Ссылка <span class="form__input-required">*</span></label>
    <div class="form__input-section <?= in_array('post-link', $errors_data) ? " form__input-section--error" : ""; ?>">
        <input class="adding-post__input form__input" id="post-link" type="text" name="post-link">
        <button class=" form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
    </div>
</div>