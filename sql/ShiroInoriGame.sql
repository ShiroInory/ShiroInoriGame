-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： db
-- 產生時間： 2020 年 06 月 20 日 09:46
-- 伺服器版本： 10.4.13-MariaDB-1:10.4.13+maria~bionic
-- PHP 版本： 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `ShiroInoriGame`
--
CREATE DATABASE IF NOT EXISTS `ShiroInoriGame` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ShiroInoriGame`;

-- --------------------------------------------------------

--
-- 資料表結構 `cards`
--

CREATE TABLE `cards` (
  `caid` int(11) NOT NULL,
  `card_name` varchar(30) NOT NULL,
  `character_name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `property` varchar(10) CHARACTER SET utf8 NOT NULL,
  `star` int(11) NOT NULL,
  `max_total_force` int(11) NOT NULL,
  `max_vocal` int(11) NOT NULL,
  `max_dance` int(11) NOT NULL,
  `max_charm` int(11) NOT NULL,
  `skillname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `skill` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `cards`
--

INSERT INTO `cards` (`caid`, `card_name`, `character_name`, `property`, `star`, `max_total_force`, `max_vocal`, `max_dance`, `max_charm`, `skillname`, `skill`) VALUES
(1, 'ありのままの自分', '滝川みう', '黑桃', 4, 34526, 11510, 11418, 11598, '奇跡だから', 'n秒內,所有combo得分增加100%'),
(2, 'ひとりじゃない', '東条悠希', '梅花', 4, 34546, 12531, 11678, 10337, 'ステージからの景色', 'n秒內,只要出現一次great以下的combo,得分增加80%,否則120%'),
(3, '努力の証明', '斎藤ニコル', '黑桃', 4, 34552, 11710, 12542, 10300, '私の力だけじゃない', 'n秒內,當打出perfect時,增加得分130%');

-- --------------------------------------------------------

--
-- 資料表結構 `characters`
--

CREATE TABLE `characters` (
  `cid` int(11) NOT NULL,
  `character_name` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `brithday` varchar(10) NOT NULL,
  `height` varchar(11) NOT NULL,
  `bloodgroup` varchar(10) NOT NULL,
  `background` varchar(20) NOT NULL,
  `imagecolor` varchar(10) NOT NULL,
  `motto` varchar(50) NOT NULL,
  `specialty` varchar(30) NOT NULL,
  `dream` varchar(50) NOT NULL,
  `likefood` varchar(40) NOT NULL,
  `notgoodat` varchar(40) NOT NULL,
  `interest` varchar(50) NOT NULL,
  `seiyuu` varchar(20) NOT NULL,
  `introduction` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `characters`
--

INSERT INTO `characters` (`cid`, `character_name`, `age`, `brithday`, `height`, `bloodgroup`, `background`, `imagecolor`, `motto`, `specialty`, `dream`, `likefood`, `notgoodat`, `interest`, `seiyuu`, `introduction`) VALUES
(1, '滝川みう', 16, '3月14日', '156', 'AB型', '埼玉县', '白', '無', '鋼琴', '與其他成員一起努力', '金槍魚飯', '任何與人相關的事物、大人(說謊的人)', '閱讀詩集、拍照', '西條和', '22/7的Center，討厭美麗事物的現實主義者，喜歡的東西是詩集、擅長鋼琴。但沒有運動細胞');

-- --------------------------------------------------------

--
-- 資料表結構 `songs`
--

CREATE TABLE `songs` (
  `sid` int(11) NOT NULL,
  `song_name` varchar(20) NOT NULL,
  `easy_difficulty` varchar(5) NOT NULL,
  `normal_difficulty` varchar(5) NOT NULL,
  `hard_difficulty` varchar(5) NOT NULL,
  `ex_difficulty` varchar(5) NOT NULL,
  `singer` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `songs`
--

INSERT INTO `songs` (`sid`, `song_name`, `easy_difficulty`, `normal_difficulty`, `hard_difficulty`, `ex_difficulty`, `singer`) VALUES
(1, '風は吹いてるか？', '1.1', '2.2', '3.1', '3.8', '22/7'),
(2, '11人が集まった理由', '1.0', '1.6', '1.8', '2.4', '22/7');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nickname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `nickname`) VALUES
(1, 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '白祈');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`caid`);

--
-- 資料表索引 `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`cid`);

--
-- 資料表索引 `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cards`
--
ALTER TABLE `cards`
  MODIFY `caid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `characters`
--
ALTER TABLE `characters`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `songs`
--
ALTER TABLE `songs`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
