<?php
declare(strict_types=1);
include_once 'init.php';
include_once 'helpers.php';
include_once 'functions.php';

$user_name = 'Ann';
$errors = [];
$sql = 'SELECT name,title FROM post_type';

$post_types = get_result_query($con, $sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required = ['photo-heading', 'video-url', 'video-heading', 'text-heading', 'post-text', 'quote-heading', 'quote-text', 'quote-author', 'link-heading', 'link-heading', 'post-link'];

    $rules = [
        'category_id' => function ($value) use ($cats_ids) {
            return validateCategory($value, $cats_ids);
        },
        'quote-text' => function ($value, $errors) {
            return validateLength($value, 70, $errors);
        },
        'video-url' => function($value) {
            return filter_var($value, FILTER_VALIDATE_URL);
        },
        'photo-url' => function($value) {
            return filter_var($value, FILTER_VALIDATE_URL);
        },
        'userpic-file-photo' => function ($value, $errors) {
            return validateFile($value, $errors);
        }
    ];
    // $url = filter_var($_POST['video-url'], FILTER_VALIDATE_URL);

    // foreach ($url as $key => $value) {
    //     if (isset($rules[$key])) {
    //         $rule = $rules[$key];
    //         $errors[$key] = $rule($value);
    //     }

    //     if (in_array($key, $required) && empty($value)) {
    //         $errors[$key] = "Поле $key надо заполнить";
    //     }
    // }

//     $errors = array_filter($errors);

//     if (count($errors)) {
//         $page_content = include_template('add.php', ['gif' => $gif, 'errors' => $errors, 'categories' => $categories]);
//     } else {
//         $sql = 'INSERT INTO gifs (dt_add, user_id, title, description, category_id, path) VALUES (NOW(), 1, ?, ?, ?, ?)';
//         $stmt = db_get_prepare_stmt($link, $sql, $gif);
//         $res = mysqli_stmt_execute($stmt);

//         if ($res) {
//             $gif_id = mysqli_insert_id($link);

//             header("Location: gif.php?id=" . $gif_id);
//         }
//     }
}

$add = include_template('add.php', array(
    'post_types' => $post_types,
    'errors' => $errors
));

print include_template( 'layout.php', array('main' => $add, 'user_name' => $user_name, 'title' => 'readme: добавление публикации', 'is_auth' => 1));