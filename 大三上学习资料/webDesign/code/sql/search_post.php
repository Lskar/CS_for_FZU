<?php
session_start();
require('config.php');

// Ensure the search_content parameter is set
if (isset($_POST['search_content'])) {
    @$db = new mysqli($db_host, $db_username, $db_password, $db_database);

    if (mysqli_connect_errno()) {
        echo '错误: 无法连接到数据库. 请稍后再次重试.';
        exit;
    }

    // Set character set
    $db->query("SET NAMES utf8");

    // Escape and sanitize the search content
    $searchContent = $db->real_escape_string($_POST['search_content']);

    // Perform the search query
    $query = "SELECT * FROM post WHERE post_title LIKE '%$searchContent%' OR post_content LIKE '%$searchContent%'";
    $result = $db->query($query);

    if ($result) {
        $num_results = $result->num_rows;

        echo '<p>搜索结果: ' . $num_results . ' 篇</p>';

        for ($i = 0; $i < $num_results; $i++) {
            $row = $result->fetch_assoc();
            echo '<h2>' . ($i + 1) . '.  ' . htmlspecialchars(stripslashes($row['post_title'])) . "</h2>\n";
            echo '<p>发表时间：' . htmlspecialchars(stripslashes($row['post_date'])) . "</p>\n";

            // Display the operations only when the user is logged in
            if (isset($_SESSION['username'])) {
                echo '<p>操作： <a href="update_post.php?id=' . $row['id'] . '">修改</a> | <a href="delete_post.php?id=' . $row['id'] . '">删除</a> | <a href="comment_post.php?id=' . $row['id'] . '">评论</a></p>';
            }
            echo '<p>' . nl2br(htmlspecialchars(stripslashes($row['post_content']))) . '</p>';
        }

        $result->free();
    } else {
        // Handle query error
        echo '搜索失败，请稍后再试。';
    }

    $db->close();
} else {
    // Handle missing search content parameter
    echo '搜索内容不能为空。';
}
?>
