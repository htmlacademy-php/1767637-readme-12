<?php
include_once 'helpers.php';
include_once 'functions.php';
var_dump($errors);
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
                        <li class="adding-post__tabs-item filters__item">
                            <a class="adding-post__tabs-link filters__button filters__button--photo tabs__item tabs__item--active button <?php if ($_POST['post-type'] == 'photo' || empty($_POST['post-type'])) {
                                                                                                                                                echo 'filters__button--active';
                                                                                                                                            } ?>">
                                <svg class="filters__icon" width="22" height="18">
                                    <use xlink:href="#icon-filter-photo"></use>
                                </svg>
                                <span>Фото</span>
                            </a>
                        </li>
                        <li class="adding-post__tabs-item filters__item">
                            <a class="adding-post__tabs-link filters__button filters__button--video tabs__item button <?php if ($_POST['post-type'] == 'video') {
                                                                                                                            echo 'filters__button--active';
                                                                                                                        } ?>" href="#">
                                <svg class="filters__icon" width="24" height="16">
                                    <use xlink:href="#icon-filter-video"></use>
                                </svg>
                                <span>Видео</span>
                            </a>
                        </li>
                        <li class="adding-post__tabs-item filters__item">
                            <a class="adding-post__tabs-link filters__button filters__button--text tabs__item button <?php if ($_POST['post-type'] == 'text') {
                                                                                                                            echo 'filters__button--active';
                                                                                                                        } ?>" href="#">
                                <svg class="filters__icon" width="20" height="21">
                                    <use xlink:href="#icon-filter-text"></use>
                                </svg>
                                <span>Текст</span>
                            </a>
                        </li>
                        <li class="adding-post__tabs-item filters__item">
                            <a class="adding-post__tabs-link filters__button filters__button--quote tabs__item button <?php if ($_POST['post-type'] == 'quote') {
                                                                                                                            echo 'filters__button--active';
                                                                                                                        } ?>" href="#">
                                <svg class="filters__icon" width="21" height="20">
                                    <use xlink:href="#icon-filter-quote"></use>
                                </svg>
                                <span>Цитата</span>
                            </a>
                        </li>
                        <li class="adding-post__tabs-item filters__item">
                            <a class="adding-post__tabs-link filters__button filters__button--link tabs__item button <?php if ($_POST['post-type'] == 'link') {
                                                                                                                            echo 'filters__button--active';
                                                                                                                        } ?>" href="#">
                                <svg class="filters__icon" width="21" height="18">
                                    <use xlink:href="#icon-filter-link"></use>
                                </svg>
                                <span>Ссылка</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="adding-post__tab-content">
                    <section class="adding-post__photo tabs__content <?php if ($_POST['post-type'] == 'photo' || empty($_POST['post-type'])) {
                                                                            echo 'tabs__content--active';
                                                                        } ?>">
                        <h2 class="visually-hidden">Форма добавления фото</h2>
                        <form class="adding-post__form form" action="/add.php" method="post" enctype="multipart/form-data">
                            <div class="form__text-inputs-wrapper">
                                <div class="form__text-inputs">
                                    <?= include_template('form/input-heading.php', ['errors_data' => $errors, 'title_field' => 'photo']) ?>
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="photo-url">Ссылка из интернета</label>
                                        <div class="form__input-section <?= in_array('photo-url', $errors) ? " form__input-section--error" : ""; ?>">
                                            <input class="adding-post__input form__input" id="photo-url" type="text" name="photo-url" placeholder="Введите ссылку" value="<?= $_POST['photo-url']; ?>">
                                            <button class=" form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?= include_template('form/input-tag.php', ['errors_data' => $errors, 'title_field' => 'photo']) ?>
                                </div>
                                <?php if (!empty($errors)) : ?>
                                    <?php $data_errors = ['errors' => $errors]; ?>
                                    <?= include_template('form/invalid-block.php', $data_errors) ?>
                                <?php endif; ?>
                            </div>
                            <div class="adding-post__input-file-container form__input-container form__input-container--file">
                                <div class="adding-post__input-file-wrapper form__input-file-wrapper">
                                    <div class="adding-post__file-zone adding-post__file-zone--photo form__file-zone dropzone">
                                        <input class="adding-post__input-file form__input-file" id="userpic-file-photo" type="file" name="file-photo" value="<?= $_POST['file-photo']; ?>">
                                        <div class=" form__file-zone-text">
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
                            <input type="hidden" name="post-type" value="photo">
                            <div class="adding-post__buttons">
                                <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                <a class="adding-post__close" href="#">Закрыть</a>
                            </div>
                        </form>
                    </section>

                    <section class="adding-post__video tabs__content <?php if ($_POST['post-type'] == 'video') {
                                                                            echo 'tabs__content--active';
                                                                        } ?>">
                        <h2 class="visually-hidden">Форма добавления видео</h2>
                        <form class="adding-post__form form" action="../add.php" method="post" enctype="multipart/form-data">
                            <div class="form__text-inputs-wrapper">
                                <div class="form__text-inputs">
                                    <?= include_template('form/input-heading.php', ['errors_data' => $errors, 'title_field' => 'video']) ?>
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="video-url">Ссылка youtube <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= in_array('video-url', $errors) ? " form__input-section--error" : ""; ?>">
                                            <input class="adding-post__input form__input" id="video-url" type="text" name="video-url" placeholder="Введите ссылку" value="<?= $_POST['video-url']; ?>">
                                            <button class=" form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?= include_template('form/input-tag.php', ['errors_data' => $errors, 'title_field' => 'video']) ?>
                                </div>
                                <?php if (!empty($errors)) : ?>
                                    <?php $data_errors = ['errors' => $errors]; ?>
                                    <?= include_template('form/invalid-block.php', $data_errors) ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="post-type" value="video">
                            <div class="adding-post__buttons">
                                <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                <a class="adding-post__close" href="#">Закрыть</a>
                            </div>
                        </form>
                    </section>

                    <section class="adding-post__text tabs__content <?php if ($_POST['post-type'] == 'text') {
                                                                        echo 'tabs__content--active';
                                                                    } ?>">
                        <h2 class="visually-hidden">Форма добавления текста</h2>
                        <form class="adding-post__form form" action="./add.php" method="post">
                            <div class="form__text-inputs-wrapper">
                                <div class="form__text-inputs">
                                    <?= include_template('form/input-heading.php', ['errors_data' => $errors, 'title_field' => 'text']) ?>
                                    <div class="adding-post__textarea-wrapper form__textarea-wrapper">
                                        <label class="adding-post__label form__label" for="post-text">Текст поста <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= in_array('post-text', $errors) ? " form__input-section--error" : ""; ?>">
                                            <textarea class="adding-post__textarea form__textarea form__input" id="post-text" name="post-text" placeholder="Введите текст публикации"><?= $_POST['photo-tags']; ?></textarea>
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                        </div>
                                    </div>
                                    <?= include_template('form/input-tag.php', ['errors_data' => $errors, 'title_field' => 'text']) ?>
                                </div>
                                <?php if (!empty($errors)) : ?>
                                    <?php $data_errors = ['errors' => $errors]; ?>
                                    <?= include_template('form/invalid-block.php', $data_errors) ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="post-type" value="text">
                            <div class="adding-post__buttons">
                                <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                <a class="adding-post__close" href="#">Закрыть</a>
                            </div>
                        </form>
                    </section>

                    <section class="adding-post__quote tabs__content <?php if ($_POST['post-type'] == 'quote') {
                                                                            echo 'tabs__content--active';
                                                                        } ?>">
                        <h2 class="visually-hidden">Форма добавления цитаты</h2>
                        <form class="adding-post__form form" action="../add.php" method="post">
                            <div class="form__text-inputs-wrapper">
                                <div class="form__text-inputs">
                                    <?= include_template('form/input-heading.php', ['errors_data' => $errors, 'title_field' => 'quote']) ?>
                                    <div class="adding-post__input-wrapper form__textarea-wrapper">
                                        <label class="adding-post__label form__label" for="cite-text">Текст цитаты <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= in_array('quote-text', $errors) ? " form__input-section--error" : ""; ?>">
                                            <textarea class="adding-post__textarea adding-post__textarea--quote form__textarea form__input" id="cite-text" name="quote-text" placeholder="Текст цитаты"><?= $_POST['quote-text']; ?></textarea>
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                        </div>
                                    </div>
                                    <div class="adding-post__textarea-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="quote-author">Автор <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= in_array('quote-author', $errors) ? " form__input-section--error" : ""; ?>">
                                            <input class="adding-post__input form__input" id="quote-author" type="text" name="quote-author" value="<?= $_POST['quote-author']; ?>">
                                            <button class=" form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                        </div>
                                    </div>
                                    <?= include_template('form/input-tag.php', ['errors_data' => $errors, 'title_field' => 'quote']) ?>
                                </div>
                                <?php if (!empty($errors)) : ?>
                                    <?php $data_errors = ['errors' => $errors]; ?>
                                    <?= include_template('form/invalid-block.php', $data_errors) ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="post-type" value="quote">
                            <div class="adding-post__buttons">
                                <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                <a class="adding-post__close" href="#">Закрыть</a>
                            </div>
                        </form>
                    </section>

                    <section class="adding-post__link tabs__content <?php if ($_POST['post-type'] == 'link') {
                                                                        echo 'tabs__content--active';
                                                                    } ?>">
                        <h2 class="visually-hidden">Форма добавления ссылки</h2>
                        <form class="adding-post__form form" action="./add.php" method="post">
                            <div class="form__text-inputs-wrapper">
                                <div class="form__text-inputs">

                                    <?= include_template('form/input-heading.php', ['errors_data' => $errors, 'title_field' => 'link']) ?>
                                    <?= include_template('form/input-link.php', ['errors_data' => $errors]) ?>
                                    <?= include_template('form/input-tag.php', ['errors_data' => $errors, 'title_field' => 'link']) ?>
                                </div>
                                <?php if (!empty($errors)) : ?>
                                    <?php $data_errors = ['errors' => $errors]; ?>
                                    <?= include_template('form/invalid-block.php', $data_errors) ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="post-type" value="link">
                            <div class="adding-post__buttons">
                                <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                <a class="adding-post__close" href="#">Закрыть</a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>