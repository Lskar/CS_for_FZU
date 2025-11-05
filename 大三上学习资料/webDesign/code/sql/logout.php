<?php
session_start();

// 清除所有 session 数据
session_unset();
session_destroy();

// 重定向回 list_post.php
header('Location: list_post.php');
exit;
?>
