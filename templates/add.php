<?php
include_once 'helpers.php';
include_once 'functions.php';
?>
<main class="page__main page__main--adding-post">
    <div class="page__main-section">
        <div class="container">
            <h1 class="page__title page__title--adding-post">Добавить публикацию</h1>
        </div>
        <div class="adding-post container">
            <div class="adding-post__tabs-wrapper tabs">
                <div class="adding-post__tabs filters">
                    <ul class="adding-post__tabs-list filters__list tabs__list">
                        <?php foreach ($post_types as $i => $post_type) : ?>
                            <li class="adding-post__tabs-item filters__item">
                                <a class="adding-post__tabs-link filters__button filters__button--<?= $post_type['name'] ?> <?php if ($i == 0) {
                                                                                                                                echo 'filters__button--active tabs__item tabs__item--active';
                                                                                                                            } ?> button">
                                    <svg class="filters__icon" width="22" height="18">
                                        <use xlink:href="#icon-filter-<?= $post_type['name'] ?>"></use>
                                    </svg>
                                    <span><?= $post_type['title'] ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="adding-post__tab-content">
                    <?php foreach ($post_types as $j => $post_type) : ?>
                        <?php if ($post_type['name'] == 'photo') : ?>
                            <section class="adding-post__photo tabs__content <?php if ($j == 0) {
                                                                                    echo 'tabs__content--active';
                                                                                } ?>">
                                <h2 class="visually-hidden">Форма добавления фото</h2>
                                <form class="adding-post__form form" action="#" method="post" enctype="multipart/form-data">
                                    <div class="form__text-inputs-wrapper">
                                        <div class="form__text-inputs">
                                            <div class="adding-post__input-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="photo-heading">Заголовок <span class="form__input-required">*</span></label>
                                                <div class="form__input-section <?= $errors['heading'] ? 'form__input-section--error' : '' ?>">
                                                    <input class="adding-post__input form__input" id="photo-heading" type="text" name="photo-heading" placeholder="Введите заголовок" value="<?= getPostVal('photo-url'); ?>">
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                </div>
                                            </div>
                                            <div class="adding-post__input-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="photo-url">Ссылка из интернета</label>
                                                <div class="form__input-section">
                                                    <input class="adding-post__input form__input" id="photo-url" type="text" name="photo-url" placeholder="Введите ссылку" value="<?= getPostVal('photo-url'); ?>">
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <div class="form__error-text">
                                                        <h3 class="form__error-title">Заголовок сообщения</h3>
                                                        <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="adding-post__input-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="photo-tags">Теги</label>
                                                <div class="form__input-section">
                                                    <input class="adding-post__input form__input" id="photo-tags" type="text" name="photo-tags" placeholder="Введите теги" value="<?= getPostVal('photo-tags'); ?>">
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <div class="form__error-text">
                                                        <h3 class="form__error-title">Заголовок сообщения</h3>
                                                        <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        // if (!empty($errors)) {
                                        //     print include_template('form/invalid-block.php', ['errors' => $errors]);
                                        // }
                                        ?>
                                    </div>
                                    <div class="adding-post__input-file-container form__input-container form__input-container--file">
                                        <div class="adding-post__input-file-wrapper form__input-file-wrapper">
                                            <div class="adding-post__file-zone adding-post__file-zone--photo form__file-zone dropzone">
                                                <input class="adding-post__input-file form__input-file" id="userpic-file-photo" type="file" name="userpic-file-photo" title=" ">
                                                <div class="form__file-zone-text">
                                                    <span>Перетащите фото сюда</span>
                                                </div>
                                            </div>
                                            <button class="adding-post__input-file-button form__input-file-button form__input-file-button--photo button" type="button">
                                                <span>Выбрать фото</span>
                                                <svg class="adding-post__attach-icon form__attach-icon" width="10" height="20">
                                                    <use xlink:href="#icon-attach"></use>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="adding-post__file adding-post__file--photo form__file dropzone-previews">

                                        </div>
                                    </div>
                                    <div class="adding-post__buttons">
                                        <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                        <a class="adding-post__close" href="#">Закрыть</a>
                                    </div>
                                </form>
                            </section>
                        <?php elseif ($post_type['name'] == 'video') : ?>
                            <section class="adding-post__video tabs__content <?php if ($j == 0) {
                                                                                    echo 'tabs__content--active';
                                                                                } ?>">
                                <h2 class="visually-hidden">Форма добавления видео</h2>
                                <form class="adding-post__form form" action="#" method="post" enctype="multipart/form-data">
                                    <div class="form__text-inputs-wrapper">
                                        <div class="form__text-inputs <?= $errors['heading'] ? 'form__input-section--error' : '' ?>">
                                            <div class="adding-post__input-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="video-heading">Заголовок <span class="form__input-required">*</span></label>
                                                <div class="form__input-section">
                                                    <input class="adding-post__input form__input" id="video-heading" type="text" name="video-heading" placeholder="Введите заголовок" value="<?= getPostVal('video-heading'); ?>">
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <?php
                                                    if (!empty($errors) && $errors['heading'] == 'empty') {
                                                        print include_template('form/error-text.php', ['error_message' => 'Заполните это поле']);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="adding-post__input-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="video-url">Ссылка youtube <span class="form__input-required">*</span></label>
                                                <div class="form__input-section <?= $errors['video-url'] ? 'form__input-section--error' : '' ?>">
                                                    <input class="adding-post__input form__input" id="video-url" type="text" name="video-url" placeholder="Введите ссылку">
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <?php
                                                    if (!empty($errors) && $errors['video-url'] == 'empty') {
                                                        print include_template('form/error-text.php', ['error_message' => 'Заполните это поле']);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="adding-post__input-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="video-tags">Теги</label>
                                                <div class="form__input-section">
                                                    <input class="adding-post__input form__input" id="video-tags" type="text" name="video-tags" placeholder="Введите ссылку" value="<?= getPostVal('video-tags'); ?>">
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <div class="form__error-text">
                                                        <h3 class="form__error-title">Заголовок сообщения</h3>
                                                        <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($errors)) {
                                            print include_template('form/invalid-block.php');
                                        }
                                        ?>
                                    </div>

                                    <div class="adding-post__buttons">
                                        <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                        <a class="adding-post__close" href="#">Закрыть</a>
                                    </div>
                                </form>
                            </section>
                        <?php elseif ($post_type['name'] == 'text') : ?>
                            <section class="adding-post__text tabs__content <?php if ($j == 0) {
                                                                                echo 'tabs__content--active';
                                                                            } ?>">
                                <h2 class="visually-hidden">Форма добавления текста</h2>
                                <form class="adding-post__form form" action="#" method="post">
                                    <div class="form__text-inputs-wrapper">
                                        <div class="form__text-inputs <?= $errors['heading'] ? 'form__input-section--error' : '' ?>">
                                            <div class="adding-post__input-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="text-heading">Заголовок <span class="form__input-required">*</span></label>
                                                <div class="form__input-section">
                                                    <input class="adding-post__input form__input" id="text-heading" type="text" name="text-heading" placeholder="Введите заголовок" value="<?= getPostVal('text-heading'); ?>">
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <?php
                                                    if (!empty($errors) && $errors['heading'] == 'empty') {
                                                        print include_template('form/error-text.php', ['error_message' => 'Заполните это поле']);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="adding-post__textarea-wrapper form__textarea-wrapper">
                                                <label class="adding-post__label form__label" for="post-text">Текст поста <span class="form__input-required">*</span></label>
                                                <div class="form__input-section  <?= $errors['post-text'] ? 'form__input-section--error' : '' ?>">
                                                    <textarea class="adding-post__textarea form__textarea form__input" id="post-text" name="post-text" placeholder=" Введите текст публикации"><?= getPostVal('post-text'); ?></textarea>
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <?php
                                                    if (!empty($errors) && $errors['post-text'] == 'empty') {
                                                        print include_template('form/error-text.php', ['error_message' => 'Заполните это поле']);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="adding-post__input-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="post-tags">Теги</label>
                                                <div class="form__input-section">
                                                    <input class="adding-post__input form__input" id="post-tags" type="text" name="post-tags" placeholder="Введите теги" value="<?= getPostVal('post-tags'); ?>">
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <div class="form__error-text">
                                                        <h3 class="form__error-title">Заголовок сообщения</h3>
                                                        <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($errors)) {
                                            print include_template('form/invalid-block.php');
                                        }
                                        ?>
                                    </div>
                                    <div class="adding-post__buttons">
                                        <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                        <a class="adding-post__close" href="#">Закрыть</a>
                                    </div>
                                </form>
                            </section>
                        <?php elseif ($post_type['name'] == 'quote') : ?>
                            <section class="adding-post__quote tabs__content <?php if ($j == 0) { echo 'tabs__content--active'; } ?>">
                                <h2 class="visually-hidden">Форма добавления цитаты</h2>
                                <form class="adding-post__form form" action="#" method="post">
                                    <div class="form__text-inputs-wrapper">
                                        <div class="form__text-inputs <?= $errors['heading'] ? 'form__input-section--error' : '' ?>">
                                            <div class="adding-post__input-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="quote-heading">Заголовок <span class="form__input-required">*</span></label>
                                                <div class="form__input-section">
                                                    <input class="adding-post__input form__input" id="quote-heading" type="text" name="quote-heading" placeholder="Введите заголовок" <?php $_POST['quote-heading'] ? "value=\"{$_POST['quote-heading']}\"" : '' ?>>
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <?php
                                                    if (!empty($errors) && $errors['heading'] == 'empty') {
                                                        print include_template('form/error-text.php', ['error_message' => 'Заполните это поле']);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="adding-post__input-wrapper form__textarea-wrapper">
                                                <label class="adding-post__label form__label" for="cite-text">Текст цитаты <span class="form__input-required">*</span></label>
                                                <div class="form__input-section">
                                                    <textarea class="adding-post__textarea adding-post__textarea--quote form__textarea form__input" id="cite-text" name="quote-text" placeholder="Текст цитаты"><?= getPostVal('quote-text'); ?></textarea>
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <?php
                                                    if (!empty($errors) && $errors['quote-text'] == 'empty') {
                                                        print include_template('form/error-text.php', ['error_message' => 'Заполните это поле']);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="adding-post__textarea-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="quote-author">Автор <span class="form__input-required">*</span></label>
                                                <div class="form__input-section">
                                                    <input class="adding-post__input form__input" id="quote-author" type="text" name="quote-author" value="<?= getPostVal('quote-author'); ?>">
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <?php
                                                    if (!empty($errors) && $errors['quote-author'] == 'empty') {
                                                        print include_template('form/error-text.php', ['error_message' => 'Заполните это поле']);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="adding-post__input-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="cite-tags">Теги</label>
                                                <div class="form__input-section">
                                                    <input class="adding-post__input form__input" id="cite-tags" type="text" name="quote-tags" placeholder="Введите теги" value="<?= getPostVal('quote-tags'); ?>">
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <div class="form__error-text">
                                                        <h3 class="form__error-title">Пожалуйста, исправьте следующие ошибки:</h3>
                                                        <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($errors)) {
                                            print include_template('form/invalid-block.php');
                                        }
                                        ?>
                                    </div>
                                    <div class="adding-post__buttons">
                                        <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                        <a class="adding-post__close" href="#">Закрыть</a>
                                    </div>
                                </form>
                            </section>
                        <?php elseif ($post_type['name'] == 'link') : ?>
                            <section class="adding-post__link tabs__content <?php if ($i == 0) { echo 'tabs__content--active'; } ?>">
                                <h2 class="visually-hidden">Форма добавления ссылки</h2>
                                <form class="adding-post__form form" action="#" method="post">
                                    <div class="form__text-inputs-wrapper">
                                        <div class="form__text-inputs <?= $errors['heading'] ? 'form__input-section--error' : '' ?>">
                                            <div class="adding-post__input-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="link-heading">Заголовок <span class="form__input-required">*</span></label>
                                                <div class="form__input-section">
                                                    <input class="adding-post__input form__input" id="link-heading" type="text" name="link-heading" placeholder="Введите заголовок" <?php $_POST['link-heading'] ? "value=\"{$_POST['link-heading']}\"" : '' ?>>
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <?php
                                                    if (!empty($errors) && $errors['heading'] == 'empty') {
                                                        print include_template('form/error-text.php', ['errors' => $errors]);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="adding-post__textarea-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="post-link">Ссылка <span class="form__input-required">*</span></label>
                                                <div class="form__input-section">
                                                    <input class="adding-post__input form__input" id="post-link" type="text" name="link-heading">
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <?php
                                                    if (!empty($errors) && $errors['post-link'] == 'empty') {
                                                        print include_template('form/error-text.php', ['error_message' => 'Заполните это поле']);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="adding-post__input-wrapper form__input-wrapper">
                                                <label class="adding-post__label form__label" for="link-tags">Теги</label>
                                                <div class="form__input-section">
                                                    <input class="adding-post__input form__input" id="link-tags" type="text" name="link-tags" placeholder="Введите ссылку">
                                                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                    <div class="form__error-text">
                                                        <h3 class="form__error-title">Заголовок сообщения</h3>
                                                        <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($errors)) {
                                            print include_template('form/invalid-block.php', ['errors' => $errors]);
                                        }
                                        ?>
                                    </div>
                                    <div class="adding-post__buttons">
                                        <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                        <a class="adding-post__close" href="#">Закрыть</a>
                                    </div>
                                </form>
                            </section>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>