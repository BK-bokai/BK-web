<?php
@session_start();
require_once "db.php";
require_once "function.php";

if(create_user($_POST['n'],$_POST['un'],$_POST['pa'],$_POST['email'],$_POST['level']))
{
   check_user($_POST['un'],$_POST['pa']);
   echo 'yes';
}
else 
{
   echo 'no';
}



?>