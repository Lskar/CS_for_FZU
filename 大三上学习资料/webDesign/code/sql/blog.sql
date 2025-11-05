-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2023-12-29 08:44:26
-- 服务器版本： 8.0.35
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `blog`
--

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `comment_content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `comment_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `user_id`, `comment_content`, `comment_date`) VALUES
(1, 1, 4, '使至塞上写得好', '2023-12-29 14:38:41');

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_title` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `post_content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `post_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`id`, `post_title`, `post_content`, `post_date`) VALUES
(1, '使至塞上', '单车欲问边，属国过居延。\r\n征蓬出汉塞，归雁入胡天。\r\n大漠孤烟直，长河落日圆。\r\n萧关逢候骑，都护在燕然。', '2009-03-22 15:28:10'),
(2, '长相思', '山一程\r\n水一程\r\n身向榆关那畔行\r\n夜深千帐灯\r\n　　\r\n风一更\r\n雪一更\r\n聒碎乡心梦不成\r\n故园无此声', '2009-03-22 15:29:20'),
(3, '如梦令', '万帐穹庐人醉\r\n星影摇摇欲坠\r\n\r\n归梦隔狼河\r\n又被河声搅碎\r\n\r\n还睡\r\n还睡\r\n解道醒来无味', '2009-03-22 15:29:30'),
(4, '梦江南', '昏鸦尽\r\n小立恨因谁\r\n急雪乍翻香阁絮\r\n轻风吹到胆瓶梅\r\n心字已成灰', '2009-03-22 15:32:27'),
(6, '福州大学校训', '明德：\r\n\r\n大学之道，在明明德，\r\n\r\n在亲民，在止于至善。(《大学》)\r\n\r\n\r\n\r\n至诚：\r\n\r\n唯天下至诚，为能尽其性，\r\n\r\n能尽其性，则能尽人之性，\r\n\r\n能尽人之性，则能尽物之性，\r\n\r\n能尽物之性，则可以赞天下之化育；\r\n\r\n可以赞天下之化育；则可以与天地参矣。\r\n\r\n唯天下至诚，为能经纶天下之大经，\r\n\r\n立天下之大本，知天下之化育。(《中庸》)\r\n\r\n\r\n\r\n博学远(笃)志：\r\n\r\n博学而笃志，\r\n\r\n切问而近思，\r\n\r\n仁在其中矣。(《论语》)', '2023-12-29 15:12:05'),
(8, '龙岩一中校训', '校训：弘毅 守志 任重 道远\r\n校风：团结 勤奋 求实 创新\r\n教风：严谨 笃学 厚德 善导\r\n学风：慎思 博学 文明 进取', '2023-12-29 15:16:20'),
(11, 'web程序设计实践作业', 'Blog(博客)的全名是 Web log，中文意思是“网络日志”。后来人们把 WebLog 写作为：\"We Blog\"，\"Blog\"很快就成为了名词和动词。 第一个 blog 是在 2001 年出现的，随后风靡全球。人们在 blog 上张贴自己的评论文章、发布或新或旧的新闻、谈论自己的日常生活，或是充满激情地抨击时事。', '2023-12-29 16:31:01'),
(13, 'Simple Web Server', '“我听过的会忘掉，我看过的能记住，我做过的才真正明白。” （摘自李开复《给中国学生的第四封信——大学四年应该这么度过》）。课上介绍了HTTP协议，这次的作业要求亲手实现一个简单的 Web 服务器：\r\n\r\n只需要实现一个控制台程序即可，可以使用Java/C/C++等实现。\r\n简单起见，可以就以程序启动目录作为文档的根目录(DocumentRoot)。\r\n请求报文只需要实现能处理客户端发送的 GET 方法即可。\r\n响应报文只需要实现能返回两种情况的状态码：200 OK 和 404 Not found。\r\n服务器启动后，用任意的浏览器都能读取服务器上的网页。\r\n自己编写Web服务器，在现在的嵌入式产品中非常常见，像各种家用路由器，配置界面都是Web的； 就是在嵌入式产品中自己写一个服务器来提供Web界面配置服务，这种应用在以后非常广泛。 同时，通过自己动手实现，可以深入了解协议本身，消除对网络协议的神秘感。\r\n\r\n提示', '2023-12-29 16:32:16');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(3, 'admin', 'admin'),
(4, 'MeiMingSheng', '222100129'),
(5, 'Mew', 'Mew'),
(6, '', ''),
(7, 'web', 'web');

--
-- 限制导出的表
--

--
-- 限制表 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
