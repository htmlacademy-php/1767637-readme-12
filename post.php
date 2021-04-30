<?php
declare(strict_types=1);
include_once 'init.php';
include_once 'helpers.php';
include_once 'functions/format_time.php';
if (!isset($_GET['id']) && empty($_GET['id'])) {
    http_response_code(404);
}
$sql = 'SELECT * FROM posts p 
    JOIN users u ON p.author_id = u.id
    JOIN post_type t ON p.post_type_id = t.id
    WHERE p.id = ' . $_GET['id'];
$sql_like = 'SELECT COUNT(*) FROM user_post_like WHERE post_id =' . $_GET['id'];
$sql_comment = 'SELECT COUNT(*) FROM comment WHERE post_id =' . $_GET['id'];
$sql_post_comment = 'SELECT * FROM comment c JOIN users u ON c.user_id = u.id WHERE c.post_id =' . $_GET['id'];

$result = mysqli_query($con, $sql);
$result_like = mysqli_query($con, $sql_like);
$result_comment = mysqli_query($con, $sql_comment);
$result_post_comment = mysqli_query($con, $sql_post_comment);

if (!$result) {
    show_error($con, mysqli_error($result));
}
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$count_like = mysqli_fetch_all($result_like, MYSQLI_ASSOC);
$count_comment = mysqli_fetch_all($result_comment, MYSQLI_ASSOC);
$sql_post_comment = mysqli_fetch_all($result_post_comment, MYSQLI_ASSOC);

$sql_user_posts = 'SELECT COUNT(*) FROM posts WHERE author_id =' . $rows[0]['author_id'];
$sql_user_subscription = 'SELECT COUNT(*) FROM subscription WHERE user_id =' . $rows[0]['author_id'];
$result_user_posts = mysqli_query($con, $sql_user_posts);
$count_user_posts = mysqli_fetch_all($result_user_posts, MYSQLI_ASSOC);
$result_user_subscription = mysqli_query($con, $sql_user_subscription);
$count_user_subscription = mysqli_fetch_all($result_user_subscription, MYSQLI_ASSOC);
print include_template('post.php', array('post' => $rows[0],
                                        'post_like' => $count_like[0]['COUNT(*)'],
                                        '$count_comment'  => $count_comment[0]['COUNT(*)'],
                                        'count_user_posts'  => $count_user_posts[0]['COUNT(*)'],
                                        'count_user_subscription' => $count_user_subscription[0]['COUNT(*)'],
                                        'post_comments' => $sql_post_comment,
                                        )
                                    );

