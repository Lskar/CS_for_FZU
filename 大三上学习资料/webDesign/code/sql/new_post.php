<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blog System—发表文章</title>

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

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input, textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
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

        a {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>发表博客文章</h1>

    <?php
    require('config.php');
    date_default_timezone_set('Asia/Shanghai');

    $title = $_POST['title'];
    $content = $_POST['content'];

    if (!$title || !$content) {
        echo '你未输入文章的标题或正文.<br />'
            . '请退回再次重试.';
        exit;
    }

    if (!ini_get('magic_quotes_gpc')) {
        $title = addslashes($title);
        $content = addslashes($content);
    }

    @ $db = new mysqli($db_host, $db_username, $db_password, $db_database);

    if (mysqli_connect_errno()) {
        echo '错误: 无法连接到数据库. 请稍后再次重试.';
        exit;
    }

    // 设置字符集
    $db->query("SET NAMES utf8");

    $query = "INSERT INTO post (post_title, post_content, post_date) VALUES ('$title', '$content', '" . date('Y-m-d H:i:s') . "')";

    echo '<pre>' . $title . '</pre>';
    echo '<pre>' . $content . '</pre>';

    $result = $db->query($query);

    if ($result)
        echo  $db->affected_rows . ' 条记录被插入数据库中';
    else
        echo '插入记录错误，请检查程序代码';

    // 返回到list_post.php
    echo '<a href="list_post.php">返回</a>';

    $db->close();
    ?>
</body>

</html>
