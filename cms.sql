-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Sze 27. 16:24
-- Kiszolgáló verziója: 10.4.14-MariaDB
-- PHP verzió: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `cms`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `categories`
--

INSERT INTO `categories` (`cat_id`, `user_id`, `cat_title`) VALUES
(1, 33, 'PHP'),
(2, 0, 'Bootstrap'),
(12, 0, 'JAVA'),
(13, 0, 'OOP'),
(16, 0, 'new category'),
(17, 0, 'Procedural PHP'),
(18, 0, 'HTML 5'),
(19, 0, 'PYT');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(9, 9, 'Wallin', 'walin1234@gmail.com', 'Hey, Im am Wallin!', 'approved', '2020-09-06'),
(10, 12, 'Edwin', 'edwindiaz@edwindiaz.com', 'Just a comment', 'approved', '2020-09-08'),
(11, 14, '', '', '', 'unapproved', '2020-09-08'),
(12, 14, '', '', '', 'unapproved', '2020-09-08'),
(13, 14, '', '', '', 'unapproved', '2020-09-08'),
(14, 14, '', '', '', 'unapproved', '2020-09-08'),
(15, 12, '', '', '', 'unapproved', '2020-09-08'),
(16, 9, 'Edwin Diaz', 'support@edwindiazschoolofcode.com', 'My comment', 'unapproved', '2020-09-12'),
(17, 9, 'Edwin Diaz The Best', 'support@edwindiazschoolofcode.com', 'This is just a test comment', 'unapproved', '2020-09-12'),
(18, 9, 'Maria', 'maria@gmail.com', 'sdfsfsdfsfsdf', 'unapproved', '2020-09-12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(34, 33, 9);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `user_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`, `likes`) VALUES
(9, 13, 33, 'Example post Number 200', 'Amit', 'admin', '2020-09-24', 'image_3.jpg', '<p>this is a OOP course with BS</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Bootstrap', 7, 'published', 222, 1),
(10, 13, 33, 'adding new post', 'Edwin Diaz', '', '2020-09-06', 'image_4.jpg', 'dfgdfgdfgdfgdfg', 'Javascript', 0, 'published', 4, 0),
(12, 1, 0, 'Example post 1', 'Edwin Diaz', '', '2020-09-08', 'image_4.jpg', '<p>cvbcvbcvbcvbcvb</p>', 'Javascript', 1, 'published', 2, 0),
(13, 1, 0, 'This is another postyeah baby, this is cool', 'PHP Guy', '', '2020-09-08', 'image_4.jpg', 'sfsdfsdfsdf', 'javascript', 0, 'published', 0, 0),
(14, 1, 0, 'Just another post FRISS', 'edwin', '', '2020-09-08', 'image_2.jpg', '<p>Just some content</p>', 'hello', 4, 'published', 1, 0),
(15, 1, 0, 'Wow another, my hands are tired :)', 'Edwin Diaz', '', '2020-09-08', 'image_3.jpg', '<p>This is some content</p>', 'bootstrap', 0, 'published', 0, 0),
(16, 2, 0, 'Example post', 'Edwin Diaz', '', '2020-09-08', '', '<p>sdfsdfsdf</p>', 'sdfsdfsdf', 0, 'published', 0, 0),
(17, 2, 0, 'Example post Number 300', 'Edwin Diaz', '', '2020-09-08', '', '<p>dfgdfg</p>', 'dgfgdfg', 0, 'published', 42, 0),
(19, 13, 0, 'Example post Number 200', 'Amit', '', '2020-09-10', 'image_3.jpg', 'this is a OOP course with BS', 'Bootstrap', 0, 'published', 0, 0),
(20, 13, 0, 'adding new post', 'Edwin Diaz', '', '2020-09-10', 'image_4.jpg', 'dfgdfgdfgdfgdfg', 'Javascript', 0, 'published', 0, 0),
(21, 13, 0, 'Example post Number 200', 'Amit', '', '2020-09-10', 'image_3.jpg', 'this is a OOP course with BS', 'Bootstrap', 0, 'published', 0, 0),
(22, 13, 0, 'adding new post', 'Edwin Diaz', '', '2020-09-10', 'image_4.jpg', 'dfgdfgdfgdfgdfg', 'Javascript', 0, 'published', 0, 0),
(23, 13, 0, 'Example post Number 200', 'Amit', '', '2020-09-10', 'image_3.jpg', 'this is a OOP course with BS', 'Bootstrap', 0, 'published', 0, 0),
(24, 13, 0, 'adding new post', 'Edwin Diaz', '', '2020-09-10', 'image_4.jpg', 'dfgdfgdfgdfgdfg', 'Javascript', 0, 'published', 0, 0),
(25, 1, 0, 'Just another post FRISS', 'edwin', '', '2020-09-10', 'image_2.jpg', '<p>Just some content</p>', 'hello', 0, 'published', 0, 0),
(26, 1, 0, 'Just another post FRISS', 'edwin', '', '2020-09-10', 'image_2.jpg', '<p>Just some content</p>', 'hello', 0, 'published', 0, 0),
(27, 13, 0, 'adding new post', 'Edwin Diaz', '', '2020-09-10', 'image_4.jpg', 'dfgdfgdfgdfgdfg', 'Javascript', 0, 'published', 0, 0),
(28, 1, 0, 'Just another post FRISS', 'edwin', '', '2020-09-10', 'image_2.jpg', '<p>Just some content</p>', 'hello', 0, 'published', 0, 0),
(29, 13, 0, 'Example post Number 200', 'Amit', '', '2020-09-10', 'image_3.jpg', 'this is a OOP course with BS', 'Bootstrap', 0, 'published', 0, 0),
(30, 13, 0, 'Example post Number 200', 'Amit', '', '2020-09-10', 'image_3.jpg', 'this is a OOP course with BS', 'Bootstrap', 0, 'published', 0, 0),
(31, 1, 0, 'Just another post FRISS', 'edwin', '', '2020-09-10', 'image_2.jpg', '<p>Just some content</p>', 'hello', 0, 'published', 0, 0),
(32, 13, 0, 'adding new post', 'Edwin Diaz', '', '2020-09-10', 'image_4.jpg', 'dfgdfgdfgdfgdfg', 'Javascript', 0, 'published', 0, 0),
(33, 1, 0, 'Just another post FRISS', 'edwin', '', '2020-09-10', 'image_2.jpg', '<p>Just some content</p>', 'hello', 0, 'published', 0, 0),
(34, 1, 0, 'Just another post FRISS', 'edwin', '', '2020-09-10', 'image_2.jpg', '<p>Just some content</p>', 'hello', 0, 'published', 0, 0),
(35, 13, 0, 'adding new post', 'Edwin Diaz', '', '2020-09-10', 'image_4.jpg', 'dfgdfgdfgdfgdfg', 'Javascript', 0, 'published', 0, 0),
(36, 13, 0, 'Example post Number 200', 'Amit', '', '2020-09-10', 'image_3.jpg', 'this is a OOP course with BS', 'Bootstrap', 0, 'published', 0, 0),
(37, 13, 0, 'adding new post', 'Edwin Diaz', '', '2020-09-10', 'image_4.jpg', 'dfgdfgdfgdfgdfg', 'Javascript', 0, 'published', 1, 0),
(38, 13, 0, 'Example post Number 200', 'Amit', '', '2020-09-10', 'image_3.jpg', 'this is a OOP course with BS', 'Bootstrap', 0, 'published', 0, 0),
(39, 13, 0, 'adding new post', 'Edwin Diaz', '', '2020-09-10', 'image_4.jpg', 'dfgdfgdfgdfgdfg', 'Javascript', 0, 'published', 0, 0),
(40, 13, 0, 'Example post Number 200', 'Amit', '', '2020-09-10', 'image_3.jpg', 'this is a OOP course with BS', 'Bootstrap', 0, 'published', 0, 0),
(41, 2, 0, 'Example post Number 300', 'Edwin Diaz', '', '2020-09-10', '', '<p>dfgdfg</p>', 'dgfgdfg', 0, 'published', 0, 0),
(42, 2, 0, 'Example post', 'Edwin Diaz', '', '2020-09-10', '', '<p>sdfsdfsdf</p>', 'sdfsdfsdf', 0, 'published', 0, 0),
(43, 1, 0, 'Wow another, my hands are tired :)', 'Edwin Diaz', '', '2020-09-10', 'image_3.jpg', '<p>This is some content</p>', 'bootstrap', 0, 'published', 0, 0),
(44, 1, 0, 'Just another post FRISS', 'edwin', '', '2020-09-10', 'image_2.jpg', '<p>Just some content</p>', 'hello', 0, 'published', 0, 0),
(45, 12, 0, 'This is another postyeah baby, this is cool', 'PHP Guy', '', '2020-09-16', 'image_4.jpg', '<p>sfsdfsdfsdf</p>', 'javascript', 0, 'published', 0, 0),
(46, 2, 0, 'Example post 1', 'Edwin Diaz', 'rocco', '2020-09-16', 'image_4.jpg', '<p>cvbcvbcvbcvbcvb</p>', 'Javascript', 0, 'published', 0, 0),
(62, 2, 0, 'Example post 1', 'Edwin Diaz', '', '2020-09-16', 'image_4.jpg', '<p>cvbcvbcvbcvbcvb</p>', 'Javascript', 0, 'published', 0, 0),
(63, 2, 0, 'Example post 1', 'Edwin Diaz', 'rocco', '2020-09-16', 'image_4.jpg', '<p>cvbcvbcvbcvbcvb</p>', '', 0, 'published', 0, 0),
(65, 1, 0, 'Poster\'s post', '', 'poster', '2020-09-24', 'image_1.jpg', '<p>fdgdf</p>', 'Bootstrap', 0, 'published', 1, 0),
(66, 1, 33, 'black picture', '', 'admin', '2020-09-26', 'image_2.jpg', '<p>sdfsdfsdfsdfsdfs</p>', 'black image', 0, 'draft', 3, 1),
(67, 1, 0, '', '', 'admin', '2020-09-26', 'image_2.jpg', '<p>sfsfsdfsdfsdfsdf</p>', 'black image', 0, 'published', 0, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(7, 'whatever', '123', 'Juan', 'whatever', 'whatever@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(8, 'demo4000', '123', 'Demo 4000', 'Demo 3432', 'demo4000@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(9, 'rocco', '123', '', '', 'rocco@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(10, 'Gambit', '123', 'Robert', 'Sandro', 'gambit344@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(11, 'Suave FRISS 2', '123', '', '', 'suave@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(12, 'demo', '$1$7gUhkgiZ$pu2khCZ70vT33K8763IIS0', '', '', 'demo@yahoo.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(13, 'demo2000', '$1$pUzUAGk0$mpIpdClh3cHzRQz3frVQm.', '', '', 'demo22000@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(14, 'demo100', '$1$Bpl2CPHl$RJ0tngbezCPvxD.WstXTr.', '', '', 'demo100@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(15, 'Suave', '$1$sXr1muq4$dX44onWLodDhpfo53q9UU0', '', '', 'suave@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(16, 'valami', '$1$UiAj6Wzg$ix2R0fwsxDfZ2MDeeCTri.', '', '', 'valami@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(17, 'valami2', '$1$Mx80qIvd$qmKi0JsWcJ431BnF0SAIv/', '', '', 'valami@example.com', '', 'admin', '$2y$10$iusesomecrazystrings22', ''),
(18, 'Test User', '$1$cu8V08nZ$IlJhWmHqTphGrkbU9FVT70', '', '', 'test@example.com', '', 'admin', '$2y$10$iusesomecrazystrings22', ''),
(19, 'register hash test', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'register@example.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(20, 'new reg', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'somebody@example.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(21, 'reg', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'reg@example.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(22, 'edit', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'edit@example.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(23, 'final', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'final@example.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(24, 'user1', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'user1@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(25, 'user2', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'user2@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(26, 'new_user', '$2y$12$6SgHhBYO3MPtr.DxTipRMuF8j3E7IbQnNCKsrKsa4HD/qvrKVg7gW', '', '', 'support@edwinschoolofcode.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(27, 'peter', '$2y$12$CNmFcmTQFC1vE2Rl4wRt6e5W5VCK1xYogRFNGKfmiDKBQN4r2RFrK', '', '', 'peter@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22', ''),
(28, 'peteeee', '$2y$10$J8Nc0B31m0864mbSa8gs8uzJPVVtaGCHGWNdGzuUEv.KH.8/E.pQ2', 'Pete', 'William', 'peteee@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(29, 'rico123', '', 'Rico123', '', 'rico123@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(30, 'demo1', '$2y$10$Q2lTh56N65ACNZgA0iGyG.H1MmP/ZmWA2Nfe2hEZ05.DxE/GjGEYm', '', '', 'demo1@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(32, 'subscriber', '$2y$10$ExSnlB9GMtZvvi4GScCii.ZExC1iLEAx7qrT.lS2FZYsAhojpKBEG', 'Subscriber', 'Subscriber', 'subscriber@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(33, 'admin', '$2y$12$84Y3ggE.7cZpb3qIqHHU1.A925rqSUpB6VtsjZkNopaF3AD4pg66q', 'Admin', 'Admin', 'admin@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22', ''),
(34, 'rocco2', '$2y$12$M5fBzqXlimjuSINH9TJSZ.TkbvnZTLRgFMBCLGOJwNsoYCxbZwyPq', '', '', 'rocco@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(35, 'rocco3', '$2y$12$iJMYPU13/FOpCMbidlM/xeLw6OTlcwZUy4cMw58yY11f9XbCixuT6', '', '', 'rocco@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(36, 'rocco4', '$2y$12$jZiHiMn3oP2Mt6/9JzSQWuK72EuNubpKN9.Sw2NnRyzotqsaGeALm', '', '', 'rocco2@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(37, 'Edwin Diaz', '$2y$12$FyWlhxNZMMQOEo6UXwEcZu1GJSdEhud47lidv98yBwzuWU1hUTvBq', '', '', 'edwin@codingfaculty.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(38, 'lupila', '$2y$12$j4KDQ85obu3fQcEkuBKu4e9miComYa9mtwq1Bu3qQVM4SLP7JaLC6', '', '', 'lupila1800@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(39, 'poster', '$2y$10$Y32OCBzPGdHBO45oNG.3H.unTWMIK4KX6TAGQdSvHicrnFPMqJ8me', 'Poster', 'Poster', 'poster@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22', ''),
(40, 'admin2', '$2y$12$EQnsLeQhOok44ng8nlcYbevt5Zp3oQeHr6eS8ZWwd5Lx5iUJdApl6', '', '', 'admin2@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(8, 'sti1m1sfq6vk6vu29mrf7j440k', 1599837438),
(9, '9cnrhu8nmegspi2cesgcj7r90q', 1599833034),
(10, '', 1599837801),
(11, 'pmfp4h3eftb2mcjjrdbnb81h4g', 1599837873),
(12, 't8irrqqtfqjn9lbgch7spj3gv1', 1599848477),
(13, '5t0gvq3pr4l1vo818um7a9ltm9', 1599851311),
(14, 'pitl8eanl5n7s7bmjvj8a7bjrq', 1599855368),
(15, '0hfra90iva1ivoennae9n6e0t4', 1599912285),
(16, 'el1oro7s1rskrs2sd0fa38c1ah', 1599918511),
(17, 'cn5o7nksh1tpdpjtucdsiv78h0', 1599937601),
(18, 'g045mpjgh7e922j2fj2n0blnsl', 1600204034),
(19, 'vks8r0uboru6le1o6a0cfpifbr', 1600254763),
(20, 'givmht958l60ko4ut7fn0is9p9', 1600265968),
(21, '5q3h9107t1quafsibp8c386mb8', 1600281541),
(22, 'j6aobcmpglhqdk4oj9satoji7v', 1600288838),
(23, '1ptqvs2hjgc8k41tdqr0hs6sj9', 1600341813),
(24, '768eha5njkcr6u5jpmfuasv115', 1600455174),
(25, '1fr7h7vt8jhgj6hpoeq8apb81u', 1600601832),
(26, 'ufl9qkm9ci9ejquon81rosve1t', 1600641484),
(27, 'sh7mcnsm538hkat0r93iv17k65', 1600686928),
(28, 'kcbtovq7qo7p31td45vj29sed4', 1600729746),
(29, 'j2ohu0fbhqlnh15ihc15e5m9jr', 1600778109),
(30, 'fgu084acf73kj6gdmeg1nij2cl', 1600892599),
(31, 'mf1vug16a6dv6euofu7o9otkdp', 1600943787),
(32, 'hmelcb61qnd0o8or56um011lim', 1600946746),
(33, 'p6v1b96ue515p0dktd2a4a3qvf', 1600961457),
(34, 'ffg2dsak7cgg1c21uqcdug0grl', 1601034757),
(35, '3b70iptv4ah28pksim387u6fe4', 1601125898),
(36, 'mci5k7gog34r01j6e0d73m7641', 1601122452),
(37, '0mja3dt9s4qigp8iaqb062nkd9', 1601152492);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- A tábla indexei `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- A tábla indexei `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT a táblához `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT a táblához `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT a táblához `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
