<?php
declare(strict_types=1);
include_once 'init.php';
include_once 'helpers.php';
include_once 'functions.php';

$user_name = 'Ann';
$errors = [];
$sql = 'SELECT name,title FROM post_type';

$post_types = get_result_query($con, $sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST) && !empty($_POST)) {
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    if (isset($_POST) && !empty($_POST)) {
        $sql = "SELECT id FROM hashtags  WHERE name ='" . $_POST['photo-tags'] . "'";
        $hashtag = get_result_query($con, $sql);
        $id_hashtag = $hashtag[0]['id'];

        if (empty($id_hashtag)) {
            $sql = "INSERT INTO hashtags SET name = ?";
            insert_query($con, $sql, ['name' => $_POST['photo-tags']]);
            $id_hashtag = mysqli_insert_id($con);           
        }
        //$author_id = getmyuid();

        // insert post
        if ($_POST['post-type'] == 'photo') {
            $sql = "INSERT INTO posts (post_type_id, title, image_url, author_id, cat_id, hashtags_id) VALUES ( 3, ?, ?, ?, ?)";
            $data = [
                'title' => $_POST['photo-heading'],
                'image_url' => $_POST['photo-url'],
                'author_id' => 1,
                'cat_id' => $_POST['cat_id'] ?? 1,
                'id_hashtag' => $id_hashtag
            ];
        } else if ($_POST['post-type'] == 'video') {
            $sql = "INSERT INTO posts (post_type_id, title, video_url, author_id, cat_id, hashtags_id) VALUES (5, ?, ?, ?, ?)";
            $data = [
                'title' => $_POST['video-heading'],
                'video_url' => $_POST['video-url'],
                'author_id' => 3,
                'cat_id' => $_POST['cat_id'],
            ];
        } else if ($_POST['post-type'] == 'text') {
            $sql = "INSERT INTO posts (post_type_id, title, content, author_id, cat_id, hashtags_id) VALUES (2, ?, ?, ?, ?)";
            $data = [
                'title' => $_POST['text-heading'],
                'content' => $_POST['post-text'],
                'author_id' => 2,
                'cat_id' => $_POST['cat_id'],
            ];
        } else if ($_POST['post-type'] == 'quote') {
            $sql = "INSERT INTO posts (post_type_id, title, content, author_id, cat_id, hashtags_id) VALUES (4, ?, ?, ?, ?)";
            $data = [
                'title' => $_POST['quote-heading'],
                'content' => $_POST['quote-text'],
                'author_id' => 1,
                'cat_id' => $_POST['cat_id'],
            ];
        } else if ($_POST['post-type'] == 'link') {
            $sql = "INSERT INTO posts (post_type_id, title, url, author_id, cat_id, hashtags_id) VALUES (2, ?, ?, ?, ?)";
            $data = [
                'title' => $_POST['quote-heading'],
                'url' => $_POST['post-link'],
                'author_id' => 2,
                'cat_id' => $_POST['cat_id'],
            ];
        }

       // $data = ['id_hashtag' => $id_hashtag];

       $res = insert_query($con, $sql, $data);

       if ($res) {
            $post_id = mysqli_insert_id($con);
            header("Location: /?id=" . $post_id);
        } else {
            $content = include_template('error.php');
        }
    }
} else {
    $content = include_template('add.php', array(
        'post_types' => $post_types,
        'errors' => $errors
    ));
}
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $required = ['photo-heading', 'video-url', 'video-heading', 'text-heading', 'post-text', 'quote-heading', 'quote-text', 'quote-author', 'link-heading', 'link-heading', 'post-link'];

//     $rules = [
//         'category_id' => function ($value) use ($cats_ids) {
//             return validateCategory($value, $cats_ids);
//         },
//         'quote-text' => function ($value, $errors) {
//             return validateLength($value, 70, $errors);
//         },
//         'video-url' => function($value) {
//             return filter_var($value, FILTER_VALIDATE_URL);
//         },
//         'photo-url' => function($value) {
//             return filter_var($value, FILTER_VALIDATE_URL);
//         },
//         'userpic-file-photo' => function ($value, $errors) {
//             return validateFile($value, $errors);
//         }
//     ];
// }

print include_template( 'layout.php', array('main' => $content, 'user_name' => $user_name, 'title' => 'readme: добавление публикации', 'is_auth' => 1));