<?php
require('config.php');

// 获取要删除的文章 ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = $_GET['id'];

    // 连接数据库
    @ $db = new mysqli($db_host, $db_username, $db_password, $db_database);

    if (mysqli_connect_errno()) {
        echo '错误: 无法连接到数据库. 请稍后再次重试.';
        exit;
    }

    // 删除文章
    $query = "DELETE FROM post WHERE id = $post_id";
    $db->query($query);

    // 关闭数据库连接
    $db->close();
}

// 跳转回文章列表页面
header('Location: list_post.php');
exit;
?>
