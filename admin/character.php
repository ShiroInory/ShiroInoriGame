<?php
include_once("../config/sqlconnect.php");
session_start();
if (!isset($_SESSION['username'])) {
    die("你尚未登入 <a href=\"../login.php\">按我登入</a>");
}
$ch_fa = false;
$ch_err = false;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['charactername']) && !empty($_POST['charactername']) && isset($_POST['age']) && !empty($_POST['age']) && isset($_POST['brithday']) && !empty($_POST['brithday'])
        && isset($_POST['height']) && !empty($_POST['height']) && isset($_POST['bloodgroup']) && !empty($_POST['bloodgroup']) && isset($_POST['background']) && !empty($_POST['background'])
        && isset($_POST['imagecolor']) && !empty($_POST['imagecolor']) && isset($_POST['motto']) && !empty($_POST['motto']) && isset($_POST['specialty']) && !empty($_POST['specialty']) 
        && isset($_POST['dream']) && !empty($_POST['dream']) && isset($_POST['likefood']) && !empty($_POST['likefood']) && isset($_POST['notgoodat']) && !empty($_POST['notgoodat'])
        && isset($_POST['interest']) && !empty($_POST['interest']) && isset($_POST['seiyuu']) && !empty($_POST['seiyuu']) && isset($_POST['introduction']) && !empty($_POST['introduction'])) {
        $charactername = $_POST['charactername'];
        $age = $_POST['age'];
        $brithday = $_POST['brithday'];
        $height = $_POST['height'];
        $bloodgroup = $_POST['bloodgroup'];
        $background = $_POST['background'];
        $imagecolor = $_POST['imagecolor'];
        $motto = $_POST['motto'];
        $specialty = $_POST['specialty'];
        $dream = $_POST['dream'];
        $likefood = $_POST['likefood'];
        $notgoodat = $_POST['notgoodat'];
        $interest = $_POST['interest'];
        $seiyuu = $_POST['seiyuu'];
        $introduction = $_POST['introduction'];
        $sql = "insert into characters(character_name, age, brithday, height, bloodgroup, background, imagecolor, motto, specialty, dream, likefood, notgoodat, interest, seiyuu, introduction) values('$charactername', $age, '$brithday', '$height', '$bloodgroup', '$background', '$imagecolor', '$motto', '$specialty', '$dream', '$likefood', '$notgoodat', '$interest', '$seiyuu', '$introduction');";
        $result = ($con->query($sql));
        if($result) {
            header('location: character.php');
        } else {
            $ch_fa = true;
        }
    } else {
        $ch_err = true;
    }
} else if($_SERVER["REQUEST_METHOD"] === 'GET') {
    if(@isset($_GET['mode']) == "del" && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "delete from characters where cid=".$id.";";
        $result = ($con->query($sql));
        if($result) {
            header('location: character.php');
        } else {
            die($con->error);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShiroInoriGame - 角色管理</title>
    <link rel="stylesheet" href="../css/style.css">
    <script>
        function del(id) {
            if(confirm("確定要刪除角色嗎?")) {
                window.location = "character.php?mode=del&id=" + id;
            }
        }

        function edit(id) {
            window.location = "editcharacter.php?id=" + id;
        }
    </script>
</head>
<body>
    <header>
        <div class="container">
            <a href="../index.php" class="logo">ShiroInoriGame</a>
            <div class="header-data">
                <?php
                    if(isset($_SESSION['username'])) {
                        echo "<span>當前用戶為".$_SESSION['nickname']."</span>";
                        echo "<a href=\"index.php\">管理</a>";
                        echo "<a href=\"../logout.php\">登出</a>";
                    } else {
                        echo "<a href=\"../login.php\">登入</a>";
                    }
                ?>
                <a href="../about.php">關於此網站</a>
            </div>
        </div>
    </header>
    <div class="admin-container">
        <div class="admin-menu">
            <ul>
                <li><a href="character.php">角色管理</a></li>
                <li><a href="card.php">卡面管理</a></li>
                <li><a href="song.php">歌曲管理</a></li>
                <li><a href="user.php">個人資料管理</a></li>
            </ul>
        </div>
        <div class="admin-content">
            <table style="border:1px solid #000; width:460px;">
                <tr>
                    <th style="border:1px solid #000; width:250px;">角色名稱</th>
                    <th style="border:1px solid #000; width:210px;">管理</th>
                </tr>
                <?php
                $sql = "select cid, character_name from characters";
                $result = ($con->query($sql));
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td style=\"border:1px solid #000; width:250px;\">".$row['character_name']."</td>";
                        echo "<td style=\"border:1px solid #000; width:210px;\"><button type=\"submit\" class=\"admin-button\" onclick=\"edit(".$row['cid'].")\">編輯</button><button type=\"submit\" class=\"admin-button\" onclick=\"del(".$row['cid'].")\">刪除</button></td>";
                        echo "</tr>";
                    }
                }
                $con->close();
                ?>
            </table>
            <form action="character.php" method="post">
                <p style="color:gray; font-size:20px">新增角色</p>
                <div class="form-input" style="width:20%">
                    <input type="text" name="charactername" id="charactername" placeholder="請輸入角色名稱">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="age" id="age" placeholder="請輸入年紀">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="brithday" id="brithday" placeholder="請輸入生日">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="height" id="height" placeholder="請輸入身高">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="bloodgroup" id="bloodgroup" placeholder="請輸入血型">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="background" id="background" placeholder="請輸入出身地">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="imagecolor" id="imagecolor" placeholder="請輸入應援色">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="motto" id="motto" placeholder="請輸入座右銘">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="specialty" id="specialty" placeholder="請輸入特技">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="dream" id="dream" placeholder="請輸入夢想">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="likefood" id="likefood" placeholder="請輸入喜歡的食物">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="notgoodat" id="notgoodat" placeholder="請輸入不擅長的事物">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="interest" id="interest" placeholder="請輸入興趣">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="seiyuu" id="seiyuu" placeholder="請輸入聲優">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="introduction" id="introduction" placeholder="請輸入簡介">
                </div>
                <?php if($ch_fa) echo "<span style=\"color:#f00;\">新增失敗</span>";
                else if($ch_err) echo "<span style=\"color:#f00;\">你有東西未填</span>"; ?>
                <div style="margin-top:16px; padding-bottom:16px">
                    <button type="submit" class="admin-button">新增</button>
                </div>
            </form>
        </div>
        <div style="clear:both"></div>
    </div>
</body>
</html>