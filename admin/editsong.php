<?php
include_once("../config/sqlconnect.php");
session_start();
if (!isset($_SESSION['username'])) {
    die("你尚未登入 <a href=\"../login.php\">按我登入</a>");
}
$err = false;
$fa = false;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['sid']) && !empty($_POST['sid']) &&isset($_POST['song_name']) && !empty($_POST['song_name']) && isset($_POST['easy_difficulty']) && !empty($_POST['easy_difficulty']) && isset($_POST['normal_difficulty']) && !empty($_POST['normal_difficulty'])
        && isset($_POST['hard_difficulty']) && !empty($_POST['hard_difficulty']) && isset($_POST['ex_difficulty']) && !empty($_POST['ex_difficulty']) && isset($_POST['singer']) && !empty($_POST['singer'])) {
        $sid = $_POST['sid'];
        $song_name = $_POST['song_name'];
        $easy_difficulty = $_POST['easy_difficulty'];
        $normal_difficulty = $_POST['normal_difficulty'];
        $hard_difficulty = $_POST['hard_difficulty'];
        $ex_difficulty = $_POST['ex_difficulty'];
        $singer = $_POST['singer'];
        $sql = "update songs set song_name='$song_name', easy_difficulty='$easy_difficulty', normal_difficulty='$normal_difficulty', hard_difficulty='$hard_difficulty', ex_difficulty='$ex_difficulty', singer='$singer' where sid=$sid;";
        $result = ($con->query($sql));
        if($result) {   
            header('location: song.php');
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
    <title>ShiroInoriGame - 編輯歌曲</title>
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
        <form action="editsong.php" method="post">
            <p style="color:gray; font-size:20px">編輯歌曲</p>
            <?php
            if($_SERVER['REQUEST_METHOD'] === 'GET') {
                $sql = "select * from songs where sid=".$_GET['id'].";";
                $result = ($con->query($sql));
                if($row = mysqli_fetch_array($result)) {
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"song_name\" id=\"song_name\" placeholder=\"請輸入歌曲名稱\" style=\"color:#000\" value=\"".$row['song_name']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"easy_difficulty\" id=\"easy_difficulty\" placeholder=\"請輸入easy難度\" style=\"color:#000\" value=\"".$row['easy_difficulty']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"normal_difficulty\" id=\"normal_difficulty\" placeholder=\"請輸入normal難度\" style=\"color:#000\" value=\"".$row['normal_difficulty']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"hard_difficulty\" id=\"hard_difficulty\" placeholder=\"請輸入hard難度\" style=\"color:#000\" value=\"".$row['hard_difficulty']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"ex_difficulty\" id=\"ex_difficulty\" placeholder=\"請輸入ex難度\" style=\"color:#000\" value=\"".$row['ex_difficulty']."\">";
                    echo "</div>";
                    echo "<div class=\"form-input\" style=\"width:20%\">";
                    echo "<input type=\"text\" name=\"singer\" id=\"singer\" placeholder=\"請輸入歌手名稱\" style=\"color:#000\" value=\"".$row['singer']."\">";
                    echo "</div>";
                    echo "<input type=\"hidden\" name=\"sid\" id=\"sid\" value=\"".$_GET['id']."\">";
                } else echo die($con->error);
            }
            if($fa) echo "<span style=\"color:#f00;\">變更失敗</span>";
            else if($err)  {
                echo "<span style=\"color:#f00;\">你有東西未填</span>";
            } else {
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