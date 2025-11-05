<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Blog System—文章列表</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    header {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 1em 0;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
      margin-top: 20px;
    }

    #post_list {
      margin-top: 20px;
    }

    h2 {
      color: #333;
    }

    p {
      margin-bottom: 10px;
    }

    #login-container {
      float: right;
    }

    #login-element,
    #welcome-element {
      display: inline-block;
    }

    #welcome-element {
      display: none;
    }
  </style>

  <script>
    function openLoginPopup() {
      window.open('login.html', 'LoginWindow', 'width=400,height=400');
    }

    function updateLoginStatus() {
      console.log('updateLoginStatus() 被调用了');
      var isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;
      var loginElement = document.getElementById('login-element');
      var welcomeElement = document.getElementById('welcome-element');

      if (isLoggedIn) {
        loginElement.style.display = 'none';
        welcomeElement.style.display = 'inline-block';
      } else {
        loginElement.style.display = 'inline-block';
        welcomeElement.style.display = 'none';
      }

      var value = <?php echo isset($_SESSION['username']) ? json_encode($_SESSION['username']) : 'null'; ?>;
      console.log(value);
      console.log(welcomeElement.style.display);
    }

    window.onload = function () {
      updateLoginStatus();
      console.log(new Date().toLocaleString());
    };

    function searchPosts() {
      var searchContent = document.getElementById('search_content').value;

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById('post_list').innerHTML = xhr.responseText;
        }
      };
      xhr.open('POST', 'search_post.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.send('search_content=' + encodeURIComponent(searchContent));

      return false;
    }
  </script>
</head>

<body>
  <header>
    <h1>Simple Blog System—文章列表</h1>
  </header>

  <div id="login-container">
    <span id="login-element">
      <a href="login.html">登录</a>
    </span>
    <span id="welcome-element">
      欢迎 <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>
      <a href="logout.php">登出</a>
    </span>
  </div>

  <div class="container">
    <form onsubmit="return searchPosts();">
      <input type="text" id="search_content" name="search_content" placeholder="请输入搜索内容" required>
      <input type="submit" value="搜索">
    </form>

    <div id="post_list">
      <?php
      require('config.php');
      @$db = new mysqli($db_host, $db_username, $db_password, $db_database);

      if (mysqli_connect_errno()) {
        echo '错误: 无法连接到数据库. 请稍后再次重试.';
        exit;
      }
      $db->query("SET NAMES utf8");

      $query = "select * from post";
      $result = $db->query($query);

      $num_results = $result->num_rows;

      echo '<p>共有文章: ' . $num_results . ' 篇</p>';
      echo '<p>想要发表新文章？<a href="new_post.html">发表新文章</a></p>';

      for ($i = 0; $i < $num_results; $i++) {
        $row = $result->fetch_assoc();
        echo '<h2>' . ($i + 1) . '. ' . htmlspecialchars(stripslashes($row['post_title'])) . "</h2>\n";
        echo '<p>发表时间：' . htmlspecialchars(stripslashes($row['post_date'])) . "</p>\n";

        if (isset($_SESSION['username'])) {
          echo '<p>操作：<a href="update_post.php?id=' . $row['id'] . '">修改</a> | <a href="delete_post.php?id=' . $row['id'] . '">删除</a> | <a href="comment_post.php?id=' . $row['id'] . '">评论</a></p>';
        }
        echo '<p>' . nl2br(htmlspecialchars(stripslashes($row['post_content']))) . '</p>';
      }

      $result->free();
      $db->close();
      ?>
    </div>
  </div>
</body>

</html>
