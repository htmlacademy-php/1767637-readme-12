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

// function validateLength($str, int $length =70, array $errors = []) {
//     if(strlen($str) <= $length) {
//         return '';
//     }
//     return $errors['text'] = 'short';
// }

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

// function validateLengthMax($value, $max)
// {
//     if ($value) {
//         $len = strlen($value);
//         if ($len > $max) {
//             return "Значение должно быть до $max символов";
//         }
//     }

//     return null;
// }

// validate
function getValidationRules(array $rules): array
{
    $result = [];
    foreach ($rules as $fieldName => $rule) {
        $result[$fieldName] = explode('|', $rule);
    }

    return $result;
}

function getValidationMethodName(string $name): string
{
    $studlyWords = str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $name)));
    return "validate{$studlyWords}";
}

function getValidationNameAndParameters(string $rule): array
{
    $nameParams = explode(':', $rule);
    $parameters = [];
    $name = $nameParams[0];
    if (isset($nameParams[1])) {
        $parameters = explode(',', $nameParams[1]);
    }

    return [$name, $parameters];
}

function validateRequired(array $inputArray, string $parameterName): ?string
{
    return !array_key_exists($parameterName, $inputArray) ? "Поле $parameterName должно быть заполнено" : null;
}

function validateString(array $inputArray, string $parameterName): ?string
{
    if (!array_key_exists($parameterName, $inputArray)) {
        return null;
    }

    return !is_string($inputArray[$parameterName]) ? "Поле $parameterName должно быть строкой" : null;
}


function validateMax(array $inputArray, string $parameterName, int $count): ?string
{
    if (!array_key_exists($parameterName, $inputArray)) {
        return null;
    }

    return mb_strlen($inputArray[$parameterName]) > $count ? "Поле $parameterName должно быть длиной менее $count символов" : null;
}
function crop_text_content(string $text, int $post_id, string $style = '', int $num_letters = 300): string
{
    $style = $style ? " style=\"{$style}\"" : '';
    $text_length = mb_strlen($text);

    if ($text_length > $num_letters) {
        $words = explode(' ', $text);
        $result_words_length = 0;
        $result_words = [];

        foreach ($words as $word) {
            $result_words_length += mb_strlen($word);

            if ($result_words_length > $num_letters) {
                break;
            }

            $result_words_length += 1;
            $result_words[] = $word;
        }

        $result = implode(' ', $result_words);

        $result .= '...';
        $result = "<p{$style}>" . $result . '</p>';
        $result .= '<a class="post-text__more-link" href="post.php?id=' . $post_id . '">Читать далее</a>';
    } else {
        $result = "<p{$style}>" . $text . '</p>';
    }

    return $result;
}