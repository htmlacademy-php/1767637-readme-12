<?php

declare(strict_types=1);
include_once 'helpers.php';
$is_auth = rand(0, 1);
$title = 'readme: популярное';

$user_name = 'Ann'; // укажите здесь ваше имя

function get_time($i)
{
    $time  = time() - strtotime(generate_random_date($i));
    $time = ($time < 1) ? 1 : $time;

    $years = floor($time / 31536000);
    $months = floor(($time / 2592000) % 360);
    $weeks = floor(($time / 604800) % 12);
    $days = floor(($time / 86400) % 7);
    $hours =  floor(($time / 3600) % 7);
    $minutes = floor(($time / 60) % 24);

    if($time / 31536000 > 0) {
        $years = floor($time / 31536000);
        //$years = ltrim($years, "0");
        $time_arr = array('years' => $years );
    } elseif ($time / 2592000 > 0) {
        $months = floor(($time / 2592000) % 360);
        //$months = ltrim($months, "0");
        $time_arr = array('months' => $months);
    } elseif ($time / 604800 > 0 && $time / 31536000 < 0 ) {
        $weeks = floor(($time / 604800) % 12);
       // $weeks = ltrim($weeks, "0");
        $time_arr = array('weeks' => $weeks);
    } elseif ($time / 86400 > 0 && $time / 2592000 < 0 ) {
        $days = floor(($time / 86400) % 7);
       // $days = ltrim($days, "0");
        $time_arr = array('days' => $days);
    } elseif ($time / 60 > 0 && $time / 604800 < 0) {
        $days = floor(($time / 86400) % 7);
        //$minutes = ltrim($minutes, "0");
        $time_arr = array('minutes' => $minutes);
    }
    
    return $time_arr;
}
function view_time($i)
{
    $time_arr = get_time($i);
    extract($time_arr);
    return $years . $months . $weeks . $days . $hours . $minutes;
}

$articles = [
    [
        'title' => 'Цитата',
        'type' => 'post-quote',
        'content' => 'Мы в жизни любим только раз, а после ищем лишь похожих',
        'user_name' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg',
        'time' => view_time(0)
    ],
    [
        'title' => 'Игра престолов',
        'type' => 'post-text',
        'content' => 'Не могу дождаться начала финального сезона своего любимого сериала!',
        'user_name' => 'Владик',
        'avatar' => 'userpic.jpg',
        'time' => view_time(1)
    ],
    [
        'title' => 'Наконец, обработал фотки!',
        'type' => 'post-photo',
        'content' => 'rock-medium.jpg',
        'user_name' => 'Виктор',
        'avatar' => 'userpic-mark.jpg',
        'time' => view_time(2)
    ],
    [
        'title' => 'Моя мечта',
        'type' => 'post-photo',
        'content' => 'coast-medium.jpg',
        'user_name' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg',
        'time' => view_time(3)
    ],
    [
        'title' => 'Лучшие курсы',
        'type' => 'post-link',
        'content' => 'www.htmlacademy.ru',
        'user_name' => 'Владик',
        'avatar' => 'userpic.jpg',
        'time' => view_time(4)
    ]
];

function crop_text(string $str, int $length = 300): string
{
    $count_all = 0;
    $count = 0;
    $text_arr = explode(' ', $str);

    if (strlen($str) < $length) {
        return $str;
    }
    foreach ($text_arr as $item) {

        if ($count_all >= $length) {
            break;
        }
        $count_all += strlen($item) + 1;
        $count++;

    }

    $array = array_slice($text_arr, 0, $count);
    $content = implode(" ", $array);

    return $content;
}

function prepare_card_text(string $input, int $length = 300): string
{
    if (strlen($input) < $length) {
        return $input;
    }

    $text = '<p>' . crop_text($input, $length) . '</p>';
    $text .= '<a class="post-text__more-link" href="#">Читать далее</a>';
    return $text;
}

$main = include_template('main.php', array('articles'=> $articles));

print include_template('layout.php', array('main' => $main, 'user_name' => $user_name,'title' => $title ));