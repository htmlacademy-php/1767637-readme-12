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
                <?php $i = 1; ?>
                <?php foreach ($articles as $article) : ?>

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
                                        <?php
                                            $time  = time() - strtotime(generate_random_date($i));
                                            $time = ($time < 1) ? 1 : $time;

                                            $minutes_plus = array(' минута ', ' минуты ', ' минут ');
                                            $hours_plus = array(' час ', ' часа ', ' часов ');
                                            $days_plus = array(' день ', ' дня ', ' дней ');
                                            $weeks_plus = array(' неделя ', ' недели ', ' недель ');
                                            $months_plus = array(' месяц ', ' месяца ', ' месяцев ');
                                            $years_plus = array(' год ', ' года ', ' лет ');

                                            $years = floor($time / 31536000);
                                            $months = floor(($time / 2592000) % 360);
                                            $weeks = floor(($time / 604800) % 12);
                                            $days =   floor(($time / 86400) % 7);
                                            $hours =  floor(($time / 3600) % 7);
                                            $minutes = floor(($time / 60) % 24);

                                            $months = ltrim($months, 0);
                                            $weeks = ltrim($weeks, 0);
                                            $days = ltrim($days, 0);
                                            $hours = ltrim($hours, 0);
                                            $minutes = ltrim($minutes, 0);

                                            if ($years < 1 ) :
                                              $years = '';
                                            elseif ($years > 4 ) :
                                                $years .= $years_plus[2];
                                            elseif ($years === 1) :
                                                $years .= $years_plus[0];
                                            else :
                                                $years .= $years_plus[1];
                                            endif;

                                            if ($months< 1) :
                                                $$months = '';
                                            elseif ($months > 4) :
                                                $months .= $months_plus[2];
                                            elseif ($months === 1) :
                                                $months .= $months_plus[0];
                                            else :
                                                $months .= $months_plus[1];
                                            endif;

                                            if ($days < 1) :
                                                $days = '';
                                            elseif ($days > 4) :
                                                $days .= $days_plus[2];
                                            elseif ($days === 1) :
                                                $days .= $days_plus[0];
                                            else :
                                                $days .= $days_plus[1];
                                            endif;

                                            if ($weeks < 1) :
                                                $weeks = '';
                                            elseif ($weeks > 4) :
                                                $weeks .= $weeks_plus[2];
                                            elseif ($weeks === 1) :
                                                $weeks .= $weeks_plus[0];
                                            else :
                                                $weeks .= $weeks_plus[1];
                                            endif;

                                            if ($hours < 1) :
                                                $hours = '';
                                            elseif ($hours > 4) :
                                                $hours .= $hours_plus[2];
                                            elseif ($hours === 1) :
                                                $hours .= $hours_plus[0];
                                            else :
                                                $hours .= $hours_plus[1];
                                            endif;

                                            if ($minutes < 1) :
                                                $minutes = '';
                                            elseif ($minutes > 4) :
                                                $minutes .= $minutes_plus[2];
                                            elseif ($minutes === 1) :
                                                $minutes .= $minutes_plus[0];
                                            else :
                                                $minutes .= $minutes_plus[1];
                                            endif;
                                        ?>
                                        <time class="post__time" datetime="<?= $time; ?>" title="<?= generate_random_date($i); ?>"><?= $years  . $months . $weeks . $days . $hours . $minutes; ?></time>
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