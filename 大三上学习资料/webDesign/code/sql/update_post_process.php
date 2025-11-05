<?php
require('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单提交的数据
    $post_id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // 连接数据库
    @ $db = new mysqli($db_host, $db_username, $db_password, $db_database);

    if (mysqli_connect_errno()) {
        echo '错误: 无法连接到数据库. 请稍后再次重试.';
        exit;
    }

    // 设置字符集
    $db->query("SET NAMES utf8");

    // 更新文章
    $query = "UPDATE post SET post_title = '$title', post_content = '$content' WHERE id = $post_id";
    $db->query($query);

    // 关闭数据库连接
    $db->close();
}

// 跳转回文章列表页面
header('Location: list_post.php');
exit;
?>
