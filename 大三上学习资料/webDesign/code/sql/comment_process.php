<?php
session_start();
require('config.php');
@$db = new mysqli($db_host, $db_username, $db_password, $db_database);

if (mysqli_connect_errno()) {
    echo '错误: 无法连接到数据库. 请稍后再次重试.';
    exit;
}

// 设置字符集
$db->query("SET NAMES utf8");

// 获取评论信息
$postId = $_POST['post_id'];
$userId = $_POST['user_id'];
$commentContent = $_POST['comment_content'];

// 插入评论
$insertQuery = "INSERT INTO `comment` (`post_id`, `user_id`, `comment_content`, `comment_date`) VALUES ('$postId', '$userId', '$commentContent', NOW())";

if ($db->query($insertQuery)) {
    // 评论插入成功
    header("Location: comment_post.php?id=$postId");
    exit;
} else {
    // 评论插入失败，发出弹窗提醒
    echo '<script>alert("评论插入失败，请重试。");history.go(-1);</script>';
}

$db->close();
?>
