<?php
include_once("../config/sqlconnect.php");
session_start();
if(!isset($_SESSION['username'])) {
    die("你尚未登入 <a href=\"../login.php\">按我登入</a>");
}
$nicknameerr = false;
$pwerr_old = false;
$pwerr_new = false;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['nickname']) && !empty($_POST['nickname']) && isset($_SESSION['username'])) {
        $nickname = $_POST['nickname'];
        $username = $_SESSION['username'];
        $sql = "update users set nickname='$nickname' where username='$username';";
        $result = ($con->query($sql));
        if($result) {
            $_SESSION['nickname'] = $nickname;
            header('location: user.php');
        } else {
            $nicknameerr = true;
        }
    } else if(isset($_POST['oldpassword']) && !empty($_POST['oldpassword']) && isset($_SESSION['username'])) {
        $pw = sha1($_POST['oldpassword']);
        $username = $_SESSION['username'];
        $sql = "select username from users where username='$username' and password='$pw';";
        $result = ($con->query($sql));
        if(mysqli_num_rows($result)) {
            if(isset($_POST['newpassword']) && !empty($_POST['newpassword']) && isset($_POST['repassword']) && !empty($_POST['repassword'])) {
                if($_POST['newpassword'] === $_POST['repassword']) {
                    $pw = sha1($_POST['newpassword']);
                    $sql = "update users set password='$pw' where username='$username';";
                    if($update_result = $con->query($sql)) {
                        header('location: user.php');
                    } else {
                        $pwerr_new = true;
                    }
                } else {
                    $pwerr_new = true;
                }
            }
        } else {
            $pwerr_old = true;
        }
    }
}
$con->close();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShiroInoriGame - 個人資料管理</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <div class="container">
            <a href="../index.php" class="logo">ShiroInoriGame</a>
            <div class="header-data">
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<span>當前用戶為" . $_SESSION['nickname'] . "</span>";
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
            <form id="nickname" action="user.php" method="post">
                <p style="color: gray; font-size:20px">更改使用者暱稱</p>
                <div class="form-input" style="width: 20%;">
                    <input type="text" name="nickname" id="nickname" placeholder="請輸入使用者暱稱">
                </div>
                <?php if($nicknameerr) echo "<span style=\"color:#f00;\">暱稱變更失敗</span>" ?>
                <div style="margin-top: 16px;">
                    <button type="submit" class="admin-button">變更</button>
                </div>
            </form>
            <form id="password" action="user.php" method="post">
                <p style="color: gray; font-size:20px">更改密碼</p>
                <div class="form-input" style="width: 20%;">
                    <input type="password" name="oldpassword" id="oldpassword" placeholder="請輸入舊密碼">
                </div>
                <div class="form-input" style="width: 20%;">
                    <input type="password" name="newpassword" id="newpassword" placeholder="請輸入新密碼">
                </div>
                <div class="form-input" style="width: 20%;">
                    <input type="password" name="repassword" id="repassword" placeholder="請再輸入一次新密碼">
                </div>
                <?php
                if($pwerr_old) echo "<span style=\"color:#f00;\">舊密碼輸入錯誤</span>";
                else if($pwerr_new) echo "<span style=\"color:#f00;\">密碼輸入不一致</span>"; ?>
                <div style="margin-top: 16px;">
                    <button type="submit" class="admin-button">變更</button>
                </div>
            </form>
        </div>
        <div style="clear:both"></div>
    </div>
</body>

</html>