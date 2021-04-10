    
<?php
function get_time($i)
{
    $time  = time() - strtotime(generate_random_date($i));
    $time = ($time < 1) ? 1 : $time;

    switch ($time) {
        case ($time / 60 < 60):
            $minutes = floor($time / 60);
            $time = $minutes . get_noun_plural_form($minutes, ' минута', ' минуты', ' минут');
            break;
        case ($time / 60 > 60 && $time / 3600 < 24):
            $hours = floor($time / 3600);
            $time = $hours . get_noun_plural_form($hours, ' час', ' часа', ' часов');
            break;
        case ($time / 3600 > 24 && $time / 86400 < 7 ):
            $days = floor($time / 86400) ;
            $time = $days . get_noun_plural_form($days, ' день', ' дня', ' дней');
            break;
        case ($time / 86400 > 7 && $time / 604800 < 5):
            $weeks = floor($time / 604800);
            $time = $weeks . get_noun_plural_form($weeks, ' неделя', ' недели', ' недель' );
            break;
        case ( $time / 604800 > 5 && $time / 2592000 < 12):
            $months = floor($time / 2592000);
            $time = $months . get_noun_plural_form($months, ' месяц', ' месяца', ' месяцев');
            break;
        case ($time / 31536000 > 0):
            $years = floor($time / 31536000);
            $time = $years . get_noun_plural_form($years, ' год', ' года', ' года');
            break;
        default:
            echo $time;
    }

    return $time;
}
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
                            <a class="filters__button filters__button--ellipse filters__button--all filters__button--active" href="#">
                                <span>Все</span>
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--photo button" href="#">
                                <span class="visually-hidden">Фото</span>
                                <svg class="filters__icon" width="22" height="18">
                                    <use xlink:href="#icon-filter-photo"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--video button" href="#">
                                <span class="visually-hidden">Видео</span>
                                <svg class="filters__icon" width="24" height="16">
                                    <use xlink:href="#icon-filter-video"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--text button" href="#">
                                <span class="visually-hidden">Текст</span>
                                <svg class="filters__icon" width="20" height="21">
                                    <use xlink:href="#icon-filter-text"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--quote button" href="#">
                                <span class="visually-hidden">Цитата</span>
                                <svg class="filters__icon" width="21" height="20">
                                    <use xlink:href="#icon-filter-quote"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--link button" href="#">
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
                <?php foreach ($articles as $i => $article) : ?>

                    <article class="popular__post post <?= $article['type'] ?? ''; ?>">
                        <header class="post__header">
                            <h2>
                                <!--здесь заголовок-->
                                <?= $article['title'] ?? ''; ?>
                            </h2>
                        </header>
                        <div class="post__main">
                            <!--здесь содержимое карточки-->
                            <?php if ($article['type'] === 'post-text') : ?>
                                <p>
                                    <!--здесь текст-->
                                    <?= prepare_card_text($article['content'] ?? ''); ?>
                                </p>
                            <?php elseif ($article['type'] === 'post-photo') : ?>
                                <!--содержимое для поста-фото-->
                                <div class="post-photo__image-wrapper">
                                    <img src="img/<?= $article['content'] ?? ''; ?>" alt="Фото от пользователя" width="360" height="240">
                                </div>
                            <?php elseif ($article['type'] === 'post-link') : ?>
                                <a class="post-link__external" href="http://<?= $article['content'] ?? ''; ?>" title="Перейти по ссылке">
                                    <div class="post-link__info-wrapper">
                                        <div class="post-link__icon-wrapper">
                                            <img src="https://www.google.com/s2/favicons?domain=vitadental.ru" alt="Иконка">
                                        </div>
                                    </div>
                                    <span>
                                        <!--здесь ссылка-->
                                        <?= $article['content'] ?? ''; ?>
                                    </span>
                                </a>
                            <?php elseif ($article['type'] === 'post-quote') : ?>
                                <blockquote>
                                    <p>
                                        <!--здесь текст-->
                                        <?= $article['content'] ?? ''; ?>
                                    </p>
                                </blockquote>

                            <?php endif;   ?>
                        </div>
                        <footer class="post__footer">
                            <div class="post__author">
                                <a class="post__author-link" href="#" title="Автор">
                                    <div class="post__avatar-wrapper">
                                        <!--укажите путь к файлу аватара-->
                                        <img class="post__author-avatar" src="img/<?= $article['avatar']; ?>" alt="Аватар пользователя">
                                    </div>
                                    <div class="post__info">
                                        <b class="post__author-name">
                                            <!--здесь имя пользоателя-->
                                            <?= $article['user_name']; ?>
                                        </b>
                                        <time class="post__time" datetime="<?= strtotime(generate_random_date($i)); ?>" title="<?= generate_random_date($i); ?>"><?= get_time($i) . ' назад'; ?></time>
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
                    <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>