<?php
@session_start();
$host = "localhost";
$username = 'root';
$password = '2841p4204';
$db = 'bk_db';

$_SESSION['link'] = mysqli_connect($host, $username, $password, $db);

if ($_SESSION['link'])
{
               mysqli_query($_SESSION['link'], "SET NAMES utf8");
               // echo("已正確連線");
}
else 
{
               echo("連結資料庫錯誤".mysqli_connect_error($_SESSION['link']));
}
