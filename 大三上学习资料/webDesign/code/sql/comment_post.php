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

// 获取文章ID和用户ID
$postId = $_GET['id'];
$userId = $_SESSION['userId'];

// 获取文章信息
$query = "SELECT * FROM `post` WHERE `id` = '$postId'";
$result = $db->query($query);

if ($result) {
    $row = $result->fetch_assoc();

    echo '<html>';
    echo '<head>';
    echo '<title>' . htmlspecialchars($row['post_title']) . '</title>';
    echo '<style>';
    echo 'body { font-family: Arial, sans-serif; background-color: #f4f4f4; }';
    echo '.container { max-width: 800px; margin: 0 auto; padding: 20px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }';
    echo 'h1 { color: #333; }';
    echo 'p { margin-bottom: 10px; }';
    echo 'textarea { width: 100%; }';
    echo 'form { margin-top: 20px; }';
    echo 'hr { border: 0; border-top: 1px solid #ccc; margin: 20px 0; }';
    echo '</style>';
    echo '</head>';
    echo '<body>';
    echo '<div class="container">';

    echo '<h1>' . htmlspecialchars($row['post_title']) . '</h1>';
    echo '<p>' . nl2br(htmlspecialchars($row['post_content'])) . '</p>';
    echo '<p>发表时间：' . htmlspecialchars($row['post_date']) . '</p>';

    // 显示已有评论
    echo '<h2>评论：</h2>';
    $commentQuery = "SELECT * FROM `comment` WHERE `post_id` = '$postId'";
    $commentResult = $db->query($commentQuery);

    if ($commentResult) {
        while ($commentRow = $commentResult->fetch_assoc()) {
            // 输出评论用户的用户名
            $commentUserId = $commentRow['user_id'];
            $commentUserQuery = "SELECT * FROM `user` WHERE `id` = '$commentUserId'";
            $commentUserResult = $db->query($commentUserQuery);
            $commentUserRow = $commentUserResult->fetch_assoc();
            echo '<p><strong>' . htmlspecialchars($commentUserRow['username']) . '：</strong></p>';
            echo '<p>' . htmlspecialchars($commentRow['comment_content']) . '</p>';
            echo '<p>评论时间：' . htmlspecialchars($commentRow['comment_date']) . '</p>';
            //输出分割线
            echo '<hr>';
        }
        $commentResult->free();
    } else {
        echo '获取评论失败';
    }

    // 显示评论输入框和提交按钮
    echo '<h2>发表评论：</h2>';
    echo '<form action="comment_process.php" method="post">';
    echo '<input type="hidden" name="post_id" value="' . $postId . '">';
    echo '<input type="hidden" name="user_id" value="' . $userId . '">';
    echo '<textarea name="comment_content" rows="4" cols="50" required></textarea><br>';
    echo '<input type="submit" value="提交评论">';
    echo '</form>';
    // 显示返回按钮
    echo '<p><a href="list_post.php">返回文章列表</a></p>';

    echo '</div>';
    echo '</body>';
    echo '</html>';
} else {
    echo '获取文章失败';
}

$result->free();
$db->close();
?>
