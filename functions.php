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

function html($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function validateLength($str, int $length =70, array $errors = []) {
    if(strlen($str) <= $length) {
        return '';
    }
    return $errors['text'] = 'short';
}

function validateFile($value, array $errors = []) {
    if (!empty($value['name'])) {
        $tmp_name = $value['tmp_name'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type !== "image/gif" || $file_type !== "image/png" || $file_type !== "image/jpeg") {
            return $errors['file'] = 'error';
        } 
    }
    
    return  $errors['file'] = 'empty';
}

function getPostVal($name)
{
    return filter_input(INPUT_POST, $name);
}

function validateLengthMax($value, $max)
{
    if ($value) {
        $len = strlen($value);
        if ($len > $max) {
            return "Значение должно быть до $max символов";
        }
    }

    return null;
}

// function validateRequired($rules) {
//     if (($rules[$key] == 'required') && empty($_POST[$key])) {
//         if (
//             $rules[$key] == 'photo-heading' || $rules[$key] == 'video-heading' || $rules[$key] == 'text-heading' ||
//             $rules[$key] == 'quote-heading' || $rules[$key] == 'link-heading'
//         ) {
//             $field = 'Заголовок';
//         }
//         if ($rules[$key] == 'video-url' || $rules[$key] == 'post-link') {
//             $field = 'Ссылка';
//         }
//         if ($rules[$key] == 'quote-author') {
//             $field = 'Автор';
//         }
//         if ($rules[$key] == 'post-text' || $rules[$key] == 'quote-text') {
//             $field = 'с Текстом';
//         }
//         $errors[$key] = "Поле $field надо заполнить";
//     }
// }