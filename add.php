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
    $rules = [
        'photo-heading' => 'required',
        'video-heading' => 'required' ,
        'video-url' => 'required',
        'text-heading' => 'required',
        'post-text' => 'required',
        'quote-heading' => 'required',
        'quote-text' => 'required|lengthMax:70',
        'quote-author' => 'required',
        'link-heading' => 'required',
        'post-link' => 'required',
    ];

    foreach ($_POST as $key => $value) {
        $field_val = $rules[$key];
        if (array_key_exists($key, $rules)) {
            var_dump(stristr($field_val, 'required'));
            if (stristr($field_val, 'lengthMax') == TRUE) {
                $val = stristr($rules[$key], 'lengthMax');
                $max_val = ltrim($val, ':');
                validateLengthMax($_POST[$key], $max_val);
            }

            if ((stristr($field_val, 'required') == TRUE) && empty($_POST[$key])) {
                var_dump(stristr($field_val, 'required'));
                if ($rules[$key] == 'photo-heading' || $rules[$key] == 'video-heading'|| $rules[$key] == 'text-heading'|| 
                $rules[$key] == 'quote-heading' || $rules[$key] == 'link-heading') {
                    $field = 'Заголовок';
                }
                if ($rules[$key] == 'video-url' || $rules[$key] == 'post-link') {
                    $field = 'Ссылка';
                }
                if ($rules[$key] == 'quote-author') {
                    $field = 'Автор';
                }
                if ($rules[$key] == 'post-text' || $rules[$key] == 'quote-text') {
                    $field = 'с Текстом';
                }
                
                $errors[$key] = "Поле $field надо заполнить";
            }
        }
    }
    if(empty($errors)) {
        $str_tags = trim($_POST['photo-tags']);
        $tags = explode(" ", $str_tags);
        foreach ($tags as $tag) {
            $data = ['name' => $tag];
            $sql = "SELECT id FROM hashtags  WHERE name = ? ";
            $hashtag = get_result_query($con, $sql, $data);
            $id_hashtag = $hashtag[0]['id'];

            if (empty($id_hashtag)) {
                $sql = "INSERT INTO hashtags SET name = ?";

                $res = db_get_prepare_stmt($con, $sql, $data);
                mysqli_stmt_execute($res);
                $id_hashtag = mysqli_insert_id($con);
            }
        }
        // insert post
        if ($_POST['post-type'] == 'photo') {
            $sql = "INSERT INTO posts (post_type_id, title, url, image_url, author_id, cat_id, hashtags_id) VALUES ( 3, ?, ?, ?, ?, ?, ?)";
            $file_url = '';
            if (isset($_FILES['file'])) {
                $file_name = $_FILES['file']['name'];
                $file_path = __DIR__ . '/uploads/';
                $file_url = '/uploads/' . $file_name;
                move_uploaded_file($_FILES['file']['tmp_name'], $file_path . $file_name);

                if (empty($file_url)) {
                    $photo_url = $_POST['photo-url'];
                } else {
                    $photo_url = '';
                }
            }

            $data = [
                'title' => $_POST['photo-heading'],
                'url' => $photo_url,
                'image_url' => $file_url,
                'author_id' => 1,
                'cat_id' => $_POST['cat_id'] ?? 1,
                'id_hashtag' => $id_hashtag
            ];
        } else if ($_POST['post-type'] == 'video') {
            $sql = "INSERT INTO posts (post_type_id, title, video_url, author_id, cat_id, hashtags_id) VALUES (5, ?, ?, ?, ?, ?)";
            $data = [
                'title' => $_POST['video-heading'],
                'video_url' => $_POST['video-url'],
                'author_id' => 3,
                'cat_id' => $_POST['cat_id'],
                'id_hashtag' => $id_hashtag
            ];
        } else if ($_POST['post-type'] == 'text') {
            $sql = "INSERT INTO posts (post_type_id, title, content, author_id, cat_id, hashtags_id) VALUES (2, ?, ?, ?, ?, ?)";
            $data = [
                'title' => $_POST['text-heading'],
                'content' => $_POST['post-text'],
                'author_id' => 2,
                'cat_id' => $_POST['cat_id'],
                'id_hashtag' => $id_hashtag
            ];
        } else if ($_POST['post-type'] == 'quote') {
            $sql = "INSERT INTO posts (post_type_id, title, content, author_id, cat_id, hashtags_id) VALUES (4, ?, ?, ?, ?, ?)";
            $data = [
                'title' => $_POST['quote-heading'],
                'content' => $_POST['quote-text'],
                'author_id' => 1,
                'cat_id' => $_POST['cat_id'],
                'id_hashtag' => $id_hashtag
            ];
        } else if ($_POST['post-type'] == 'link') {
            $sql = "INSERT INTO posts (post_type_id, title, url, author_id, cat_id, hashtags_id) VALUES (2, ?, ?, ?, ?, ?)";
            $data = [
                'title' => $_POST['quote-heading'],
                'url' => $_POST['post-link'],
                'author_id' => 2,
                'cat_id' => $_POST['cat_id'],
                'id_hashtag' => $id_hashtag
            ];
        }

        $res = db_get_prepare_stmt($con, $sql, $data);
        mysqli_stmt_execute($res);

        if ($res) {
            $post_id = mysqli_insert_id($con);
            header("Location: /post.php?id=" . $post_id);
        } 
    } else {
        $content = include_template('add.php', array(
            'post_types' => $post_types,
            'errors' => $errors
        ));
        
    }
} else {
    $content = include_template('add.php', array(
        'post_types' => $post_types,
    ));
}

print include_template( 'layout.php', array('main' => $content, 'user_name' => $user_name, 'title' => 'readme: добавление публикации', 'is_auth' => 1));