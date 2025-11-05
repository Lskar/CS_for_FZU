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

// 接收用户输入
$username = $_POST['username'];
$password = $_POST['password'];

// 防止 SQL 注入攻击
$username = $db->real_escape_string($username);
$password = $db->real_escape_string($password);

// 检查用户名是否已存在
$query = "SELECT * FROM `user` WHERE `username` = '$username'";
$result = $db->query($query);

if ($result) {
    $num_results = $result->num_rows;

    if ($num_results > 0) {
        // 用户名已存在，用弹窗提醒用户，用户点击确定后返回注册页面
        echo '<script>alert("用户名已存在，请选择其他用户名。");history.go(-1);</script>';
    } else {
        // 用户名不存在，进行注册
        $insertQuery = "INSERT INTO `user` (`username`, `password`) VALUES ('$username', '$password')";
        $insertResult = $db->query($insertQuery);

        if ($insertResult) {
            // 注册成功，设置用户登录状态
            $_SESSION['username'] = $username;
            header('Location: list_post.php');
            exit;
        } else {
            // 注册失败，用弹窗提醒用户，用户点击确定后返回注册页面
            echo '<script>alert("注册失败，请稍后再试。");history.go(-1);</script>';
        }
    }

    $result->free();
} else {
    // 查询失败
    echo '注册失败，请稍后再试。';
}

$db->close();
?>