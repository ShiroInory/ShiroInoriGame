<?php include_once("config/sqlconnect.php") ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShiroInoriGame - 22/7攻略網站</title>
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
                <h1 class="title">首頁</h1>
                <div class="post">
                    <div><p>這個網站是一個22/7攻略網站</p></div>
                    <div><p>可以點擊上面導覽列查看遊戲的資訊</p></div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>