            <div class="form__invalid-block">
                <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                <ul class="form__invalid-list">
                    <?php
                    if (in_array('video-heading', $errors) || in_array('text-heading', $errors) || in_array('photo-heading', $errors) || in_array('link-heading', $errors) || in_array('quote-heading', $errors)) : ?>
                        <li class="form__invalid-item">Загловок пуст</li>
                    <?php endif; ?>
                    <?php
                    if (in_array('post-text', $errors) || in_array('quote-text', $errors)) : ?>
                        <li class="form__invalid-item">Текст пуст</li>
                    <?php endif; ?>
                    <?php if (in_array('post-link', $errors) || in_array('video-url', $errors)) : ?>
                        <li class="form__invalid-item">Ссылка пуста</li>
                    <?php endif; ?>
                    <?php if (in_array('text-count', $errors)) : ?>
                        <li class="form__invalid-item">Цитата должна быть менеее 70 символов.</li>
                    <?php endif; ?>
                    <?php if (in_array('quote-author', $errors)) : ?>
                        <li class="form__invalid-item">Заполните Автора</li>
                    <?php endif; ?>
                </ul>
            </div>