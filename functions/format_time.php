<?php
function format_time($time): string
{
    $time  = time() - strtotime($time);
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
        case ($time / 3600 > 24 && $time / 86400 < 7):
            $days = floor($time / 86400);
            $time = $days . get_noun_plural_form($days, ' день', ' дня', ' дней');
            break;
        case ($time / 86400 > 7 && $time / 604800 < 5):
            $weeks = floor($time / 604800);
            $time = $weeks . get_noun_plural_form($weeks, ' неделя', ' недели', ' недель');
            break;
        case ($time / 604800 > 5 && $time / 2592000 < 12):
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