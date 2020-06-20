<?php
include_once("../config/sqlconnect.php");
session_start();
if (!isset($_SESSION['username'])) {
    die("你尚未登入 <a href=\"../login.php\">按我登入</a>");
}
$err = false;
$fa = false;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['cid']) && !empty($_POST['cid']) &&isset($_POST['cardname']) && !empty($_POST['cardname']) && isset($_POST['charactername']) && !empty($_POST['charactername']) && isset($_POST['property']) && !empty($_POST['property'])
        && isset($_POST['star']) && !empty($_POST['star']) && isset($_POST['total_force']) && !empty($_POST['total_force']) && isset($_POST['vocal']) && !empty($_POST['vocal'])
        && isset($_POST['dance']) && !empty($_POST['dance']) && isset($_POST['charm']) && !empty($_POST['charm']) && isset($_POST['skillname']) && !empty($_POST['skillname']) && isset($_POST['skill']) && !empty($_POST['skill'])) {
        $cardname = $_POST['cardname'];
        $charactername = $_POST['charactername'];
        $property = $_POST['property'];
        $star = $_POST['star'];
        $total_force = $_POST['total_force'];
        $vocal = $_POST['vocal'];
        $dance = $_POST['dance'];
        $charm = $_POST['charm'];
        $skillname = $_POST['skillname'];
        $skill = $_POST['skill'];
        $cid = $_POST['cid'];
        $sql = "update cards set card_name='$cardname', character_name='$charactername', property='$property', star=$star, max_total_force=$total_force, max_vocal=$vocal, max_dance=$dance, max_charm=$charm, skillname='$skillname', skill='$skill' where caid=$cid;";
        $result = ($con->query($sql));
        if($result) {   
            header('location: card.php');
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
    <title>ShiroInoriGame - 編輯卡面</title>
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
        <form action="editcard.php" method="post">
            <p style="color:gray; font-size:20px">編輯卡面</p>
            <?php
            if($_SERVER['REQUEST_METHOD'] === 'GET') {
                $sql = "select * from cards where caid=".$_GET['id'].";";
                $result = ($con->query($sql));
                if($row = mysqli_fetch_array($result)) {
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"cardname\" id=\"cardname\" placeholder=\"請輸入卡面名稱\" style=\"color:#000\" value=\"".$row['card_name']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"charactername\" id=\"charactername\" placeholder=\"請輸入角色名稱\" style=\"color:#000\" value=\"".$row['character_name']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"property\" id=\"property\" placeholder=\"請輸入屬性\" style=\"color:#000\" value=\"".$row['property']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"star\" id=\"star\" placeholder=\"請輸入星數\" style=\"color:#000\" value=\"".$row['star']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"total_force\" id=\"total_force\" placeholder=\"請輸入總合力\" style=\"color:#000\" value=\"".$row['max_total_force']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"vocal\" id=\"vocal\" placeholder=\"請輸入vocal\" style=\"color:#000\" value=\"".$row['max_vocal']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"dance\" id=\"dance\" placeholder=\"請輸入dance\" style=\"color:#000\" value=\"".$row['max_dance']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"charm\" id=\"charm\" placeholder=\"請輸入charm\" style=\"color:#000\" value=\"".$row['max_charm']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"skillname\" id=\"skillname\" placeholder=\"請輸入技能名稱\" style=\"color:#000\" value=\"".$row['skillname']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"skill\" id=\"skill\" placeholder=\"請輸入技能敘述\" style=\"color:#000\" value=\"".$row['skill']."\">";
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