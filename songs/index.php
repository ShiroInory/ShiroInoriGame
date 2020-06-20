<?php include_once("../config/sqlconnect.php") ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShiroInoriGame - 角色介紹</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <a href="../index.php" class="logo">ShiroInoriGame</a>
            <div class="header-data">
                <?php
                    if(isset($_SESSION['username'])) {
                        echo "<span>當前用戶為".$_SESSION['nickname']."</span>";
                        echo "<a href=\"../admin/index.php\">管理</a>";
                        echo "<a href=\"../logout.php\">登出</a>";
                    } else {
                        echo "<a href=\"../login.php\">登入</a>";
                    }
                ?>
                <a href="../about.php">關於此網站</a>
            </div>
        </div>
    </header>
    <div class="menu-top">
        <div class="menu">
            <ul>
                <li><a href="../characters/index.php">角色資料</a></li>
                <li><a href="../cards/index.php">卡面資料</a></li>
                <li><a href="../songs/index.php">歌曲資料</a></li>
            </ul>
        </div>
    </div>
    <div class="wrapper">
        <div class="container inner">
            <div class="card">
                <h1 class="title">歌曲資料</h1>
                <div class="post">
                    <?php
                        $sql = "select song_name, easy_difficulty, normal_difficulty, hard_difficulty, ex_difficulty, singer from songs;";
                        $result = $con->query($sql);
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                                echo "<table class=\"table\" style=\"width: 400px\">";
                                echo "<tr>";
                                echo "<td class=\"table-key\" style=\"width: 100px;\">歌曲名稱</td>";
                                echo "<td class=\"table-value\" style=\"width: 300px;\">".$row['song_name']."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td class=\"table-key\"style=\"width: 100px;\">歌手</td>";
                                echo "<td class=\"table-value\" style=\"width: 300px;\">".$row['singer']."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td class=\"table-key\" style=\"width: 100px;\">easy難度</td>";
                                echo "<td class=\"table-value\" style=\"width: 300px;\">".$row['easy_difficulty']."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td class=\"table-key\" style=\"width: 100px;\">normal難度</td>";
                                echo "<td class=\"table-value\" style=\"width: 300px;\">".$row['normal_difficulty']."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td class=\"table-key\" style=\"width: 100px;\">hard難度</td>";
                                echo "<td class=\"table-value\" style=\"width: 300px;\">".$row['hard_difficulty']."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td class=\"table-key\" style=\"width: 100px;\">ex難度</td>";
                                echo "<td class=\"table-value\" style=\"width: 300px;\">".$row['ex_difficulty']."</td>";
                                echo "</tr>";
                                echo "</table>";
                                echo "<br>";
                            }
                        }
                        $con->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>