<?php
include_once("../config/sqlconnect.php");
session_start();
if(!isset($_SESSION['username'])) {
    die("你尚未登入 <a href=\"../login.php\">按我登入</a>");
}
$fa = false;
$err = false;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['cardname']) && !empty($_POST['cardname']) && isset($_POST['charactername']) && !empty($_POST['charactername']) && isset($_POST['property']) && !empty($_POST['property'])
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
        $sql = "insert into cards(card_name, character_name, property, star, max_total_force, max_vocal, max_dance, max_charm, skillname, skill) values('$cardname', '$charactername', '$property', $star, $total_force, $vocal, $dance, $charm, '$skillname', '$skill');";
        $result = ($con->query($sql));
        if($result) {
            header('location: card.php');
        } else {
            $fa = true;
        }
    } else {
        $err = true;
    }
} else if($_SERVER["REQUEST_METHOD"] === 'GET') {
    if(@isset($_GET['mode']) == "del" && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "delete from cards where caid=".$id.";";
        $result = ($con->query($sql));
        if($result) {
            header('location: card.php');
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
    <title>ShiroInoriGame - 卡面管理</title>
    <link rel="stylesheet" href="../css/style.css">
    <script>
        function del(id) {
            if(confirm("確定要刪除卡面嗎?")) {
                window.location = "card.php?mode=del&id=" + id;
            }
        }

        function edit(id) {
            window.location = "editcard.php?id=" + id;
        }
    </script>
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
            <table style="border:1px solid #000; width:460px;">
            <tr>
                <th style="border:1px solid #000; width:250px;">卡面名稱</th>
                <th style="border:1px solid #000; width:210px;">管理</th>
            </tr>
            <?php
            $sql = "select caid, card_name from cards";
            $result = ($con->query($sql));
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td style=\"border:1px solid #000; width:250px;\">".$row['card_name']."</td>";
                    echo "<td style=\"border:1px solid #000; width:210px;\"><button type=\"submit\" class=\"admin-button\" onclick=\"edit(".$row['caid'].")\">編輯</button><button type=\"submit\" class=\"admin-button\" onclick=\"del(".$row['caid'].")\">刪除</button></td>";
                    echo "</tr>";
                }
            }
            $con->close();
            ?>
            </table>
            <form action="card.php" method="post">
                <p style="color:gray; font-size:20px">新增卡面</p>
                <div class="form-input" style="width:20%">
                    <input type="text" name="cardname" id="cardname" placeholder="請輸入卡面名稱">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="charactername" id="charactername" placeholder="請輸入角色名稱">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="property" id="property" placeholder="請輸入屬性">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="star" id="star" placeholder="請輸入星數">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="total_force" id="total_force" placeholder="請輸入總合力">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="vocal" id="vocal" placeholder="請輸入vocal">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="dance" id="dance" placeholder="請輸入dance">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="charm" id="charm" placeholder="請輸入charm">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="skillname" id="skillname" placeholder="請輸入技能名稱">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="skill" id="skill" placeholder="請輸入技能描述">
                </div>
                <?php if($fa) echo "<span style=\"color:#f00;\">新增失敗</span>";
                else if($err) echo "<span style=\"color:#f00;\">你有東西未填</span>"; ?>
                <div style="margin-top:16px; padding-bottom:16px">
                    <button type="submit" class="admin-button">新增</button>
                </div>
            </form>
        </div>
        <div style="clear:both"></div>
    </div>
</body>

</html>