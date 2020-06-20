<?php
include_once("config/sqlconnect.php");
session_start();
$err = false;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $sql = "select username, password, nickname from users where username = '$username' and password = '$password';";
    $result = ($con->query($sql));
    if(mysqli_num_rows($result)) {
        $row = mysqli_fetch_array($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['nickname'] = $row['nickname'];
        header('location: index.php');
    } else {
        $err = true;
    }
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShiroInoriGame - 登入</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <header>
        <div class="container">
            <a href="index.php" class="logo">ShiroInoriGame</a>
            <div class="header-data">
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<span>當前管理者為" . $_SESSION['nickname'] . "</span>";
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
    <div class="wrapper">
        <div class="container inner">
            <div class="login-card">
                <form action="login.php" method="post">
                    <h1 class="title">管理者登入</h1>
                    <div class="form-input">
                        <label for="">
                            <i class="material-icons">account_circle</i>
                        </label>
                        <input type="text" name="username"" id="username" placeholder="帳號">
                    </div>
                    <div class="form-input">
                        <label for="">
                            <i class="material-icons">lock</i>
                        </label>
                        <input type="password" name="password" id="password" placeholder="密碼">
                    </div>
                    <?php if($err) echo "<span style=\"color:#f00;\">帳號或密碼錯誤</span>"; ?>
                    <div class="form-buttonbar">
                        <button type="submit" class="button">登入</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>