<?php
// 在代码中修改 session.cookie_lifetime 和 session.gc_maxlifetime
//ini_set('session.cookie_lifetime', 3600); // 设置为一小时
//ini_set('session.gc_maxlifetime', 3600);
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

// 查询用户是否存在
$query = "SELECT * FROM `user` WHERE `username` = '$username'";
$result = $db->query($query);

if ($result) {
    $num_results = $result->num_rows;

    if ($num_results > 0) {
        // 用户存在，检查密码
        $row = $result->fetch_assoc();
        if ($password === $row['password']) {
            // 密码验证成功，设置用户登录状态
            $_SESSION['username'] = $username;
            $_SESSION['userId']=$row['id'];
            //调用login.html文件中的notifyLoginSuccess方法
            //echo '<script>window.opener.notifyLoginSuccess();</script>';
            header('Location: list_post.php');
            exit;
        } else {
            // 密码不匹配，用弹窗提醒用户，用户点击确定后返回登录页面
            echo '<script>alert("密码错误，请重试。");history.go(-1);</script>';
        }
    } else {
        // 用户不存在，用弹窗提醒用户，用户点击确定后返回登录页面
        echo '<script>alert("用户名不存在，请重试。");history.go(-1);</script>';
    }

    $result->free();
} else {
    // 查询失败
    echo '登录失败，请稍后再试。';
}

$db->close();
?>