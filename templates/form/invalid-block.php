<div class="form__invalid-block">
    <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
    <ul class="form__invalid-list">
        <?php if($errors['heading'] == 'empty') : ?>
            <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
        <?php endif; ?>
        <li class="form__invalid-item">Цитата. Она не должна превышать 70 знаков.</li>
    </ul>
</div>