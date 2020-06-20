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
                <h1 class="title">角色資料</h1>
                <div class="post">
                <?php
                    $sql = "select character_name, age, brithday, height, bloodgroup, background, imagecolor, motto, specialty, dream, likefood, notgoodat, interest, seiyuu, introduction from characters;";
                    $result = $con->query($sql);
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_array($result)) {
                            echo "<table class=\"table\" style=\"width: 500px\">";
                            echo "<tr>";
                            echo "<td class=\"table-key\" style=\"width: 100px;\">角色名稱</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['character_name']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\"style=\"width: 100px;\">年紀</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['age']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\" style=\"width: 100px;\">生日</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['brithday']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\" style=\"width: 100px;\">身高</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['height']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\" style=\"width: 100px;\">血型</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['bloodgroup']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\" style=\"width: 100px;\">出身地</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['background']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\" style=\"width: 100px;\">應援色</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['imagecolor']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\"style=\"width: 100px;\">座右銘</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['motto']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\" style=\"width: 100px;\">特技</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['specialty']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\" style=\"width: 100px;\">夢想</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['dream']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\" style=\"width: 100px;\">不擅長的事物</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['notgoodat']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\" style=\"width: 100px;\">興趣</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['interest']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\" style=\"width: 100px;\">聲優</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['seiyuu']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class=\"table-key\" style=\"width: 100px;\">簡介</td>";
                            echo "<td class=\"table-value\" style=\"width: 400px;\">".$row['introduction']."</td>";
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