<?php
require('config.php');

// 获取要修改的文章 ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = $_GET['id'];

    // 连接数据库
    @$db = new mysqli($db_host, $db_username, $db_password, $db_database);

    if (mysqli_connect_errno()) {
        echo '错误: 无法连接到数据库. 请稍后再次重试.';
        exit;
    }

    // 获取文章内容
    $query = "SELECT * FROM post WHERE id = $post_id";
    $result = $db->query($query);
    $row = $result->fetch_assoc();

    // 关闭数据库连接
    $db->close();
}

// 显示修改文章的表单
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title>Simple Blog System—修改文章</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        p {
            margin-bottom: 16px;
            color: #555;
        }

        input[type="text"],
        textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            width: auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Simple Blog System—修改文章</h1>

    <form action="update_post_process.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />

        <p>标题: <input type="text" name="title"
                value="<?php echo htmlspecialchars(stripslashes($row['post_title'])); ?>" /></p>

        <p>正文: <textarea name="content" rows="10"
                cols="80"><?php echo htmlspecialchars(stripslashes($row['post_content'])); ?></textarea></p>

        <p><input type="submit" value="保存修改" /></p>
        <p><a href="list_post.php">返回文章列表</a></p>
    </form>

</body>

</html>