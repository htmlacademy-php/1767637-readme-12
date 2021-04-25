<?php

declare(strict_types=1);
include_once 'init.php';
include_once 'helpers.php';
$is_auth = rand(0, 1);
$title = 'readme: популярное';

$user_name = 'Ann'; // укажите здесь ваше имя

$sql = 'SELECT * FROM posts p 
    JOIN users u ON p.author_id = u.id
    JOIN post_type t ON p.post_type_id = t.id
    ORDER BY views_number ASC LIMIT 10';

$result = mysqli_query($con, $sql);

if (!$result) {
    show_error($con, mysqli_error($result));
}
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

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

$main = include_template('main.php', array('articles'=> $posts, 'post_type' => $post_type));

print include_template('layout.php', array('main' => $main, 'user_name' => $user_name,'title' => $title ));