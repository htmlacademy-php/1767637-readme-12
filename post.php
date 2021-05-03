<?php
declare(strict_types=1);
include_once 'init.php';
include_once 'helpers.php';
include_once 'functions/format_time.php';
if (!isset($_GET['id']) && empty($_GET['id'])) {
    http_response_code(404);
}
$id = (int) $_GET['id'];

function get_result_query($con, $sql, $id)
{
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return $result;
}

$sql = "SELECT * FROM posts p 
    JOIN users u ON p.author_id = u.id
    JOIN post_type t ON p.post_type_id = t.id
    WHERE p.id = ? ";
$sql_like = "SELECT COUNT(*) FROM user_post_like WHERE post_id = ? ";
$sql_comment = "SELECT COUNT(*) FROM comment WHERE post_id = ? ";
$sql_post_comment = "SELECT * FROM comment c JOIN users u ON c.user_id = u.id WHERE c.post_id = ?";

$post = get_result_query($con, $sql, $id);
$count_like = get_result_query($con, $sql_like, $id);
$count_comment = get_result_query($con, $sql_comment, $id);
$sql_post_comment = get_result_query($con, $sql_post_comment, $id);

$sql_user_posts = 'SELECT COUNT(*) FROM posts WHERE author_id =' . $post[0]['author_id'];
$sql_user_subscription = 'SELECT COUNT(*) FROM subscription WHERE user_id =' . $post[0]['author_id'];
$result_user_posts = mysqli_query($con, $sql_user_posts);
$count_user_posts = mysqli_fetch_all($result_user_posts, MYSQLI_ASSOC);
$result_user_subscription = mysqli_query($con, $sql_user_subscription);
$count_user_subscription = mysqli_fetch_all($result_user_subscription, MYSQLI_ASSOC);
print include_template('post.php', array('post' => $post[0],
                                        'post_like' => $count_like[0]['COUNT(*)'],
                                        'count_comment'  => $count_comment[0]['COUNT(*)'],
                                        'count_user_posts'  => $count_user_posts[0]['COUNT(*)'],
                                        'count_user_subscription' => $count_user_subscription[0]['COUNT(*)'],
                                        'post_comments' => $sql_post_comment,
                                        )
                                    );

