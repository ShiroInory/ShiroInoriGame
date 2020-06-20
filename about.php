<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShiroInoriGame - 關於此網站</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <a href="index.php" class="logo">ShiroInoriGame</a>
            <div class="header-data">
                <?php
                    if(isset($_SESSION['username'])) {
                        echo "<span>當前用戶為".$_SESSION['nickname']."</span>";
                        echo "<a href=\"admin/index.php\">管理</a>";
                        echo "<a href=\"logout.php\">登出</a>";
                    } else {
                        echo "<a href=\"login.php\">登入</a>";
                    }
                ?>
                <a href="about.php">關於此網站</a>
            </div>
        </div>
    </header>
    <div class="menu-top">
        <div class="menu">
            <ul>
                <li><a href="characters/index.php">角色介紹</a></li>
                <li><a href="cards/index.php">卡面資料</a></li>
                <li><a href="songs/index.php">歌曲資料</a></li>
            </ul>
        </div>
    </div>
    <div class="wrapper">
        <div class="container inner">
            <div class="card">
                <h1 class="title">關於此網站</h1>
                <div class="post">
                    <div><p>這個網站是一個遊戲攻略網站</p></div>
                    <div><p>開發環境為nginx 1.17.10 + php7.4.6 + mariadb 10.4(用docker架設)</p></div>
                    <div><p>學號:18113114</p></div>
                    <div><p>姓名:力允程</p></div>
                    <div><p>Github:<a href="https://github.com/whiteinori/ShiroInoriGame">點此</a></p></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>