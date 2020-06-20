<?php
include_once("../config/sqlconnect.php");
session_start();
if (!isset($_SESSION['username'])) {
    die("你尚未登入 <a href=\"../login.php\">按我登入</a>");
}
$err = false;
$fa = false;    
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['cid']) && !empty($_POST['cid']) &&isset($_POST['character_name']) && !empty($_POST['character_name']) && isset($_POST['age']) && !empty($_POST['age']) && isset($_POST['brithday']) && !empty($_POST['brithday'])
        && isset($_POST['height']) && !empty($_POST['height']) && isset($_POST['bloodgroup']) && !empty($_POST['bloodgroup']) && isset($_POST['background']) && !empty($_POST['background'])
        && isset($_POST['imagecolor']) && !empty($_POST['imagecolor']) && isset($_POST['motto']) && !empty($_POST['motto']) && isset($_POST['specialty']) && !empty($_POST['specialty'])
        && isset($_POST['dream']) && !empty($_POST['dream']) && isset($_POST['likefood']) && !empty($_POST['likefood']) && isset($_POST['notgoodat']) && !empty($_POST['notgoodat'])
        && isset($_POST['interest']) && !empty($_POST['interest']) && isset($_POST['seiyuu']) && !empty($_POST['seiyuu']) && isset($_POST['introduction']) && !empty($_POST['introduction'])) {
        $cid = $_POST['cid'];
        $character_name = $_POST['character_name'];
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
        $seiyuu = $_POST['seiyuu'];
        $interest = $_POST['interest'];
        $introduction = $_POST['introduction'];
        $sql = "update characters set character_name='$character_name', age=$age, brithday='$brithday', height='$height', bloodgroup='$bloodgroup', background='$background', imagecolor='$imagecolor', motto='$motto', specialty='$specialty', dream='$dream', likefood='$likefood', notgoodat='$notgoodat' , interest='$interest', seiyuu='$seiyuu', introduction='$introduction' where cid=$cid;";
        $result = ($con->query($sql));
        if($result) {   
            header('location: character.php');
        } else {
            $fa = true;
        }
    } else {
        $err = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShiroInoriGame - 編輯角色</title>
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
        <form action="editcharacter.php" method="post">
            <p style="color:gray; font-size:20px">編輯角色</p>
            <?php
            if($_SERVER['REQUEST_METHOD'] === 'GET') {
                $sql = "select * from characters where cid=".$_GET['id'].";";
                $result = ($con->query($sql));
                if($row = mysqli_fetch_array($result)) {
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"character_name\" id=\"character_name\" placeholder=\"請輸入角色名稱\" style=\"color:#000\" value=\"".$row['character_name']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"age\" id=\"age\" placeholder=\"請輸入年紀\" style=\"color:#000\" value=\"".$row['age']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"brithday\" id=\"brithday\" placeholder=\"請輸入生日\" style=\"color:#000\" value=\"".$row['brithday']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"height\" id=\"height\" placeholder=\"請輸入身高\" style=\"color:#000\" value=\"".$row['height']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"bloodgroup\" id=\"bloodgroup\" placeholder=\"請輸入血型\" style=\"color:#000\" value=\"".$row['bloodgroup']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"background\" id=\"background\" placeholder=\"請輸入出身地\" style=\"color:#000\" value=\"".$row['background']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"imagecolor\" id=\"imagecolor\" placeholder=\"請輸入應援色\" style=\"color:#000\" value=\"".$row['imagecolor']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"motto\" id=\"motto\" placeholder=\"請輸入座右銘\" style=\"color:#000\" value=\"".$row['motto']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"specialty\" id=\"specialty\" placeholder=\"請輸入特技\" style=\"color:#000\" value=\"".$row['specialty']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"dream\" id=\"dream\" placeholder=\"請輸入夢想\" style=\"color:#000\" value=\"".$row['dream']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"likefood\" id=\"likefood\" placeholder=\"請輸入喜歡的食物\" style=\"color:#000\" value=\"".$row['likefood']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"notgoodat\" id=\"notgoodat\" placeholder=\"請輸入不擅長的事物\" style=\"color:#000\" value=\"".$row['notgoodat']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"interest\" id=\"interest\" placeholder=\"請輸入興趣\" style=\"color:#000\" value=\"".$row['interest']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"seiyuu\" id=\"seiyuu\" placeholder=\"請輸入聲優\" style=\"color:#000\" value=\"".$row['seiyuu']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"introduction\" id=\"introduction\" placeholder=\"請輸入簡介\" style=\"color:#000; height:40px;\" value=\"".$row['introduction']."\">";
                    echo "</div>";
                    echo "<input type=\"hidden\" name=\"cid\" id=\"cid\" value=\"".$_GET['id']."\">";
                } else echo die($con->error);
            }
            if($fa) echo "<span style=\"color:#f00;\">變更失敗</span>";
            else if($err) echo "<span style=\"color:#f00;\">你有東西未填</span>";
            else {
                echo "<div style=\"margin-top:16px; padding-bottom:16px\">";
                echo "<button type=\"submit\" class=\"admin-button\">送出</button>";
                echo "</div>";
            }
            $con->close();
            ?>
        </form>
        </div>
        <div style="clear:both"></div>
    </div>
</body>
</html>