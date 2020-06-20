<?php
include_once("../config/sqlconnect.php");
session_start();
if (!isset($_SESSION['username'])) {
    die("你尚未登入 <a href=\"../login.php\">按我登入</a>");
}
$sfa = false;
$serr = false;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['song_name']) && !empty($_POST['song_name']) && isset($_POST['easy_difficulty']) && !empty($_POST['easy_difficulty']) && isset($_POST['normal_difficulty']) && !empty($_POST['normal_difficulty'])
        && isset($_POST['hard_difficulty']) && !empty($_POST['hard_difficulty']) && isset($_POST['ex_difficulty']) && !empty($_POST['ex_difficulty']) && isset($_POST['singer']) && !empty($_POST['singer'])) {
        $song_name = $_POST['song_name'];
        $easy_difficulty = $_POST['easy_difficulty'];
        $normal_difficulty = $_POST['normal_difficulty'];
        $hard_difficulty = $_POST['hard_difficulty'];
        $ex_difficulty = $_POST['ex_difficulty'];
        $singer = $_POST['singer'];
        $sql = "insert into songs(song_name, easy_difficulty, normal_difficulty, hard_difficulty, ex_difficulty, singer) values('$song_name', '$easy_difficulty', '$normal_difficulty', '$hard_difficulty', '$ex_difficulty', '$singer');";
        $result = ($con->query($sql));
        if($result) {
            header('location: song.php');
        } else {
            $sfa = true;
        }
    } else {
        $serr = true;
    }
} else if($_SERVER["REQUEST_METHOD"] === 'GET') {
    if(@isset($_GET['mode']) == "del" && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "delete from songs where sid=".$id.";";
        $result = ($con->query($sql));
        if($result) {
            header('location: song.php');
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
    <title>ShiroInoriGame - 歌曲管理</title>
    <link rel="stylesheet" href="../css/style.css">
    <script>
        function del(id) {
            if(confirm("確定要刪除歌曲嗎?")) {
                window.location = "song.php?mode=del&id=" + id;
            }
        }

        function edit(id) {
            window.location = "editsong.php?id=" + id;
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
                <th style="border:1px solid #000; width:250px;">歌曲名稱</th>
                <th style="border:1px solid #000; width:210px;">管理</th>
            </tr>
            <?php
            $sql = "select sid, song_name from songs;";
            $result = ($con->query($sql));
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td style=\"border:1px solid #000; width:250px;\">".$row['song_name']."</td>";
                    echo "<td style=\"border:1px solid #000; width:210px;\"><button type=\"submit\" class=\"admin-button\" onclick=\"edit(".$row['sid'].")\">編輯</button><button type=\"submit\" class=\"admin-button\" onclick=\"del(".$row['sid'].")\">刪除</button></td>";
                    echo "</tr>";
                }
            }
            $con->close();
            ?>
            </table>
            <form action="song.php" method="post">
                <p style="color:gray; font-size:20px">新增歌曲</p>
                <div class="form-input" style="width:20%">
                    <input type="text" name="song_name" id="song_name" placeholder="請輸入歌曲名稱">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="easy_difficulty" id="easy_difficulty" placeholder="請輸入easy難度">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="normal_difficulty" id="normal_difficulty" placeholder="請輸入normal難度">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="hard_difficulty" id="hard_difficulty" placeholder="請輸入hard難度">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="ex_difficulty" id="ex_difficulty" placeholder="請輸入ex難度">
                </div>
                <div class="form-input" style="width:20%">
                    <input type="text" name="singer" id="singer" placeholder="請輸入歌手">
                </div>
                <?php if($sfa) echo "<span style=\"color:#f00;\">新增失敗</span>";
                else if($serr) echo "<span style=\"color:#f00;\">你有東西未填</span>"; ?>
                <div style="margin-top:16px; padding-bottom:16px">
                    <button type="submit" class="admin-button">新增</button>
                </div>
            </form>
        </div>
        <div style="clear:both"></div>
    </div>
</body>
</html>