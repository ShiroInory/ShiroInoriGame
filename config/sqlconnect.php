<?php
    $server = 'localhost';
    $dbname = 'ShiroInoriGame';
    $dbuser = 'root';
    $dbpw = '1234';

    $con = new mysqli($server, $dbuser, $dbpw, $dbname);

    if($con->connect_error) {
        die($con->connect_error);
    }

    mysqli_query($con, "SET NAMES utf8");
?>