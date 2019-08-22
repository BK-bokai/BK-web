<?php
require_once "db.php";
require_once "function.php";

if(create_user($_POST['n'],$_POST['un'],$_POST['pa'],$_POST['email'],$_POST['level']))
{
   echo 'yes';
}
else 
{
   echo 'no';
}



?>