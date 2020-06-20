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
                <h1 class="title">卡面資料</h1>
                <div class="post">
                <?php
                $sql = "select card_name, character_name, property, star, max_total_force, max_vocal, max_dance, max_charm, skillname, skill from cards;";
                $result = $con->query($sql);
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        echo "<table class=\"table\" style=\"width: 500px\">";
                        echo "<tr>";
                        echo "<td class=\"table-key\" style=\"width: 100px;\">卡面名稱</td>";
                        echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['card_name']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class=\"table-key\"style=\"width: 100px;\">角色名稱</td>";
                        echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['character_name']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class=\"table-key\" style=\"width: 100px;\">屬性</td>";
                        echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['property']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class=\"table-key\" style=\"width: 100px;\">星數</td>";
                        echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['star']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class=\"table-key\" style=\"width: 100px;\">總合力</td>";
                        echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['max_total_force']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class=\"table-key\" style=\"width: 100px;\">vocal</td>";
                        echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['max_vocal']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class=\"table-key\" style=\"width: 100px;\">dance</td>";
                        echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['max_dance']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class=\"table-key\"style=\"width: 100px;\">charm</td>";
                        echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['max_charm']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class=\"table-key\" style=\"width: 100px;\">技能名稱</td>";
                        echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['skillname']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class=\"table-key\" style=\"width: 100px;\">技能描述</td>";
                        echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['skill']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class=\"table-key\" colspan=\"2\">註:lv1為5秒, 每提升一級增加0.5秒, 最高5級</td>";
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