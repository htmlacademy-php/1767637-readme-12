<?php
include_once 'functions.php';
?>
<section class="page__main page__main--popular">
    <div class="container">
        <h1 class="page__title page__title--popular">Популярное</h1>
    </div>
    <div class="popular container">
        <div class="popular__filters-wrapper">
            <div class="popular__sorting sorting">
                <b class="popular__sorting-caption sorting__caption">Сортировка:</b>
                <ul class="popular__sorting-list sorting__list">
                    <li class="sorting__item sorting__item--popular">
                        <a class="sorting__link sorting__link--active" href="#">
                            <span>Популярность</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="sorting__item">
                        <a class="sorting__link" href="#">
                            <span>Лайки</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="sorting__item">
                        <a class="sorting__link" href="#">
                            <span>Дата</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="popular__filters filters">
                <b class="popular__filters-caption filters__caption">Тип контента:</b>
                <ul class="popular__filters-list filters__list">
                    <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
                        <a class="filters__button filters__button--ellipse filters__button--all <?= !isset($_GET['post_type']) || empty($_GET['post_type']) ? 'filters__button--active' : '' ?>" href="/">
                            <span>Все</span>
                        </a>
                    </li>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--photo button <?= isset($_GET['post_type']) && $_GET['post_type'] === 'photo' ? 'filters__button--active' : ''; ?>" href="?post_type=photo">
                            <span class="visually-hidden">Фото</span>
                            <svg class="filters__icon" width="22" height="18">
                                <use xlink:href="#icon-filter-photo"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--video button <?= isset($_GET['post_type']) && $_GET['post_type'] === 'video' ? 'filters__button--active' : ''; ?>" href="?post_type=video">
                            <span class="visually-hidden">Видео</span>
                            <svg class="filters__icon" width="24" height="16">
                                <use xlink:href="#icon-filter-video"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--text button <?= isset($_GET['post_type']) && $_GET['post_type'] === 'text' ? 'filters__button--active' : ''; ?>" href="?post_type=text">
                            <span class="visually-hidden">Текст</span>
                            <svg class="filters__icon" width="20" height="21">
                                <use xlink:href="#icon-filter-text"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--quote button <?= isset($_GET['post_type']) && $_GET['post_type'] === 'quote' ? 'filters__button--active' : ''; ?>" href="?post_type=quote">
                            <span class="visually-hidden">Цитата</span>
                            <svg class="filters__icon" width="21" height="20">
                                <use xlink:href="#icon-filter-quote"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--link button <?= isset($_GET['post_type']) && $_GET['post_type'] === 'link' ? 'filters__button--active' : ''; ?>" href="?post_type=link">
                            <span class="visually-hidden">Ссылка</span>
                            <svg class="filters__icon" width="21" height="18">
                                <use xlink:href="#icon-filter-link"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="popular__posts">
            <?php  
             foreach ($articles as $article) : ?>
                 <article class="popular__post post <?= html($article['post_type_id']) ?? ''; ?>">
                    <header class="post__header">
                        <h2>
                            <!--здесь заголовок-->
                           
                            <a href="/post.php?id=<?= $article['id']; ?>"><?= html($article['title']) ?? ''; ?></a>
                        </h2>
                    </header>
                    <div class="post__main">
                        <!--здесь содержимое карточки-->
                        <?php if ($article['name'] === 'text') : ?>
                            <p>
                                <!--здесь текст-->
                                <?= prepare_card_text($article['content'] ?? ''); ?>
                            </p>
                        <?php elseif ($article['name'] === 'photo') : ?>
                            <!--содержимое для поста-фото-->
                            <div class="post-photo__image-wrapper">
                                  <img src="<?= $article['image_url'] ?? ''; ?>" alt="Фото от пользователя" width="360" height="240">
                            </div>
                        <?php elseif ($article['name'] === 'link') : ?>
                            <a class="post-link__external" href="http://<?= $article['url'] ?? ''; ?>" title="Перейти по ссылке">
                                <div class="post-link__info-wrapper">
                                    <div class="post-link__icon-wrapper">
                                        <img src="https://www.google.com/s2/favicons?domain=vitadental.ru" alt="Иконка">
                                    </div>
                                </div>
                                <span>
                                    <!--здесь текст-->
                                    <?= html($article['content']) ?? ''; ?>
                                </span>
                            </a>
                        <?php elseif ($article['name'] === 'quote') : ?>
                            <blockquote>
                                <p>
                                    <!--здесь ссылка-->
                                    <?= $article['url'] ?? ''; ?>
                                </p>
                            </blockquote>

                        <?php endif;   ?>
                    </div>
                    <footer class="post__footer">
                        <div class="post__author">
                            <a class="post__author-link" href="#" title="Автор">
                                <div class="post__avatar-wrapper">
                                    <!--укажите путь к файлу аватара-->
                                    <?php if (isset($article['avatar']) && !empty($article['avatar'])) : ?>
                                        <img class="post__author-avatar" src="img/<?= $article['avatar']; ?>" alt="Аватар пользователя">
                                    <?php endif; ?>
                                </div>
                                <div class="post__info">
                                    <b class="post__author-name">
                                        <!--здесь имя пользоателя-->
                                        <?= html($article['login']); ?>
                                    </b>
                                    <time class="post__time" datetime="<?= strtotime($article['date_create']); ?>" title="<?= $article['date_create']; ?>"><?= format_time($article['date_create']) . ' назад'; ?></time>
                                </div>
                            </a>
                        </div>
                        <div class="post__indicators">
                            <div class="post__buttons">
                                <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                    <svg class="post__indicator-icon" width="20" height="17">
                                        <use xlink:href="#icon-heart"></use>
                                    </svg>
                                    <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                                        <use xlink:href="#icon-heart-active"></use>
                                    </svg>
                                    <span>0</span>
                                    <span class="visually-hidden">количество лайков</span>
                                </a>
                                <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                    <svg class="post__indicator-icon" width="19" height="17">
                                        <use xlink:href="#icon-comment"></use>
                                    </svg>
                                    <span>0</span>
                                    <span class="visually-hidden">количество комментариев</span>
                                </a>
                            </div>
                        </div>
                    </footer>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>